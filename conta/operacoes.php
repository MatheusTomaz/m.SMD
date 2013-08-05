<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    require_once('../handler/conta/operacoesHandler.php');
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    $login = new LoginHandler();
    $login->verificar('Admin','User');
    
    $usuarioD = new operacoesHandler($login->id);
?>
<!DOCTYPE html>
<script type="text/javascript" src="../assets/bootstrap/jquery/jquery.js"></script>  
<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>  
<script type="text/javascript">
    $(".alert").alert();
</script>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SMD</title>
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />  
    </head>
    <body>
        <? include("../assets/menu.php"); ?>
    	<div class="hero-unit2">
            <h2 align="center">Operações</h2>
            <?=$usuarioD->msg;?>
            <form name="usuario_cadastro" action="operacoes.php?&id=<?=$_GET['id']?>" method="POST">
                <table align='center'>
                    <tr>
                        <td align='center' colspan='5'><h3 style='color:#0066FF;'><?=$usuarioD->nome;?></h3></td>
                    </tr>
                    <tr>
                        <td align='center' colspan='5'>
                            <select name='tipo'>
                                <option value="1">Emprestei</option>
                                <option value="2">Paguei</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Descrição:</b><br>
                            <input name="descricao" type="text" size="60">
                        </td>
                        <td><b>Valor:</b><br>
                            <input name="valor" type="text" size="60">
                        </td>
                    </tr>
                </table>
                <div align="center">
                    <input type='hidden' value='acao' name='acao'/>
                    <input name="gravar" value="Gravar" class="btn" type="submit">
                    <input name="voltar" value="Voltar" class="btn" type="button" onClick="location.href='../assets/SMD_principal.php'">
                </div>
                <br/>
            </form>
        </div>
    </body>
</html>
