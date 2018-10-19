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

}