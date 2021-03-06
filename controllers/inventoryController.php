<?php 
/**
 * 
 */
class inventoryController extends controller {
    
    function __construct() {
        parent::__construct();

        $u = new Users(); //verifica se o usuario está logado
        if ($u->isLogged() == false) {
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

        if($u->hasPermission('inventory_view')) {
            $i = new Inventory();
            $offset = 0; //paginação para quando tiver muitos produtos cadastrados

            $data['inventory_list'] = $i->getList($offset, $u->getCompany());

            //verificando se tem as duas permissões e add resultados nas variaveis add_permission e edit_permission
            $data['add_permission'] = $u->hasPermission('inventory_add');
            $data['edit_permission'] = $u->hasPermission('inventory_edit');

            $this->loadTemplate('inventory', $data);
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

         if($u->hasPermission('inventory_add')) {

            if (isset($_POST['name']) && !empty($_POST['name'])) {
                $i = new Inventory();# Adição dos itens
                # se houve envio dos dados
                $name = addslashes($_POST['name']);
                $price = addslashes($_POST['price']);
                $price_sale = addslashes($_POST['price_sale']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);
                #configurando a alteração do preço para ser inserido no banco corretamente
                $price = str_replace(',', '.', $price);
                $price_sale = str_replace(',', '.', $price_sale);
                #mandando os itens para $i
                $i->add($name, $price, $price_sale, $quant, $min_quant, $u->getCompany(), $u->getId());

                header("Location: ".BASE_URL."/inventory");
            }

            $this->loadTemplate('inventory_add', $data);
        }


    }

    public function edit($id) {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $company = new Companies($u->getCompany());
        $data['company_name'] = $company->getName();
        $data['user_email'] = $u->getEmail();

         if($u->hasPermission('inventory_edit')) {

            $i = new Inventory();# Adição dos itens

            if (isset($_POST['name']) && !empty($_POST['name'])) {                
                # se houve envio dos dados
                $name = addslashes($_POST['name']);
                $price = addslashes($_POST['price']);
                $price_sale = addslashes($_POST['price_sale']);
                $quant = addslashes($_POST['quant']);
                $min_quant = addslashes($_POST['min_quant']);
                #configurando a alteração do preço para ser inserido no banco corretamente substituindo a virgula pelo ponto
                $price = str_replace('.', '', $price);
                $price_sale = str_replace(',', '.', $price_sale);

               


                #mandando os itens para $i e usando a função edit
                $i->edit($id, $name, $price, $price_sale, $quant, $min_quant, $u->getCompany(), $u->getId());

                header("Location: ".BASE_URL."/inventory");
            }

            $data['inventory_info'] = $i->getInfo($id, $u->getCompany());

            $this->loadTemplate('inventory_edit', $data);
        }

    }

    public function delete($id) {
        #Verificar a permissão
        $u = new Users();
        $u->setLoggedUser();

         if($u->hasPermission('inventory_edit')) {
            #se existir a permissão
            $i = new Inventory();
            $i->delete($id, $u->getCompany(), $u->getId());
             header("Location: ".BASE_URL."/inventory");

        }
    }

}