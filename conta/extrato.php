<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    require_once BASE_DIR . 'handler' . DS . 'conta' . DS . 'extratoHandler.php';
    
    $login = new LoginHandler();
    $login->verificar('Admin','User');
    
    $usuarioD = new extratoHandler($login->id);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SMD</title>
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" /> 
        <script type="text/javascript" src="../assets/bootstrap/jquery/jquery.js"></script>  
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script> 
        <script language="JavaScript" type="text/javascript">
            function mascaraData(campoData){
                var data = campoData.value;
                if (data.length == 2){
                    data = data + '/';
                    document.form.data_inicio.value = data;
                    return true;
                }
                if (data.length == 5){
                    data = data + '/';
                    document.form.data_inicio.value = data;
                    return true;
                }
            }
            function mascaraData2(campoData){
                var data = campoData.value;
                if (data.length == 2){
                    data = data + '/';
                    document.form.data_fim.value = data;
                    return true;
                }
                if (data.length == 5){
                    data = data + '/';
                    document.form.data_fim.value = data;
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <? include("../assets/menu.php"); ?>
        <div class="hero-unit2">
            <h2 align="center">Extrato</h2>
        </div>
        <br/>
        <br/>
        <div>
            <form name="form" action="extrato.php" method="POST">
                <div class="text-center">
                    <div class="input-prepend input-append">
                        <span style="width:15%" class="add-on">De:</span>
                        <input name="data_inicio" maxlength="10" OnKeyUp="mascaraData(this);" id="prependedInput" class="input-small search-query" type="text">
                        <span style="width:2%" class="add-on"><i class="icon-calendar"></i></span>
                    </div>
                    <div class="input-prepend input-append">
                        <span style="width:20%" class="add-on">Até:</span>
                        <input name="data_fim" maxlength="10" OnKeyUp="mascaraData2(this);" id="prependedInput" class="input-small search-query" type="text">
                        <span style="width:2%" class="add-on"><i class="icon-calendar"></i></span>
                    </div>
                    <div>
                        <button class="btn" type="submit">Buscar</button>
                    </div>
                    <input type="hidden" value="getUsuario" name="acao"/>
                
                <br/>
                <div class="<?=$usuarioD->class;?>" align="center"><?=$usuarioD->msg;?></div>
                <br>
                <?=$usuarioD->relatorio;?>
            </form>
        </div> 
    </body>
</html>
