<?php
namespace src\models;
use \core\Model;

class Usuarios extends Model {
    //metodo listar usuarios
    public function listar() {
        $sql = "SELECT * FROM usuarios";
        $query = $this->db->query($sql);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }
}