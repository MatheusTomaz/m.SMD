<?php
    require_once('../bean/bean.php');
    require_once('../dao/ContaDAO.php');
    require_once('../class/Data.class');
    
    class detalhesHandler{
        
        public $saldo, $nome, $numRes, $relatorio, $painel;
        private $contaDAO, $data;
        
        function detalhesHandler($idOn){
            $this->data = new data();
            $this->contaDAO = new ContaDAO();
            $this->saldo = 0;
            
            $idOff = $_GET['id'];
            
            $this->buscaSaldo($idOn, $idOff);
            $this->buscarUsuario($idOff);
            $this->rel();
            if(isset($_POST['op'])){
                $this->operacaoId($idOn, $idOff);
            }
        }
        
        function buscarUsuario($id){
            $query = $this->contaDAO->buscarUsuario($id);
            $row = mysql_fetch_array($query);
            $this->nome = $row['nome'];
        }
        
        function buscaSaldo($idOn, $idOff){
            $query = $this->contaDAO->operacaoId($idOn, $idOff);
            $this->numRes = mysql_num_rows($query);
            while($row = mysql_fetch_array($query)){
                if($row['cod_usuario_on']==$idOn && $row['tipoOperacoes']==1){
                    $this->saldo = $this->saldo + $row['valor'];
                }elseif ($row['cod_usuario_on']==$idOn && $row['tipoOperacoes']==2){
                    $this->saldo = $this->saldo - $row['valor'];
                }elseif ($row['cod_usuario_off']==$idOn && $row['tipoOperacoes']==1){
                    $this->saldo = $this->saldo - $row['valor'];
                }elseif ($row['cod_usuario_off']==$idOn && $row['tipoOperacoes']==2){
                    $this->saldo = $this->saldo + $row['valor'];
                }          
            }
        }
        
        function rel(){
            if($this->saldo < 0){
                $this->painel .= "<div style='width:20%; margin-left: 5%; position:relative; float: left;' class='panel panel-danger text-center'>";
                $this->painel .= "<div class='panel-heading'>DEVO</div>";
                $this->painel .= "<span class='text-danger'>R$ $this->saldo<br><br>";
                $this->painel .= "<input type='submit' class='btn btn-danger' value='Listar Operações' name='op'/>";
                $this->painel .= "</span>";
                $this->painel .= "</div>";
            }elseif($this->saldo > 0){
                $this->painel .= "<div style='width:20%; margin-left: 5%; position:relative; float: left;' class='panel panel-success text-center'>";
                $this->painel .= "<div class='panel-heading'>DEVE</div>";
                $this->painel .= "<span class='text-success'>R$ $this->saldo<br><br>";
                $this->painel .= "<input type='submit' class='btn btn-success' value='Listar Operações' name='op'/>";
                $this->painel .= "</span>";
                $this->painel .= "</div>";
            }else{
                $this->painel .= "<div style='width:20%; margin-left: 5%; position:relative; float: left;' class='panel panel-primary text-center'>";
                $this->painel .= "<div class='panel-heading'>OK</div>";
                $this->painel .= "<span class='text-success'>R$ $this->saldo<br><br>";
                $this->painel .= "<input type='submit' class='btn btn-primary' value='Listar Operações' name='op'/>";
                $this->painel .= "</span>";
                $this->painel .= "</div>";
            }
        }
        
        function operacaoId($idOn, $idOff){
            $query = $this->contaDAO->operacaoId($idOn, $idOff);
            if(mysql_num_rows($query)!=0){
                $this->relatorio .= "<div style='float:left; width:60%; margin-left: 5%; position:relative;' class='panel panel-primary'>";
                $this->relatorio .= "<div class='panel-heading'>Operações</div>";
                $this->relatorio .= "<table class='table table-hover' style='background:#F8F8F8;'>";
                while ($row = mysql_fetch_array($query)) {
                    if($row['cod_usuario_on']==$idOn && $row['tipoOperacoes']==1){
                        $tipo = "Emprestei";
                        $class = "success";
                    }elseif($row['cod_usuario_on']==$idOn && $row['tipoOperacoes']==2){
                        $tipo = "Paguei";
                        $class = "danger";
                    }elseif($row['cod_usuario_off']==$idOn && $row['tipoOperacoes']==1){
                        $tipo = "Emprestou";
                        $class = "danger";
                    }elseif($row['cod_usuario_off']==$idOn && $row['tipoOperacoes']==2){
                        $tipo = "Pagou";
                        $class = "success";
                    }
                    $this->relatorio .= "<tr class='$class'>";
                    $this->relatorio .= "<td>{$this->data->formata_data($row['data_operacao'])}</td>";
                    $this->relatorio .= "<td>{$tipo}</td>";
                    $this->relatorio .= "<td>R$ {$row['valor']}</td>";
                    $this->relatorio .= "<td>{$row['descricao']}</td>";
                    $this->relatorio .= "</tr>";
                }
                $this->relatorio .= "</table>";
                $this->painel .= "</div>";
            }else{
                $this->msg .= "<div class='alert alert-error'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "<b>Não há operações!</b>";
                $this->msg .= "</div>";  
            }
        }
    }
?>
