<?php
class cartController extends controller {

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

        if($u->hasPermission('psckttransparente_view')) {
            $store = new Store();
            $products = new Products();
            $cart = new Cart();
            $cep = '';
            $shipping = array();

            if(!empty($_POST['cep'])) {
                $cep = intval($_POST['cep']);

                $shipping = $cart->shippingCalculate($cep);
                $_SESSION['shipping'] = $shipping;
            }

            if(!empty($_SESSION['shipping'])) {
                $shipping = $_SESSION['shipping'];
            }

            if(!isset($_SESSION['cart']) || (isset($_SESSION['cart']) && count($_SESSION['cart']) == 0)) {
                header("Location: ".BASE_URL);
                exit;
            }

            $dados = $store->getTemplateData();

            $dados['shipping'] = $shipping;
            $dados['list'] = $cart->getList();

            $this->loadTemplate('cart', $dados);

            $data = $store->getTemplateData();

            $this->loadTemplate('cart_psckttransparente', $data);
        } else {
            header("Location: ".BASE_URL);
        }
    }







    public function del($id) {
        if(!empty($id)) {
            unset($_SESSION['cart'][$id]);
        }

        header("Location: ".BASE_URL."cart");
        exit;
    }

    public function add() {

        if(!empty($_POST['id_product'])) {
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);

            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $qt;
            } else {
                $_SESSION['cart'][$id] = $qt;
            }
        }

        header("Location: ".BASE_URL."cart");
        exit;

    }

    public function payment_redirect() {

        if(!empty($_POST['payment_type'])) {
            $payment_type = $_POST['payment_type'];

            switch($payment_type) {
                case 'checkout_transparente':
                    header("Location: ".BASE_URL."psckttransparente");
                    exit;
                    break;
            }


        }

        header("Location: ".BASE_URL."cart");
        exit;
    }




















}