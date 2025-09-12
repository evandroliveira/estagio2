<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 400px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);}
        h2 { text-align: center; margin-bottom: 20px; }
        label { display: block; margin-top: 15px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;
        }
        button { margin-top: 20px; width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer;}
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Novo Usuário</h2>
        <form action="<?=$base;?>/novo" method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
        <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
            <p style="color: green; text-align: center; margin-top: 20px;">Cadastro realizado com sucesso!</p>
        <?php endif; ?>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'email_exists'): ?>
            <p style="color: red; text-align: center; margin-top: 20px;">Erro: E-mail já cadastrado!</p>
        <?php endif; ?>
    </div>
</body>
</html>