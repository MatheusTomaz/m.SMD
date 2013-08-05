<?php
    require_once('../bean/bean.php');
    require_once('../dao/UsuarioDAO.php');
    
    class buscaHandler{
        
        public $relatorio, $msg, $numRes, $class;
        private $usuario, $usuarioDAO;
        
        function buscaHandler(){
            $this->usuarioDAO = new UsuarioDAO();
            
            $this->usuario = new Usuario();
            $this->usuario->setNome(utf8_decode($_POST['busca']));
            
            if(isset($_POST['acao'])){
                $this->buscarUsuario();
            }
                
        }
        
        function buscarUsuario(){
            $query = $this->usuarioDAO->buscarUsuario($this->usuario->getNome());
            $numRes = mysql_num_rows($query);
            $this->numRes = $numRes;
            if($numRes > 0){
                $this->relatorio .= "<table class='table table-hover' style='background:#F8F8F8;'>";
                $this->relatorio .= "<thead>";
                $this->relatorio .= "<tr>";
                $this->relatorio .= "<th style='text-align:center; vertical-align:middle;'>Conta</th>";
                $this->relatorio .= "<th style='vertical-align:middle;'>Nome</th>";
                $this->relatorio .= "<th style='text-align:center; vertical-align:middle;'>Saldo</th>";
                $this->relatorio .= "</thead>";
                
                while ($row = mysql_fetch_array($query)) {
                        $this->relatorio .= "<tr>";
                        $this->relatorio .= "<td style='text-align:center; vertical-align:middle;'>{$row['cod_usuario']}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row["nome"]}</td>";
                        $this->relatorio .= "<td style='text-align:center; vertical-align:middle;'>{$row['saldo']}</td>";
                        $this->relatorio .= "<td style='text-align:center; vertical-align:middle;'><a class='btn' href='extrato.php?&id={$row['cod_usuario']})'>Extrato</a></td>";
                        $this->relatorio .= "</tr>";
                }
               
            
                $this->relatorio .= "</table>";
                $this->class = "text-success";
                $this->msg = "Sua busca retornou <b>$numRes</b> resultado(s)";
                
            }else{
                $this->class = "text-error";
                $this->msg = "<b>Nenhum Resultado!</b>";
            }
        }
    }
?>
