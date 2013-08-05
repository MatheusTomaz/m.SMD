<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( dirname( __FILE__ ) )) . DS );
    
    require_once BASE_DIR . 'dao' . DS . 'UsuarioDAO.php';
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';

    $login = new LoginHandler();
    $usuarioD = new UsuarioDAO();
    
    $query = $usuarioD->selecionaID($login->id);
    $row = mysql_fetch_array($query);
    if($row['saldo'] >= 0){
        $saldoU .= "<span style='color:#00CC00'>R$ {$row['saldo']}</span>";
    }else{
        $saldoU .= "<span style='color:#FF0000'>R$ {$row['saldo']}</span>";
    }
?>
