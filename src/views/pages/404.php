<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Não Encontrada - 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: linear-gradient(135deg, #232526 0%, #414345 100%);
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            padding: 40px 30px;
            background: rgba(34, 34, 34, 0.85);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        .error-code {
            font-size: 7rem;
            font-weight: bold;
            letter-spacing: 10px;
            color: #ff6b6b;
            margin-bottom: 10px;
        }
        .message {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .home-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 32px;
            background: #ff6b6b;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s;
        }
        .home-link:hover {
            background: #ff4757;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <div class="message">Ops! Página não encontrada.</div>
        <div>A página que você procura não existe ou foi removida.</div>
        <a href="<?= $base; ?>/" class="home-link">Voltar para o início</a>
    </div>
</body>
</html>