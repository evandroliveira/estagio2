<?php

namespace src\models;
use \core\Model;
/**
 * A classe Usuario é um modelo que representa a tabela de usuários no banco de dados.
 * Ela herda de uma classe base chamada Model, que provavelmente fornece métodos para
 * interagir com o banco de dados, como select, insert, etc.
 *
 * O método addAction é responsável por adicionar um novo usuário ao banco de dados.
 * Ele realiza as seguintes etapas:
 * - Obtém os dados do formulário (nome, email e senha) usando filter_input.
 * - Verifica se todos os campos obrigatórios foram preenchidos.
 * - Verifica se o email já está cadastrado no banco de dados.
 * - Caso o email não exista, insere o novo usuário no banco de dados com a senha criptografada.
 * - Redireciona o usuário para uma página com uma mensagem de sucesso ou erro.
 */
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
                echo "<script>alert('O email já está cadastrado!'); window.location.href='/backend/public/';</script>";
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
            echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='/backend/public/';</script>";
            global $base;
            header("Location: " . $base);
            exit;

        }
    }

    // Novo método para obter todos os usuários
    public function getAll() {
        $data = Usuario::select()->execute();
        return $data;
    }
   
}