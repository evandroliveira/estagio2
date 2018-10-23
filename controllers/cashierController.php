<?php

class cashierController extends controller
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

        $c = new Cashier();


        $data['saida'] = $c->getSaida($u->getCompany());

        $data['entrada'] = $c->getEstrada($u->getCompany());

        $data['movimento'] = $data['entrada'] - $data['saida'];

        $this->loadTemplate('cashier', $data);
    }

}
