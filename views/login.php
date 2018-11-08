<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="<?php echo BASE_URL; ?>/assets/css/login.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">

    </head>
    <body>
    <header>
        <video autoplay loop>
            <source src="<?php echo BASE_URL; ?>/assets/video/fundo.mp4" type="video/mp4">
        </video>
    </header>

                <div class="logoarea">
                    <h1>Cantinho Verde</h1>
                </div>

                <div class="loginarea" >
                    <form method="POST">
                        <input type="email" name="email" placeholder="Digite seu e-mail" autofocus style="background: transparent" />

                        <input type="password" name="password" placeholder="Digite sua senha" style="background: transparent" />

                        <input class="btn_login" type="submit" value="Entrar" style="background: #006600; color: white" /><br/>

                        <?php if(isset($error) && !empty($error)): ?>
                        <div class="warning"><?php echo $error; ?></div>
                        <?php endif; ?>
                    </form>
                </div>


    </body>
</html>