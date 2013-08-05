<?php
    class UsuarioDAO{
        
        public function UsuarioDAO(){
                        
        }
        
        public function recuperarUsuario($login, $email){
            $query = mysql_query("SELECT * FROM usuario WHERE login = '$login' OR email = '$email'");
            return $query;
        }
        
        public function recuperaLoginEmail($login, $email){
            $query = mysql_query("SELECT * FROM usuario WHERE (login = '$login' OR email = '$email') and cod_usuario != '$id'");
            return $query;
        }

        public function cadastrar($usuario){
            $nome = utf8_encode($usuario->getNome());
            $query = mysql_query("INSERT INTO usuario VALUES (null,
            '$nome',
            '{$usuario->getLogin()}',
            '{$usuario->getSenha()}',
            '{$usuario->getEmail()}',
            '{$usuario->getTelefone()}',
            '{$usuario->getGrupo()}', 0, 1)");
            
            return $query;
        }
        
        public function buscarUsuario($nome){
            $query = mysql_query("SELECT * FROM usuario WHERE nome REGEXP '$nome' and nome != 'Administrador' and IDativo = 1");
            return $query;
        }
        
        public function excluirUsuario($id){
            $query = mysql_query("UPDATE usuario SET IDativo = 0 WHERE cod_usuario = $id");
            return $query;
        }
        
        public function selecionaID($id){
            $query = mysql_query("SELECT * FROM usuario WHERE cod_usuario = '$id'");
            return $query;
        }
        
        public function buscarID($id){
            $query = mysql_query("SELECT * FROM usuario WHERE cod_usuario = $id");
            return $query;
        }
        
        public function alterarUsuario($campo, $valor, $id){
            $query = mysql_query("UPDATE usuario SET $campo = '$valor' where cod_usuario = '$id' ");
            
            return $query;
        }
        
    }
?>
