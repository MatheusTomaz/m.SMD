<?php
    require_once('../bean/bean.php');
    require_once('../dao/UsuarioDAO.php');
    
    class cadastroHandler{
        
        public $msg, $class;
        
        private $usuario, $usuarioDAO;
    
        function cadastroHandler(){
            
            $this->usuarioDAO = new UsuarioDAO();
            
            $this->usuario = new usuario();
            $this->usuario->setNome(utf8_decode($_POST['nome']));
            $this->usuario->setLogin($_POST['login']);
            $this->usuario->setSenha($_POST['senha']);
            $this->usuario->setEmail($_POST['email']);
            $this->usuario->setTelefone($_POST['telefone']);
            $this->usuario->setGrupo($_POST['grupo']);
            
            if(isset($_POST['acao'])){
                $this->cadastrar();
            }
        }
        
        function validarDados(){
            $res = $this->usuarioDAO->recuperarUsuario($this->usuario->getLogin(), $this->usuario->getEmail());
            return (mysql_num_rows($res)>0);
        }
                
        function cadastrar(){
            if(!$this->validarDados()){
                $query = $this->usuarioDAO->cadastrar($this->usuario);
                if($query){
                    $this->msg .= "<div class='alert alert-success'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "<b>Cadastro realizado com sucesso!</b>";
                    $this->msg .= "</div>";
                }else{
                    $this->msg .= "<div class='alert alert-error'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "<b>Erro no Cadastro!</b>";
                    $this->msg .= "</div>";
                }
            }else{
                $this->msg .= "<div class='alert alert-error'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "<b>Login/E-mail já existente!</b>";
                $this->msg .= "</div>";
            }
        }
    }
?>
