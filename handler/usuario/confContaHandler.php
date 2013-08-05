<?php
    require_once('../bean/bean.php');
    require_once('../dao/UsuarioDAO.php');
    
    class confHandler{
        
        public $relatorio, $msg, $numRes, $class, $usuario;
        private $usuarioDAO;
        
        function confHandler($id){
            $this->usuarioDAO = new UsuarioDAO();
            
            $this->usuario = new Usuario();
            $this->usuario->setId($id);
            $this->buscarUsuario();
            
            if(isset($_POST['login'])){
                $login = $_POST['login'];
                if(!$this->validarDados($login, 0)){
                    $this->alterarUsuario('login', $login, $id);
                }else{
                    $this->msg .= "<div class='alert alert-error'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "<b>Login já existente!</b>";
                    $this->msg .= "</div>";
                }
            }
            if(isset($_POST['email'])){
                $email = $_POST['email'];
                if(!$this->validarDados(0, $email)){
                    $this->alterarUsuario('email', $email, $id);
                }else{
                    $this->msg .= "<div class='alert alert-error'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "<b>E-mail já existente!</b>";
                    $this->msg .= "</div>";
                }
            }
            if(isset($_POST['telefone'])){
                $telefone = $_POST['telefone'];
                $this->alterarUsuario('telefone', $telefone, $id);
            }
            if(isset($_POST['senha']) && isset($_POST['confSenha'])){
                $senha = $_POST['senha'];
                $confirmacao = $_POST['confSenha'];
                if($senha == $confirmacao){
                    $this->alterarUsuario('senha', $senha, $id);
                }else{
                    $this->msg .= "<div class='alert alert-error'>";
                    $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                    $this->msg .= "<b>Senha não Confirmada!</b>";
                    $this->msg .= "</div>";
                }
            }
        }
        
        function buscarUsuario(){
            $query = $this->usuarioDAO->buscarID($this->usuario->getId());
            if(!$query){
                $this->msg .= "<div class='alert alert-error'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "<b>Não foi possível obter dados do usuário!</b>";
                $this->msg .= "</div>";
            }
            $row = mysql_fetch_array($query);
            $this->usuario->setNome($row['nome']);
            $this->usuario->setLogin($row['login']);
            $this->usuario->setEmail($row['email']);
            $this->usuario->setTelefone($row['telefone']);
        }
        
        function validarDados($login, $email){
            $res = $this->usuarioDAO->recuperaLoginEmail($login, $email, $this->usuario->getId());
            return (mysql_num_rows($res)>0);
        }
                
        function alterarUsuario($campo, $valor, $id){
            $query = $this->usuarioDAO->alterarUsuario($campo, $valor, $id);
            if($query){
                $this->msg .= "<div class='alert alert-success'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "<b>Alteração realizada com sucesso!</b>";
                $this->msg .= "</div>";
            }else{
                $this->msg .= "<div class='alert alert-error'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "<b>Erro ao atualizar!</b>";
                $this->msg .= "</div>";
            }
        }
        
    }
?>
