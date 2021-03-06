<?php

class Inventory extends model
{

    public function getList($offset, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM inventory WHERE id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(); # pegando o resultado e inserindo no array
        }

        return $array;
    }

    public function getInfo($id, $id_company)
    {
        #criando um array vazio para receber os dados
        $array = array();
        #Fazer as requisições das informações do item em específico
        $sql = $this->db->prepare("SELECT * FROM inventory WHERE id = :id AND id_company = :id_company");
        #substituindo os valores com bindValue
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            #preenchendo o array com o fetchAll
            $array = $sql->fetch();
        }

        return $array;
    }


    #metodo auxiliar
    public function setLog($id_product, $id_company, $id_user, $action)
    {
        $sql = $this->db->prepare("INSERT INTO inventory_history SET id_company = :id_company, id_product = :id_product, id_user = :id_user, action = :action, date_action = NOW()"); #NOW pega a data atual
        $sql->bindValue("id_company", $id_company);
        $sql->bindValue("id_product", $id_product);
        $sql->bindValue("id_user", $id_user); #inserindo o usuario que esta logado
        $sql->bindValue("action", $action);
        $sql->execute();

    }


    #metodo adicionar
    public function add($name, $price, $price_sale, $quant, $min_quant, $id_company, $id_user)
    {
        #montar a query de insert
        $sql = $this->db->prepare("INSERT INTO inventory SET name = :name, price = :price, price_sale = :price_sale, quant = :quant, min_quant = :min_quant, id_company = :id_company");
        #preenchendo dos dados
        $sql->bindValue(":name", $name);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":price_sale", $price_sale);
        $sql->bindValue(":quant", $quant);
        $sql->bindValue(":min_quant", $min_quant);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        #pegando o id_product
        $id_product = $this->db->lastInsertId(); #usando o db para pegar o ultimo id inserido

        $this->setLog($id_product, $id_company, $id_user, "add");

    }

    #metodo editar
    public function edit($id, $name, $price, $price_sale, $quant, $min_quant, $id_company, $id_user)
    {
        #montar a query de insert
        $sql = $this->db->prepare("UPDATE inventory SET name = :name, price = :price, price_sale = :price_sale, quant = :quant, min_quant = :min_quant WHERE id = :id AND id_company = :id_company");
        #preenchendo dos dados
        $sql->bindValue(":name", $name);
        $sql->bindValue(":price", $price);
        $sql->bindValue(":price_sale", $price_sale);
        $sql->bindValue(":quant", $quant);
        $sql->bindValue(":min_quant", $min_quant);
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":id", $id);
        $sql->execute();

        #pegando o id_product

        $this->setLog($id, $id_company, $id_user, "edt");

    }

    public function delete($id, $id_company, $id_user)
    {
        $sql = $this->db->prepare("DELETE FROM inventory WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();


        $this->setLog($id, $id_company, $id_user, "del");
    }

    public function searchProductsByName($name, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT name, price_sale as price, id FROM inventory WHERE name LIKE :name AND id_company = :id_company LIMIT 10");
        $sql->bindValue(':name', '%' . $name . '%');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    #metodo para dar baixa no estoque
    public function decrease($id_prod, $id_company, $quant_prod, $id_user)
    {
        $sql = $this->db->prepare("UPDATE inventory SET quant = quant - $quant_prod WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id_prod);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        //registrando o log
        $this->setLog($id_prod, $id_company, $id_user, "dwn");


    }

    public function increase($id_prod, $id_company, $quant_prod, $id_user)
    {
        $sql = $this->db->prepare("UPDATE inventory SET quant = quant + $quant_prod WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id_prod);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();
        //registrando o log
        $this->setLog($id_prod, $id_company, $id_user, "dwn");

    }

    public function getInventoryFiltered($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT *, (min_quant-quant) as dif FROM inventory WHERE quant <= min_quant AND id_company = :id_company ORDER BY dif DESC");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInventoryFilter($id_company) {
        $array = array();

        $sql = $this->db->prepare("SELECT *, (price_sale-price) as dif FROM inventory WHERE id_company = :id_company ORDER BY dif ASC");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getMaisVendidos($id_company) {
        $array = array();

        $sql = $this->db->prepare("
              SELECT purchases_products.id_company, inventory.name, SUM(purchases_products.quant) qtde FROM inventory 
              LEFT JOIN purchases_products ON inventory.id = purchases_products.id_product 
              WHERE purchases_products.id_company = :id_company
              GROUP BY purchases_products.quant 
              ORDER BY qtde DESC");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0 ){
            $array = $sql->fetchAll();
        }

        return $array;
    }


}











