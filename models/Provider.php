<?php
class Provider extends model {

    public function getList($offset, $id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM provider WHERE id = :id LIMIT $offset, 10");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getInfo($id) {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM provider WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    public function getCount($id) {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM provider WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

    public function add($id, $name, $cnpj = '', $address = '', $number, $bairro = '', $cep = '', $state = '', $city = '', $phone = '', $cellphone = '', $email = '', $status = '') {

        $sql = $this->db->prepare("INSERT INTO provider SET id = :id, name = :name, cnpj = :cnpj, address = :address, number = :number, bairro = :bairro, cep = :cep, state = :state, city = :city, phone = :phone, cellphone = :cellphone, email = :email, status = :status");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":number", $number);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":state", $state);
        $sql->bindValue(":city", $city);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":cellphone", $cellphone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":status", $status);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function edit($id, $name, $cnpj, $address, $number, $bairro, $cep, $state, $city, $phone, $cellphone, $email, $status) {

        $sql = $this->db->prepare("UPDATE provider SET id = :id, name = :name, cnpj = :cnpj, address = :address, number = :number, bairro = :bairro, cep = :cep, state = :state, city = :city, phone = :phone, cellphone = :cellphone, email = :email, status = :status WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":cnpj", $cnpj);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":number", $number);
        $sql->bindValue(":bairro", $bairro);
        $sql->bindValue(":cep", $cep);
        $sql->bindValue(":state", $state);
        $sql->bindValue(":city", $city);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":cellphone", $cellphone);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":status", $status);
        $sql->execute();

    }

    public function searchProviderByName($name, $id) {
        $array = array();

        $sql = $this->db->prepare("SELECT name, id FROM provider WHERE name LIKE :name LIMIT 10");
        $sql->bindValue(':name', '%'.$name.'%');
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

}












