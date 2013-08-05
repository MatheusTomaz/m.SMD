<?php
    require_once('../bean/bean.php');
    require_once('../dao/ContaDAO.php');
    
    class operacoesHandler{
        
        public $msg, $color, $nome;
        private $usuario, $contaDAO, $saldo;
    
        function operacoesHandler($id){
            
            $this->contaDAO = new ContaDAO();
            
            $this->usuario = new usuario();
            $this->usuario->setId($_GET['id']);
            $this->usuario->setDesc($_POST['descricao']);
            $this->usuario->setTipo($_POST['tipo']);
            $this->usuario->setValor($_POST['valor']);
            $this->usuario->setLogin($id);
            $this->saldo = 0;
            $this->buscarUsuario($this->usuario->getId());
            
            $this->buscaSaldo($id, $this->usuario->getId());
            
            if($_POST['descricao']==NULL){
                $this->msg .= "<div class='alert alert-warning text-center'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "O campo 'Descrição' está vazio!";
                $this->msg .= "</div>";
            }elseif($_POST['valor']==NULL){
                $this->msg .= "<div class='alert alert-warning text-center'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "O campo 'Valor' está vazio!";
                $this->msg .= "</div>";
            }else{
                if(isset($_POST['acao'])){
                    $this->cadastrar();
                }
            }
            
        }
        
        function buscarUsuario($id){
            $query = $this->contaDAO->buscarUsuario($id);
            $row = mysql_fetch_array($query);
            $this->nome = $row['nome'];
        }
                
        function cadastrar(){
            if(($this->usuario->getTipo() == 2) && ($this->usuario->getValor() > $this->saldo)){
                $this->msg .= "<div class='alert alert-warning text-center'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "O valor a ser pago é maior do que o  que você deve!";
                $this->msg .= "</div>";
            }else{
                $query = $this->contaDAO->cadastrar($this->usuario);
                if($query){
                    $this->msg .= "<div class='alert alert-success text-center'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "Cadastro realizado com sucesso!";
                    $this->msg .= "</div>";
                }else{
                    $this->msg .= "<div class='alert alert-error text-center'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "Erro ao Cadastrar!";
                    $this->msg .= "</div>";
                }
            }
        }
        
        function buscaSaldo($idOn, $idOff){
            $query = $this->contaDAO->operacaoId($idOn, $idOff);
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
            $query2 = $this->contaDAO->solicitacaoId($idOn,$idOff);
            while($row = mysql_fetch_array($query2)){
                if($row['cod_usuario_on']==$idOn && $row['tipoOperacao']==1){
                    $this->saldo = $this->saldo + $row['valor'];
                }elseif ($row['cod_usuario_on']==$idOn && $row['tipoOperacao']==2){
                    $this->saldo = $this->saldo - $row['valor'];
                }elseif ($row['cod_usuario_off']==$idOn && $row['tipoOperacao']==1){
                    $this->saldo = $this->saldo - $row['valor'];
                }elseif ($row['cod_usuario_off']==$idOn && $row['tipoOperacao']==2){
                    $this->saldo = $this->saldo + $row['valor'];
                }          
            }
        }
    }        
?>
