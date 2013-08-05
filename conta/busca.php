<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    require_once('../handler/conta/buscaHandler.php');
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    $login = new LoginHandler();
    $login->verificar('Admin','Admin');
    
    $usuarioD = new buscaHandler();
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
    	<div class="hero-unit2">
            <h2 align="center">Pesquisa de Contas</h2>
            <br/>
            <br/>
            <div>
                <form class="form-search" name="usuario_cadastro" method="POST">
                    <div class="text-center">
                        <input type="hidden" name="acao" value="acao"/>
                        <input type="text" class="input-medium search-query" name="busca"/>
                        <input type="submit" class="btn" value="Pesquisa"/>
                        <input name="voltar" type="button" class="btn" value="Voltar" onClick="location.href='../assets/smd_principal.php'">
                    </div>    
                    <br/>
                    <div class="<?=$usuarioD->class;?>" align="center"><?=$usuarioD->msg;?></div>
                    <br>
                    <?=$usuarioD->relatorio;?>
                </form>
            </div>
        </div>    
    </body>
</html>
