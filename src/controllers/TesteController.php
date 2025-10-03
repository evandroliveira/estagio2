<?php
namespace src\controllers;

use \core\Controller;
use src\models\Usuario;


class TesteController extends Controller {

    public function index() {
        // Renderiza para a view teste
        $this->render('teste');
    }


}