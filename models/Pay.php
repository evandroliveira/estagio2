<?php
class Pay extends model {

    public function getList($offset, $id_company) {
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
				purchases.id_company = :id_company AND status != 1 AND status != 2
			ORDER BY purchases.date_purchase DESC
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

}

?>