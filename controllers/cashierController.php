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

        $data['entrada'] = $c->getEntrada($u->getCompany());

        $data['movimento'] = $data['entrada'] - $data['saida'];

        $data['days_list'] = array();
        for($q=7;$q>0;$q--) {
            $data['days_list'][] = date('d/m', strtotime('-'.$q.' days')); //cirando um array com 7 registros
        }

        $data['input_list'] = $c->getInputList(date('Y-m-d', strtotime('-7 days')), date('Y-m-d'), $u->getCompany());
//dd($data);
        //$data['exit_list'] = $c->getExitList(date('Y-m-d', strtotime('-7 days')), date('Y-d-m'), $u->getCompany());
        $this->loadTemplate('cashier', $data);
    }










}
