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

    public function index($return = null)
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

        $data['return'] = (isset($return)) ? $return : '';

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
                $address_number = addslashes($_POST['address_number']);
                $address2 = addslashes($_POST['address2']);
                $address_neighb = addslashes($_POST['address_neighb']);
                $address_zipcode = addslashes($_POST['address_zipcode']);
                $address_state = addslashes($_POST['$address_state']);
                $address_city = addslashes($_POST['address_city']);
                $address_country = addslashes($_POST['address_country']);
                $phone = addslashes($_POST['phone']);
                $cellphone = addslashes($_POST['cellphone']);
                $email = addslashes($_POST['email']);
                $stars = addslashes($_POST['stars']);
                $internal_obs = addslashes($_POST['internal_obs']);


                $c->add($u->getCompany(), $name, $email, $phone, $cellphone, $cnpj, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country);
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
            $p = new Provider();
            if (isset($_POST['name']) && !empty($_POST['name'])) {
                    $name = addslashes($_POST['name']);
                    $cnpj = addslashes($_POST['cnpj']);
                    $address = addslashes($_POST['address']);
                    $address2 = addslashes($_POST['address2']);
                    $internal_obs = addslashes($_POST['internal_obs']);
                    $address_number = addslashes($_POST['address_number']);
                    $address_neighb = addslashes($_POST['address_neighb']);
                    $address_zipcode = addslashes($_POST['address_zipcode']);
                    $address_state = addslashes($_POST['$address_state']);
                    $address_city = addslashes($_POST['address_city']);
                    $address_country = addslashes($_POST['address_country']);
                    $phone = addslashes($_POST['phone']);
                    $cellphone = addslashes($_POST['cellphone']);
                    $email = addslashes($_POST['email']);
                    $stars = addslashes($_POST['stars']);

                    $p->edit($u->getCompany(), $name,  $email, $phone, $cellphone, $cnpj, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2,  $address_neighb, $address_city, $address_state, $address_country);
                    header("Location: " .BASE_URL. "/provider");
                }


                $data['provider_info'] = $p->getInfo($id, $u->getCompany());

                $this->loadTemplate('provider_edit', $data);

            } else {
                header("Location: " .BASE_URL. "/provider");
            }
        }



    public function delete($id)
    {

        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();


        if ($u->hasPermission('provider_delete')) {
            $p = new Provider();
            $return = $p->deleteProvider($id, $u->getCompany());

            $this->index($return);
//            $this->loadTemplate('clients_delete', $data);
        } else {
            header("Location: " . BASE_URL . "/provider");
        }

    }
}












