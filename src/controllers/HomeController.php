<?php
namespace src\controllers;

use \core\Controller;
use src\models\Usuarios;


class HomeController extends Controller {

    public function index() {
        $this->render('home');
    }

    public function fotos() {
        echo 'Aqui estão as fotos';
        
    }

}