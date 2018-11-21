<?php
class reportController extends controller {

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

        if($u->hasPermission('report_view')) {
        	$this->loadTemplate("report", $data);
        } else {
    		header("Location: ".BASE_URL);
    	}
    }

    public function sales() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statuses'] = array(
            '0'=>'A prazo',
            '1'=>'À vista'
        );

        if($u->hasPermission('report_view')) {
            
            
            $this->loadTemplate("report_sales", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function sales_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $data['statuses'] = array(
            '0'=>'A prazo',
            '1'=>'À vista'
        );

        if($u->hasPermission('report_view')) {
            $client_name = addslashes($_GET['client_name']);
            $period1 = addslashes($_GET['period1']);
            $period2 = addslashes($_GET['period2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);

            $s = new Sales();
            $data['sales_list'] = $s->getSalesFiltered($client_name, $period1, $period2, $status, $order, $u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_sales_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }        
    }

    public function purchases() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['statuses'] = array(
            '0'=>'A prazo',
            '1'=>'A vista'
        );

        if($u->hasPermission('report_view')) {


            $this->loadTemplate("report_purchases", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function purchases_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        $data['statuses'] = array(
            '0'=>'A prazo',
            '1'=>'A vista'
        );
        //recebendo todos os campos que foram enviados no popup via GET
        if($u->hasPermission('report_view')) {
            $provider_name = addslashes($_GET['provider_name']);
            $periodo1 = addslashes($_GET['periodo1']);
            $periodo2 = addslashes($_GET['periodo2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);

            $p = new Purchases();
            $data['purchases_list'] = $p->getPurchasesFiltered($provider_name, $periodo1, $periodo2, $status, $order, $u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_purchases_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF(); //iniciando um pdf
            $mpdf->WriteHTML($html); // escrever o html que esta no niew report_purchases_pdf
            $mpdf->Output(); //mostrar o pdf
        } else {
            header("Location: ".BASE_URL);
        }
    }



    public function inventory() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {
            
            $this->loadTemplate("report_inventory", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function inventory_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('report_view')) {
            $i = new Inventory();
            $data['inventory_list'] = $i->getInventoryFiltered($u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_inventory_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }        
    }

    public function estoque() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {

            $this->loadTemplate("report_estoque", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function estoque_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('report_view')) {
            $i = new Inventory();
            $data['estoque_list'] = $i->getInventoryFilter($u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_estoque_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function vendidos() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {

            $this->loadTemplate("report_vendidos", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function vendidos_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('report_view')) {
            $i = new Inventory();
            $data['vendidos_list'] = $i->getMaisVendidos($u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_vendidos_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function clients() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {

            $this->loadTemplate("report_clients", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function clients_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('report_view')) {
            $c = new Clients();
            $data['clients_list'] = $c->getClientsFiltered($u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_clients_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function provider() {
    $data = array();
    $u = new Users();
    $u->setLoggedUser();
    $company = new Companies($u->getCompany());
    $data['company_name'] = $company->getName();
    $data['user_email'] = $u->getEmail();

    if($u->hasPermission('report_view')) {

        $this->loadTemplate("report_provider", $data);
    } else {
        header("Location: ".BASE_URL);
    }
}

    public function provider_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('report_view')) {
            $p = new Provider();
            $data['provider_list'] = $p->getProviderFiltered($u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_provider_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function cashier() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if($u->hasPermission('report_view')) {

            $this->loadTemplate("report_cashier", $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }

    public function cashier_pdf() {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();

        if($u->hasPermission('report_view')) {
            $period1 = addslashes($_GET['period1']);
            $period2 = addslashes($_GET['period2']);

            $s = new Cashier();
            $data['cashier_list'] = $s->getCashierFiltered($period1, $period2, $u->getCompany());

            $data['filters'] = $_GET;

            $this->loadLibrary('mpdf60/mpdf');

            ob_start();
            $this->loadView("report_cashier_pdf", $data);
            $html = ob_get_contents();
            ob_end_clean();

            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: ".BASE_URL);
        }
    }

}















