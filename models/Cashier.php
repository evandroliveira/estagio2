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

    public function getSaida($id_company)
    {

        $sqlCaixa = $this->db->prepare("SELECT id, opening_balance FROM caixa WHERE status = 1");
        $sqlCaixa->execute();
        if ($sqlCaixa->rowCount() > 0) {
            $idCaixa = $sqlCaixa->fetchAll()[0]['id'];


            $sql = "SELECT SUM( valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company AND descricao_movimento = 'compra' AND id_caixa = :id_caixa";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id_company', $id_company);
            $sql->bindValue(':id_caixa', $idCaixa);
            $sql->execute();

            $s = $sql->fetch();

            $saida = $s['total'];

            return $saida;

        } else {
            return false;
        }


    }

    public function getEntrada($id_company)
    {

//        $sql = $this->db->prepare("");

        $valorEntrada['opening_balance'] = 0;
        $e[0]['total'] = 0;


        $sqlCaixa = $this->db->prepare("SELECT id, opening_balance FROM caixa WHERE status = '1'");
        $sqlCaixa->execute();

        if ($sqlCaixa->rowCount() > 0) {
        $idCaixa = $sqlCaixa->fetchAll()[0];

            $valorEntrada['opening_balance'] = $idCaixa['opening_balance'];


            $sql = "SELECT SUM(valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company AND descricao_movimento = 'venda' AND id_caixa = :id_caixa";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id_company', $id_company);
            $sql->bindValue(':id_caixa', $idCaixa['id']);
            $sql->execute();

            $e = $sql->fetchAll();


        }

        $entrada = $e[0]['total'] + $valorEntrada['opening_balance'];

        return $entrada;
    }

    public function getInputList($period1, $period2, $id_company)
    {
        $array = array();
        $currentDay = $period1;
        while ($period2 != $currentDay) {
            $array[$currentDay] = 0;
            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
        }

        $sql = "SELECT DATE_FORMAT(data_movimento, '%Y-%m-%d') as data_movimento, SUM(valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company AND descricao_movimento = 'venda'  AND data_movimento BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(data_movimento, '%Y-%m-%d')";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_company', $id_company);
        $sql->bindValue(':period1', $period1);
        $sql->bindValue(':period2', $period2);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $rows = $sql->fetchAll();

            foreach ($rows as $mov_item) {
                $array[$mov_item['data_movimento']] = $mov_item['total'];
            }
        }


        return $array;
    }

    public function add_cashier($id_company, $date_cashier, $opening_balance)
    {
        $sqlS = $this->db->prepare("SELECT * FROM caixa WHERE status = 1");
        $sqlS->execute();

        if ($sqlS->rowCount() > 0) {
            ?>
            <script>alert("Não é possivel deixar mais de um caixa aberto.")</script>

            <?php
            header("Location: " . BASE_URL . "/cashier");
            return false;
        } else {
            $sql = $this->db->prepare("INSERT INTO caixa SET id_company = :id_company,date_cashier = :date_cashier, opening_balance = :opening_balance, status = 1");
            $sql->bindValue(":date_cashier", essentials::convertDB($date_cashier));
            $sql->bindValue(":opening_balance", $opening_balance);
            $sql->bindValue(":id_company", $id_company);
            $sql->execute();
            return true;
        }

    }

    public function edit_cashier($final_balance)
    {
        $sqlS = $this->db->prepare("SELECT * FROM caixa WHERE status = 1");
        $sqlS->execute();
        if ($sqlS->rowCount() > 0) {
            $sql = $this->db->prepare("UPDATE caixa SET final_balance = :final_balance, status = 0 WHERE status = 1");
            $sql->bindValue(":final_balance", $final_balance);
            $sql->execute();
        } else {
            ?>
            <script>alert("Não há um caixa aberto.")</script>
            <?php
        }
    }

//    public function getExitList($period1, $period2, $id_company)
//    {
//        $array = array();
//        $currentDay = $period1;
//        while ($period2 != $currentDay) {
//            $array[$currentDay] = 0;
//            $currentDay = date('Y-m-d', strtotime('+1 day', strtotime($currentDay)));
//        }
//
//        $sql = "SELECT DATE_FORMAT(data_movimento, '%Y-%m-%d') as data_movimento, SUM(valor_movimento) as total FROM cad_movimento WHERE id_company = :id_company AND descricao_movimento = 'compra'  AND data_movimento BETWEEN :period1 AND :period2 GROUP BY DATE_FORMAT(data_movimento, '%Y-%m-%d')";
//        $sql = $this->db->prepare($sql);
//        $sql->bindValue(':id_company', $id_company);
//        $sql->bindValue(':period1', $period1);
//        $sql->bindValue(':period2', $period2);
//        $sql->execute();
//
//        if ($sql->rowCount() > 0) {
//            $rows = $sql->fetchAll();
//
//            foreach ($rows as $mov_item) {
//                $array[$mov_item['data_movimento']] = $mov_item['total'];
//            }
//        }
//
//
//        return $array;
//    }


}