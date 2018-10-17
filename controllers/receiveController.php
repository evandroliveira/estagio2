<?php
class receiveController extends controller {

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
            '0'=>'Aguardando Pgto.',
            '1'=>'Pago',
            '2'=>'Cancelado'
        );

        if($u->hasPermission('receive_view')) {
            $r = new Receive();
            $offset = 0;

            $data['receive_list'] = $r->getList($offset, $u->getCompany());
            
            $this->loadTemplate("receive", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }


 }
?>