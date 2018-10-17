<?php
class purchasesController extends controller {

	public function __construct() {
        parent::__construct();

        $u = new Users();
        if($u->isLogged() == false) {
        	header("Location: ".BASE_URL."/login");
        	exit;
        }
    }

    public function index() {
    	$data = array();
    	$u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statuses'] = array(
            '0'=>'Parcelado',
            '1'=>'Pago',
            '2'=>'Cancelado'
        );

        if($u->hasPermission('purchases_view')) {

            $p = new Purchases();
            $offset = 0;

            $data['purchases_list'] = $p->getList($offset, $u->getCompany());

            $this->loadTemplate("purchases", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function add() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('purchases_view')) {
            $p = new Purchases();

            if(isset($_POST['provider_id']) && !empty($_POST['provider_id'])) {
                $provider_id = addslashes($_POST['provider_id']);
                $id_movimento = addslashes($_POST['id_movimento']);
                $status = addslashes($_POST['status']);
                $descricao_movimento = addslashes($_POST['descricao_movimento']);
                $vencimento_movimento = addslashes($_POST['vencimento_movimento']);
                $pagamento_movimento = addslashes($_POST['pagamento_movimento']);
                $valor_movimento = addslashes($_POST['valor_movimento']);

                $quant = $_POST['quant'];

                $p->addPurchases($u->getCompany(), $provider_id, $u->getId(), $quant, $status, $descricao_movimento, $id_movimento, $vencimento_movimento, $pagamento_movimento, $valor_movimento);
                header("Location: ".BASE_URL."/purchases");
            }
            
            $this->loadTemplate("purchases_add", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }
}