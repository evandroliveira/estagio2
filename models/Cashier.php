<?php
class Cashier extends model
{

    public function getTotalCaixa($id_company)
    {
        $float = 0;

        $sql = "SELECT SUM(valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $n = $sql->fetch();
        $float = $n['total'];

        return $float;
    }

    public function getSaida($id_company) {
        $saida = 0;
        $sql = "SELECT SUM( total_price) as total FROM purchases WHERE id_company = :id_company";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $s = $sql->fetch();
        $saida = $s['total'];

        return $saida;
    }

    public function getEstrada($id_company) {
        $entrada = 0;

        $sql = "SELECT SUM( total_price) as total FROM sales WHERE id_company = :id_company";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $e = $sql->fetch();
        $entrada = $e['total'];

        return $entrada;
    }

}