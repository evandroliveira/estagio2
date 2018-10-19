<?php

class purchasesController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $u = new Users();
        if ($u->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function index()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statuses'] = array(
            '0' => 'Parcelado',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($u->hasPermission('purchases_view')) {

            $p = new Purchases();
            $offset = 0;

            $data['purchases_list'] = $p->getList($offset, $u->getCompany());

            $this->loadTemplate("purchases", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function add()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('purchases_view')) {
            $p = new Purchases();

            if (isset($_POST['provider_id']) && !empty($_POST['provider_id'])) {
                $provider_id = addslashes($_POST['provider_id']);
                $id_movimento = addslashes($_POST['id_movimento']);
                $status = addslashes($_POST['status']);
                $descricao_movimento = addslashes($_POST['descricao_movimento']);
                $vencimento_movimento = addslashes($_POST['vencimento_movimento']);
                $pagamento_movimento = addslashes($_POST['pagamento_movimento']);
                $valor_movimento = addslashes($_POST['total_price']);
                $parcelas = $_POST['parcela'];

                $quant = $_POST['quant'];

                $p->addPurchases($u->getCompany(), $provider_id, $u->getId(), $quant, $status, $descricao_movimento, $valor_movimento, $id_movimento, $vencimento_movimento, $pagamento_movimento, $parcelas);
                header("Location: " . BASE_URL . "/purchases");
            }

            $this->loadTemplate("purchases_add", $data);
        } else {
            header("Location: " . BASE_URL);
        }
    }

    public function installment()
    {
        $data = $_GET['data'];
        $entrada = $_GET['entrada'];
        $valorTotal = $_GET['valorTotal'];
        $qtdParcela = $_GET['qtdParcela'];

        //criando o array de parcelas
        $installments = [];

        //calculo de valor das parcelas
        $installment = $valorTotal / $qtdParcela;

        //caso tenha entrada, ela fica na primeira posição do array
        if (!empty($entrada) && $entrada >= 1) {
            $installments[] = [
                'parcela' => 1,
                'data_vencimento' => date('d/m/Y'),
                'valor' => number_format($entrada, 2)
            ];
        }

//gerando as parcelas
        for ($i = 1; $i <= $qtdParcela; $i++) {
            //calculando a data (pode ser feito direto também)
            $date = date('d/m/Y', strtotime($data . ' + ' . ($i * 30) . ' days'));

            $installments[] = [
                'parcela' => $i,
                'data_vencimento' => $date,
                'valor' => number_format($installment, 2),
            ];
        }

        die(json_encode($installments));
    }
}