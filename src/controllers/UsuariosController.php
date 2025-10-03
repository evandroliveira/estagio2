<?php
namespace src\controllers;

use \core\Controller;
use src\models\Usuario;

// Esta classe é responsável por controlar as ações relacionadas aos usuários.
// Ela herda funcionalidades da classe base Controller e utiliza o modelo Usuario
// para realizar operações como adicionar novos usuários e renderizar as views correspondentes.
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