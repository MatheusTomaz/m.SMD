<?php
    define( 'DS', DIRECTORY_SEPARATOR );
    define( 'BASE_DIR', dirname(dirname( dirname( __FILE__ ) )) . DS );
    
    require_once BASE_DIR . 'bean' . DS . 'bean.php';
    require_once BASE_DIR . 'dao' . DS . 'ContaDAO.php';
    require_once BASE_DIR . 'handler' . DS . 'logarHandler.php';
    
        
            $menuId = new LoginHandler();
            $menuContaDAO = new ContaDAO();
            $menuQuery = $menuContaDAO->buscaSolicitacao($menuId->id);
            $menuNum = mysql_num_rows($menuQuery);
            if($menuNum == 0){
                $menuNum = "";
            }else{
                $menuNum = "<span class='badge'>$menuNum</span>";
            }
            while($row = mysql_fetch_array($menuQuery)){
                if($row['descricaoTipo'] == "Empréstimo"){
                    $menuTipo = "emprestou-lhe";
                }else{
                    $menuTipo = "pagou-lhe";
                }
                $menuRelatorio .= "<div class='solicita'>";
                $menuRelatorio .= "<div style='width:30%;float:left;'>{$row['nome']}</div>";
                $menuRelatorio .= "<div style='width:15%;float:left;'>{$menuTipo}</div>";
                $menuRelatorio .= "<div style='width:15%;float:left;'>R$ {$row['valor']}</div>";
                $menuRelatorio .= "<div style='width:15%;float:left;'>{$row['descricao']}</div>";
                //$this->relatorio .= "<td>{$row['data_operacao']}</td>";
                $menuRelatorio .= "<div style='width:12.5%;float:left;'><a class='btn btn-success' name='confirmar' title='Confirmar' href='principal.php?&acao=1&solicitacao={$row['cod_solicitacao']}'><i class='icon-ok'></i></a></div>";
                $menuRelatorio .= "<div style='width:12.5%;float:left;'><a class='btn btn-danger' name='cancelar' title='Cancelar' href='javascript:del({$row['cod_solicitacao']})'><i class='icon-remove'></i></a></div>";
                $menuRelatorio .= "</div>";
            }
            echo $menuRelatorio;
?>