<?php
class Pay extends model {

    public function getList($offset, $id_company) {
        $array = array();

        $sql = $this->db->prepare("
			SELECT
				cad_parcelas.id_parcela,
				cad_parcelas.n_parcel,
				cad_parcelas.vencimento_movimento,
				cad_parcelas.valor_movimento,
				provider.name
			FROM cad_parcelas
			LEFT JOIN provider ON cad_parcelas.id_provider = provider.id
			WHERE
				cad_parcelas.id_company = :id_company
			ORDER BY cad_parcelas.vencimento_movimento ASC
			LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }



    public function getInfo($id, $id_company) {
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

        if($sql->rowCount() > 0) {
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

        if($sql->rowCount() > 0) {
            $array['products'] = $sql->fetchAll();
        }


        return $array;
    }

    public function getCount($id_company) {
        $r = 0;
        $sql = $this->db->prepare("SELECT COUNT(*) as p FROM purchases WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['p'];

        return $r;
    }

}

?>