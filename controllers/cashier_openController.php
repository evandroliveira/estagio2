<?php

class cashier_openController extends controller
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

        if ($u->hasPermission('cashier_open')) {
            $c = new Cashier();

            if (isset($_POST['opening_balance']) && !empty(['opening_balance'])) {
                $opening_balance = addslashes($_POST['opening_balance']);
                $date_cashier = addslashes($_POST['date_cashier']);

             $c->add_cashier($u->getCompany(), $date_cashier, $opening_balance);
                header("Location: ".BASE_URL."/cashier");
            }

            $this->loadTemplate('cashier_open', $data);
        } else {
            header("Location: ".BASE_URL."/cashier");
        }
    }

    public function close($val)
    {
        $c = new Cashier();

        $c->edit_cashier($val);

        header("Location: ".BASE_URL."/cashier");
    }
}
