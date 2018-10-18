<?php

class Purchases extends model
{

    public function getList($offset, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
			SELECT
				purchases.id,
				purchases.date_purchase,
				purchases.total_price,
				purchases.status,
				provider.name
			FROM purchases
			LEFT JOIN provider ON provider.id = purchases.id_provider
			WHERE
				purchases.id_company = :id_company
			ORDER BY purchases.date_purchase DESC
			LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addPurchases($id_company, $id_provider, $id_user, $quant, $status, $descricao_movimento, $valor_movimento, $id_movimento, $vencimento_movimento, $pagamento_movimento, $parcelas)
    {
        $i = new Inventory();
        //Adicionando a compra com o preço zerado
        $sql = $this->db->prepare("INSERT INTO purchases SET id_company = :id_company, id_provider = :id_provider,  id_user = :id_user, date_purchase = NOW(), total_price = :total_price,  status = :status");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_provider", $id_provider);
        $sql->bindValue(":id_user", $id_user);
        $sql->bindValue(":total_price", $valor_movimento);
        $sql->bindValue(":status", $status);
        $sql->execute();

        $id_purchase = $this->db->lastInsertId();
        //fazendo uma consulta para pegar o valor do produto
        //adicionando os produtos da compra
        $total_price = 0;
        foreach ($quant as $id_prod => $quant_prod) {
            $sql = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND id_company = :id_company");
            $sql->bindValue(":id", $id_prod);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $row = $sql->fetch();
                $price = $row['price'];


                $sqlp = $this->db->prepare("INSERT INTO purchases_products SET id_company = :id_company, id_purchase = :id_purchase, id_product = :id_product, quant = :quant, purchase_price = :purchase_price");
                $sqlp->bindValue(":id_company", $id_company);
                $sqlp->bindValue(":id_purchase", $id_purchase);
                $sqlp->bindValue(":id_product", $id_prod);
                $sqlp->bindValue(":quant", $quant_prod);
                $sqlp->bindValue(":purchase_price", $price);
                $sqlp->execute();
                //Dar baixa no estoque

                $i->increase($id_prod, $id_company, $quant_prod, $id_user);

                $total_price += $price * $quant_prod;
            }

        }
        //atualiza o preço final da compra
        $sql = $this->db->prepare("UPDATE purchases SET total_price = :total_price WHERE id = :id");
        $sql->bindValue(":total_price", $total_price);
        $sql->bindValue(":id", $id_provider);
        $sql->execute();

// Insira a movimentação no banco
        $sql = $this->db->prepare("INSERT INTO cad_movimento SET 
                          id_company = :id_company, 
                          id_provider = :id_provider, 
                          data_movimento = NOW(), 
                          descricao_movimento = :descricao_movimento, 
                          valor_movimento = :valor_movimento
                      WHERE id_company = :id_company AND id_provider = :id_provider");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id_provider", $id_provider);
        $sql->bindValue(":descricao_movimento", $descricao_movimento);
        $sql->bindValue(":valor_movimento", $valor_movimento);
        $sql->execute();

        //$con->query($sql);


// Faz um loop com a quantidade de parcelas
        foreach ($parcelas as $parcela) {
            try {
                $sql = $this->db->prepare("INSERT INTO cad_parcelas SET
               id_movimento = :id_movimento,
               id_company = :id_company,
               id_provider = :id_provider,
               n_parcel = :n_parcel,
               vencimento_movimento = :vencimento_movimento,
               pagamento_movimento = :pagamento_movimento,
               valor_movimento = :valor_movimento");
                $sql->bindValue(":id_movimento", $id_movimento);
                $sql->bindValue(":id_company", $id_company);
                $sql->bindValue(":id_provider", $id_provider);
                $sql->bindValue(":n_parcel", $parcela['parcela']);
                $sql->bindValue(":vencimento_movimento", essentials::convertDB($parcela['data_vencimento']));
                $sql->bindValue(":pagamento_movimento", '');
                $sql->bindValue(":valor_movimento", $parcela['valor']);
                $sql->execute();
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }

    }

    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("
			SELECT
				*,
				( select provider.name from provider where provider.id = purchases.id_provider ) as provider_name
			FROM purchases
			WHERE 
				id = :id AND
				id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array['info'] = $sql->fetch();
        }

        $sql = $this->db->prepare("
			SELECT
				purchases_products.quant,
				purchases_products.sale_price,
				inventory.name
			FROM purchases_products
			LEFT JOIN inventory
				ON inventory.id = purchases_products.id_product
			WHERE
				purchases_products.id_purchase = :id_purchase AND
				purchases_products.id_company = :id_company");
        $sql->bindValue(":id_purchase", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array['products'] = $sql->fetchAll();
        }


        return $array;
    }

    #metodo para mudar o status da venda
    public function changeStatus($status, $id, $id_company)
    {

        $sql = $this->db->prepare("UPDATE sales SET status = :status WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":status", $status);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

    }

    public function getSalesFiltered($client_name, $period1, $period2, $status, $order, $id_company)
    {

        $array = array();

        $sql = "SELECT
			clients.name,
			sales.date_sale,
			sales.status,
			sales.total_price
		FROM sales
		LEFT JOIN clients ON clients.id = sales.id_client
		WHERE ";

        $where = array();
        $where[] = "sales.id_company = :id_company";

        if (!empty($client_name)) {
            $where[] = "clients.name LIKE '%" . $client_name . "%'";
        }

        if (!empty($period1) && !empty($period2)) {
            $where[] = "sales.date_sale BETWEEN :period1 AND :period2";
        }

        if ($status != '') {
            $where[] = "sales.status = :status";
        }

        $sql .= implode(' AND ', $where);

        switch ($order) {
            case 'date_desc':
            default:
                $sql .= " ORDER BY sales.date_sale DESC";
                break;
            case 'date_asc':
                $sql .= " ORDER BY sales.date_sale ASC";
                break;
            case 'status':
                $sql .= " ORDER BY sales.status";
                break;
        }

        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_company", $id_company);

        if (!empty($period1) && !empty($period2)) {
            $sql->bindValue(":period1", $period1);
            $sql->bindValue(":period2", $period2);
        }

        if ($status != '') {
            $sql->bindValue(":status", $status);
        }

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getTotalRevenue($period1, $period2, $id_company)
    {
        $float = 0;

        $sql = "SELECT SUM(total_price) as total FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        $n = $sql->fetch();
        $float = $n['total'];

        return $float;
    }

    public function getTotalExpenses($period1, $period2, $id_company)
    {
        $float = 0;

        $sql = "SELECT SUM(total_price) as total FROM purchases WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        $n = $sql->fetch();
        $float = $n['total'];

        return $float;
    }

    public function getSoldProducts($period1, $period2, $id_company)
    {
        $int = 0;

        $sql = "SELECT id FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $p = array();
            foreach ($sql->fetchAll() as $sale_item) {
                $p[] = $sale_item['id'];
            }

            $sql = $this->db->query("SELECT COUNT(*) as total FROM sales_products WHERE id_sale IN (" . implode(',', $p) . ")");
            $n = $sql->fetch();
            $int = $n['total'];

        }

        return $int;
    }

    public function getRevenueList($period1, $period2, $id_company)
    {
        $array = array();
        $currentDay = $period1;
        while ($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(date_sale, '%Y-%m-%d') as date_sale, SUM(total_price) as total FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_sale, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach ($rows as $sale_item) {
                $array[$sale_item['date_sale']] = $sale_item['total'];
            }
        }


        return $array;
    }

    public function getExpensesList($period1, $period2, $id_company)
    {
        $array = array();
        $currentDay = $period1;
        while ($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(date_purchase, '%Y-%m-%d') as date_purchase, SUM(total_price) as total FROM purchases WHERE id_company = :id_company AND date_purchase BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(date_purchase, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach ($rows as $sale_item) {
                $array[$sale_item['date_purchase']] = $sale_item['total'];
            }
        }


        return $array;
    }

    public function getQuantStatusList($period1, $period2, $id_company)
    {
        $array = array('0' => 0, '1' => 0, '2' => 0);

        $sql = "SELECT COUNT(id) as total, status FROM sales WHERE id_company = :id_company AND date_sale BETWEEN :period1 AND :period2 GROUP BY status ORDER BY status ASC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach ($rows as $sale_item) {
                $array[$sale_item['status']] = $sale_item['total'];
            }
        }

        return $array;
    }

}