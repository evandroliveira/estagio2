<?php

class Provider extends model
{

    public function getList($offset, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM provider WHERE id_company = :id_company LIMIT $offset, 10");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfo($id, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM provider WHERE id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getCount($id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM provider WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

    public function getName($id)
    {
        $sql = $this->db->prepare("SELECT `name` FROM provider WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $row = $sql->fetch();

        $r = $row['name'];

        return $r;
    }

    public function add($id_company, $name, $email = '', $phone = '', $cellphone = '', $cnpj = '', $stars = '3', $internal_obs = '', $address_zipcode = '', $address = '', $address_number = '', $address2 = '', $address_neighb = '', $address_city = '', $address_state = '', $address_country = '')
    {
        $sql = $this->db->prepare("INSERT INTO provider SET id_company = :id_company, name = :name, cnpj = :cnpj, address = :address, address2 = :address2, address_number = :address_number, address_neighb = :address_neighb, address_zipcode = :address_zipcode, address_state = :address_state, address_city = :address_city, address_country = :address_country, phone = :phone, cellphone = :cellphone, email = :email, stars = :stars, internal_obs = :internal_obs");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":address2", $address2);
        $sql->bindValue(":address_number", $address_number);
        $sql->bindValue(":address_neighb", $address_neighb);
        $sql->bindValue(":address_zipcode", $address_zipcode);
        $sql->bindValue(":address_state", $address_state);
        $sql->bindValue(":address_city", $address_city);
        $sql->bindValue(":address_country", $address_country);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":cellphone", $cellphone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":stars", $stars);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function edit($id_company, $name, $cnpj, $address, $address_number, $address_neighb, $address_zipcode, $address_state, $address_city, $phone, $cellphone, $email, $stars = 3, $internal_obs)
    {

        $sql = $this->db->prepare("UPDATE provider SET id = :id, name = :name, cnpj = :cnpj, address = :address, address_number = :address_number, bairro = :bairro, address_zipcode = :address_zipcode, address_state = :address_state, city = :city, phone = :phone, cellphone = :cellphone, email = :email, status = :status WHERE id = :id");
        $sql->bindValue(":$id_company", $id_company);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":address_number", $address_number);
        $sql->bindValue(":address_neighb", $address_neighb);
        $sql->bindValue(":address_zipcode", $address_zipcode);
        $sql->bindValue(":address_state", $address_state);
        $sql->bindValue(":address_city", $address_city);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":cellphone", $cellphone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":stars", $stars);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->execute();

    }

    public function searchProviderByName($name, $id)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT name, id FROM provider WHERE name LIKE :name LIMIT 10");
        $sql->bindValue(':name', '%' . $name . '%');
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getProviderFiltered($id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT name, phone, address_city FROM provider WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0 ) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

}












