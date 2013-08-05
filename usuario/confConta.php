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
    </head>
    <body>
        <? include("../assets/menu.php"); ?>
        <div class="hero-unit">
            <div class="text-center">
            <?=$usuarioD->msg;?>
            <h2><?=$usuarioD->usuario->getNome();?></h2>
            <br>
            <div class="input-prepend input-append">
                <span style='width:2%;' class="add-on btn-primary">ID</span>
                <input class="" id="prependedInput" type="text" disabled value="<?=$usuarioD->usuario->getLogin();?>">
            </div>
            <br>
            <div class="input-prepend input-append">
                <span style='width:2%;' class="add-on btn-primary">@</span>
                <input class="" id="prependedInput" type="text" disabled value="<?=$usuarioD->usuario->getEmail();?>">
            </div>
            <br>
            <div class="input-prepend input-append">
                <span style='width:2%;' class="add-on btn-primary">cel</span>
                <input class="" id="prependedInput" type="text" disabled value="<?=$usuarioD->usuario->getTelefone();?>">
            </div>
            <br>
            <div class="input-prepend input-append">
                <span style='width:15%;' class="add-on btn-primary">Senha</span>
                <input class="" id="prependedInput" type="text" disabled value="●●●●●●●●">
            </div>
            <br>
            <a class="btn btn-primary" href="alterarDados.php" target="frame">Alterar Dados</a>
            </div>
        </div>
    </body>
</html>
