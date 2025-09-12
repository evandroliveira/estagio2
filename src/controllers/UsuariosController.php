<?php
namespace src\controllers;

use \core\Controller;
use src\models\Usuario;


class UsuariosController extends Controller {

    public function add() {
        // Renderiza a view de novo usuário
        $this->render('/novo');
    }

    public function addAction() {
        $usuario = new Usuario();
        $usuario->addAction();
    }
   

   
}