<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    require_once BASE_DIR . 'handler' . DS . 'usuario' . DS . 'confContaHandler.php';
    $login = new LoginHandler();
    $login->verificar('Admin','User');
    
    $usuarioD = new confHandler($login->id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SMD</title>
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../assets/bootstrap/jquery/jquery.js"></script>  
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script> 
    </head>
    <body>
        <? include("../assets/menu.php"); ?>
        <div class="hero-unit">
            <div class="text-center">
                <?=$usuarioD->msg;?>
                <h2><?=$usuarioD->usuario->getNome();?></h2>
                <br>
                <form action="alterarDados.php" method="POST">
                    <div class="input-prepend input-append">
                        <span style='width:2%;' class="add-on btn-primary">ID</span>
                        <input name="login" id="prependedInput" type="text" placeholder="<?=$usuarioD->usuario->getLogin();?>">
                        <button style='width:30%;' class="btn btn-primary" type="submit">Alterar</button>
                    </div>
                </form>
                <form action="alterarDados.php" method="POST">
                    <div class="input-prepend input-append">
                        <span style='width:2%;' class="add-on btn-primary">@</span>
                        <input name="email" id="prependedInput" type="text" placeholder="<?=$usuarioD->usuario->getEmail();?>">
                        <button style='width:30%;' class="btn btn-primary" type="submit">Alterar</button>
                    </div>
                </form>
                <form action="alterarDados.php" method="POST">
                    <div class="input-prepend input-append">
                        <span style='width:2%;' class="add-on btn-primary">cel</span>
                        <input name="telefone" id="prependedInput" type="text" placeholder="<?=$usuarioD->usuario->getTelefone();?>">
                        <button style='width:30%;' class="btn btn-primary" type="submit">Alterar</button>
                    </div>
                </form>
                <form action="alterarDados.php" method="POST">
                    <div class="input-prepend input-append">
                        <span style='width:15%;' class="add-on btn-primary">Senha</span>
                        <input class="span2" id="prependedInput" name="senha"type="password" placeholder="●●●●●●●●">
                        <input class="span2" id="prependedInput" name="confSenha" type="password" placeholder="●●●●●●●●">
                        <button style='width:21%;' class="btn btn-primary" type="submit">Alterar</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
