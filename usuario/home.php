<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    
    require_once('../handler/usuario/homeHandler.php');
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    $login = new LoginHandler();
    $login->verificar('Admin','User');
            
    $usuarioD = new homeHandler($login->id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SMD</title>
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="../assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    </head>
    <body class="fundo">
    	<div class="hero-unit">
            <h1><?=$login->nome;?></h1>
            <br/>
                Saldo:<br/><input type="text" disabled value="R$ <?=$usuarioD->saldo;?>" style="color:<?=$usuarioD->color;?>;"> <button class="btn" style="vertical-align:top;" type="button" onClick="location.href='../conta/extrato.php'" name="extrato">Extrato</button>
            <br/>
            <hr/>
        </div>
        <div class="panel panel-success" style="width:40%; margin-left:60px; float: left;">
            <div class="panel-heading">
                QUEM ME DEVE?
            </div>
            <?=$usuarioD->relatorio1;?>
        </div>
        <div class="panel panel-danger" style="width:40%; margin-right:60px; float: right;">
            <div class="panel-heading">
                PRA QUEM EU DEVO?
            </div>
            <?=$usuarioD->relatorio2;?>
        </div>
    </body>
</html>
