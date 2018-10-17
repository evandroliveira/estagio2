<?php
class Receive extends model {

	public function getList($offset, $id_company) {
		$array = array();

		$sql = $this->db->prepare("
			SELECT
				sales.id,
				sales.date_sale,
				sales.total_price,
				sales.status,
				clients.name
			FROM sales
			LEFT JOIN clients ON clients.id = sales.id_client 
			WHERE
				sales.id_company = :id_company AND status != 1 AND status != 2
			ORDER BY sales.date_sale DESC
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
				( select clients.name from clients where clients.id = sales.id_client ) as client_name
			FROM sales
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
				sales_products.quant,
				sales_products.sale_price,
				inventory.name
			FROM sales_products
			LEFT JOIN inventory
				ON inventory.id = sales_products.id_product
			WHERE
				sales_products.id_sale = :id_sale AND
				sales_products.id_company = :id_company");
		$sql->bindValue(":id_sale", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array['products'] = $sql->fetchAll();
		}


		return $array;
	}

}

?>