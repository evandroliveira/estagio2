<?php

namespace src\models;
use \core\Model;

class Usuario extends Model
{
    public function addAction() {
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        
        if ($nome && $email && $senha) {
            // Aqui você pode adicionar o código para salvar o usuário no banco de dados
            $data = Usuario::select()->where('email', $email)->execute();
            if (!empty($data)) {
                // Email já existe, redirecionar com mensagem de erro
                echo "<script>alert('O email já está cadastrado!'); window.location.href='/backend/public/novo';</script>";
                exit;
            }
            if (count($data) === 0) {

                Usuario::insert([
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => password_hash($senha, PASSWORD_DEFAULT)
                ])->execute();
                


            } 
            //redirect para home com mensagem de sucesso
            header("Location: /backend/public/novo?status=success");
            exit;

        }
    }
   
}