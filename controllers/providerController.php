<?php
class providerController extends controller
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

        if ($u->hasPermission('provider_view')) {
            $c = new Provider();
            $offset = 0;
            $data['p'] = 1;
            if (isset($_GET['p']) && !empty($_GET['p'])) {
                $data['p'] = intval($_GET['p']);
                if ($data['p'] == 0) {
                    $data['p'] = 1;
                }
            }
            $offset = (10 * ($data['p'] - 1));

            $data['provider_list'] = $c->getList($offset, $u->getCompany());
            $data['provider_count'] = $c->getCount($u->getCompany());
            $data['p_count'] = ceil($data['provider_count'] / 10);
            $data['edit_permission'] = $u->hasPermission('provider_edit');

            $this->loadTemplate('provider', $data);
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

        if ($u->hasPermission('provider_edit')) {
            $c = new Provider();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $name = addslashes($_POST['name']);
                $cnpj = addslashes($_POST['cnpj']);
                $address = addslashes($_POST['address']);
                $number = addslashes($_POST['number']);
                $bairro = addslashes($_POST['bairro']);
                $cep = addslashes($_POST['cep']);
                $state = addslashes($_POST['state']);
                $city = addslashes($_POST['city']);
                $phone = addslashes($_POST['phone']);
                $cellphone = addslashes($_POST['cellphone']);
                $email = addslashes($_POST['email']);
                $status = addslashes($_POST['status']);

                $c->add($u->getCompany(), $name, $cnpj, $phone, $address, $number, $bairro, $cep, $state, $city, $phone, $cellphone, $email, $status);
                header("Location: " . BASE_URL . "/provider");
            }

            $this->loadTemplate('provider_add', $data);
        } else {
            header("Location: " . BASE_URL . "/provider");
        }
    }

    public function edit($id)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        if ($u->hasPermission('provider_edit')) {
            $c = new Provider();

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                if (isset($_POST['name']) && !empty($_POST['name'])) {
                    $name = addslashes($_POST['name']);
                    $cnpj = addslashes($_POST['cnpj']);
                    $address = addslashes($_POST['address']);
                    $number = addslashes($_POST['number']);
                    $bairro = addslashes($_POST['bairro']);
                    $cep = addslashes($_POST['cep']);
                    $state = addslashes($_POST['state']);
                    $city = addslashes($_POST['city']);
                    $phone = addslashes($_POST['phone']);
                    $cellphone = addslashes($_POST['cellphone']);
                    $email = addslashes($_POST['email']);
                    $status = addslashes($_POST['status']);

                    $c->edit($id, $u->getCompany(), $name, $cnpj, $phone, $address, $number, $bairro, $cep, $state, $city, $phone, $cellphone, $email, $status);
                    header("Location: " . BASE_URL . "/provider");
                }

                $data['client_info'] = $c->getInfo($id, $u->getCompany());

                $this->loadTemplate('provider_edit', $data);
            } else {
                header("Location: " . BASE_URL . "/provider");
            }
        }

        /* public function delete($id) {

             echo "Falta fazer este método.";

         }*/

    }
}












