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
        $sql = "SELECT SUM( valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company AND descricao_movimento = 'compra'";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $s = $sql->fetch();
        $saida = $s['total'];

        return $saida;
    }

    public function getEstrada($id_company) {
        $entrada = 0;

        $sql = "SELECT SUM( valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company AND descricao_movimento = 'venda'";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->execute();

        $e = $sql->fetch();
        $entrada = $e['total'];

        return $entrada;
    }

    public function getListaEntrada($period1, $period2, $id_company)
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

}