<?php
namespace src\controllers;

use \core\Controller;
use src\models\Usuario;


class HomeController extends Controller {

    public function index() {
        // Renderiza a view home
        $usuarios = new Usuario();
        $data = $usuarios->getAll();
        $this->render('home', [
            'data' => $data
        ]);
    }

    


}