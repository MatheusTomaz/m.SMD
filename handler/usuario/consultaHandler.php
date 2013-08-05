<?php
    require_once('../bean/bean.php');
    require_once('../dao/UsuarioDAO.php');
    require_once('../class/string.class');
    
    class consultaHandler{
        
        public $relatorio, $msg, $numRes, $class;
        private $usuario, $usuarioDAO;
        
        function consultaHandler($grupo,$usuarioId){
            $this->usuarioDAO = new UsuarioDAO();
            
            $this->usuario = new Usuario();
            
            if($_POST['usuario_busca']==null){
                $nome = " ";
            }else{
                $nome = stringB($_POST['usuario_busca']);
            }
            $this->usuario->setNome($nome);
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $this->excluirUsuario($id);
            }
            
            if(isset($_POST['action'])){
                $this->buscarUsuario($grupo, $usuarioId);
                
            }
        }
        
        function buscarUsuario($grupo,$usuarioId){
            $query = $this->usuarioDAO->buscarUsuario($this->usuario->getNome());
            $numRes = mysql_num_rows($query);
            $this->numRes = $numRes;
            if($numRes > 0){
                $this->relatorio .= "<table class='table table-hover' style='background:#F8F8F8;'>";
                $this->relatorio .= "<thead>";
                $this->relatorio .= "<tr>";
                $this->relatorio .= "<th style='text-align:center; vertical-align:middle;'>Conta</th>";
                $this->relatorio .= "<th>Nome</th>";
                if($grupo == 'Admin'){
                    $this->relatorio .= "<th>Login</th>";
                    $this->relatorio .= "<th>E-mail</th>";
                    $this->relatorio .= "<th>Grupo</th>";
                    $this->relatorio .= "</tr>";
                    $this->relatorio .= "</thead>";
                    while ($row = mysql_fetch_array($query)) {
                        $this->relatorio .= "<tr>";
                        $this->relatorio .= "<td style='text-align:center; vertical-align:middle;'>{$row['cod_usuario']}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row["nome"]}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row['login']}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row['email']}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row['grupo']}</td>";
                        if($usuarioId != $row['cod_usuario']){
                            $this->relatorio .= "<td style='vertical-align:middle;'><a class='btn' href='../usuario/detalhes.php?&id={$row['cod_usuario']}'><i class='icon-plus-sign'></i></a></td>";
                            $this->relatorio .= "<td style='vertical-align:middle;'><a class='btn' href='../conta/operacoes.php?&id={$row['cod_usuario']}' title='Operações'><i class='icon-cog'></i></a></td>";
                            $this->relatorio .= "<td style='vertical-align:middle;'><a class='btn' href='javascript:del({$row['cod_usuario']})'><i class='icon-remove'></i></a></td>";
                        }else{
                            $this->relatorio .= "<td>&nbsp;</td>";
                            $this->relatorio .= "<td>&nbsp;</td>";
                            $this->relatorio .= "<td>&nbsp;</td>";
                        }
                        $this->relatorio .= "</tr>";
                    }
                }elseif($grupo == 'User') {
                    $this->relatorio .= "<th>E-mail</th>";
                    $this->relatorio .= "</tr>";
                    $this->relatorio .= "</thead>";
                    while ($row = mysql_fetch_array($query)) {
                        $this->relatorio .= "<tr>";
                        $this->relatorio .= "<td style='vertical-align:middle; text-align:center;'>{$row['cod_usuario']}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row["nome"]}</td>";
                        $this->relatorio .= "<td style='vertical-align:middle;'>{$row['email']}</td>";
                        if($usuarioId != $row['cod_usuario']){
                            $this->relatorio .= "<td style='vertical-align:middle;'><a class='btn' href='../usuario/detalhes.php?&id={$row['cod_usuario']}'><i class='icon-plus-sign'></i></a></td>";
                            $this->relatorio .= "<td style='vertical-align:middle;'><a class='btn' href='../conta/operacoes.php?&id={$row['cod_usuario']}' title='Operações'><i class='icon-cog'></i></a></td>";
                        }else{
                            $this->relatorio .= "<td>&nbsp;</td>";
                            $this->relatorio .= "<td>&nbsp;</td>";
                        }
                        $this->relatorio .= "</tr>";
                    }
                }
            
                $this->relatorio .= "</table>";
                $this->class = "text-success";
                $this->msg = "Sua busca retornou <b>$numRes</b> resultado(s)";
                
            }else{
                $this->class = "text-error";
                $this->msg = "<b>Nenhum Resultado!</b>";
            }
        }
        
        function excluirUsuario($id){
            $res = $this->usuarioDAO->excluirUsuario($id);
            if($res){
                $this->class = 'text-success';
                $this->msg = 'Usuário Excluído com sucesso!';
            }else{
                $this->class = 'text-error';
                $this->msg = 'Não foi possível excluir o usuário!';
            }
        }
    }
?>
