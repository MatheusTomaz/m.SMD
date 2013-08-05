<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( __FILE__ )) . DS );
    
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    require_once BASE_DIR . 'handler' . DS . 'menuHandler.php';
    require_once BASE_DIR . 'handler' . DS . 'usuario' . DS . 'homeHandler.php';
    require_once BASE_DIR . 'handler' . DS . 'usuario' . DS . 'solicitacaoHandler.php';

    $menuLogin = new LoginHandler();
    $menuLogin->verificar('Admin','User');
    $menu = new menuHandler($login->grupo);
    $menuSaldo = new homeHandler($login->id);
    $menuDAO = new solicitacaoHandler();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>SMD</title>
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />  
        <link href="../assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />  
        <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/component.css" />
        <script src="../assets/bootstrap/js/modernizr.custom.js"></script>
        <script type="text/javascript">
        function del(id,file) {    
            if (confirm('Cancelar Solicitação?')) {    
                location.href =  '<?echo $_SELF_PHP;?>?&acao=0&solicitacao=' + id;  
            }  
        }  
        </script>
    </head>
    <body class="cbp-spmenu-push">
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <div class='barra' style="z-index:100;">&nbsp;</div>
            <h2>
                <?=$menuLogin->nome;?><br>
                <span style="font-size:0.6em; color: #FFF;">Saldo: <?=$menuSaldo->saldo;?></span>&nbsp;&nbsp;&nbsp;
                <a class="btn btn-inverse" type="button" href='../conta/extrato.php' name="extrato" target="frame">Extrato</a>
            </h2>
            <a class='a1' href="#" id="showRight"><span style="color:#4EEE94;">●</span> Quem me deve?</a>
            <a class='a1' href="#" id="showRight1"><span style="color:#FF6A6A;">●</span> Pra quem eu devo?</a>
            
            <a class='a1' href="../usuario/confConta.php" target="frame">Configurações de Conta</a>
            
            <div style="bottom:0; position:absolute; z-index:1; width: 100%;">
                <a class='a1' class='btn btn-inverse' href="principal.php?logout=1"><i class="icon-white icon-off"></i> &nbsp;&nbsp;&nbsp;Sair</a>
            </div>
        </nav>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
            <h2>Quem me deve?</h2>
            <?=$menuSaldo->relatorio1?>
        </nav>
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s5">
            <h2>Pra quem eu devo?</h2>
            <?=$menuSaldo->relatorio2?>
        </nav>
        <nav class="cbp-spmenu cbp-spmenu-horizontal cbp-spmenu-top" id="cbp-spmenu-s3">
            <div style='padding: 20px 0 20px 0; text-align: center;overflow:auto; width:100%; height: 100px;'>
                <? include BASE_DIR . 'handler' . DS . 'usuario' . DS . 'buscaSolicitacao.php';?>
            </div>
        </nav>
        <div class="navbar navbar-inverse"> 
            <div class="navbar-inner">
                <div class="container">  
                    <div style='float:left;'>
                        <button class='btn btn-inverse' id="showLeftPush"><i class='icon-white icon-list'></i></button>
                    </div> 
                    <div style='margin-left:10%;'>
                    <ul class="nav">
                        <a class="brand" href="../usuario/principal.php" target="frame"><b>SMD</b></a>  
                        <?=$menu->menu;?>
                    </ul>  
                    </div>
                    <div style='float: right; margin-right: 10%;'>
                        <a class='btn btn-inverse' href="#" id="showTopPush">Solicitações <?=$menuNum;?></a>
                    </div>
                </div>  
            </div>  
        </div>
        <script src="../assets/bootstrap/js/classie.js"></script>
        <script src="../assets/bootstrap/js/menu.js"></script>
    </body>
</html>
