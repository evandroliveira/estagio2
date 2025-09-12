<?php
namespace src\controllers;

use \core\Controller;


class HomeController extends Controller {

    public function index() {
        // Renderiza a view home
        $this->render('home');
    }

     public function login() {
        // Renderiza a view de login
        $this->render('login');
    }


}