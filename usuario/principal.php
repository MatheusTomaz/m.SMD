<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    $login = new LoginHandler();
    $login->verificar('Admin','User');
?>
<!DOCTYPE html>
<html>
    <script>
        function frameResize(){
            altura=document.documentElement.clientHeight-10;
            if (altura<200)
                altura=200;
            document.getElementById('frame').style.height = (altura) + "px";
        }
    </script>
    <head>
        <meta http-equiv="Content-Type" name="viewport" content="width=device-width, initial-scale=1.0; text/html; charset=utf-8">
        <title>SMD</title>
       	<link href="../assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
    </head>
    <body style="overflow:hidden;">
        <? include("../assets/menu.php"); ?>
        <div class="row" style="z-index:1; padding: 0 10% 0 10%;">
            <div class="hero-unit">
                <h1><br/>SEJA BEM-VINDO</h1>
                <p>
                    Este é um sistema com o intuito de trazer um controle maior as contas feitas entre amigos! 
                    Emprestou dinheiro? Cadastre aqui! Foi pago? Desconte aqui!
                </p>
            </div>
        </div>
    </body>
</html>
