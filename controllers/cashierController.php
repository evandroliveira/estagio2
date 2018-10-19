<?php
class cashierController extends controller {

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

        $c = new Cashier();

        $data['statuses'] = array(
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Cancelado'
        );

        //$data['products_sold'] = $c->getSoldProducts(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

        $data['revenue'] = $c->getTotalCaixa(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());

       // $data['expenses'] = $c->getTotalExpenses(date('Y-m-d', strtotime('-30 days')), date('Y-m-d'), $u->getCompany());
        
       

        $this->loadTemplate('cashier', $data);
    }

}
