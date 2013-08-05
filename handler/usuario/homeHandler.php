<?php
    require_once('../bean/bean.php');
    require_once('../dao/UsuarioDAO.php');
    require_once('../dao/ContaDAO.php');
    
    class homeHandler{
        
        public $saldo, $color, $relatorio1,$relatorio2;
        private $usuario, $usuarioDAO, $contaDAO;
        
        function homeHandler($id){
            $this->usuarioDAO = new UsuarioDAO();
            $this->contaDAO = new ContaDAO();
            
            $this->usuario = new Usuario();
            $this->usuario->setId($id);
            
            $this->buscarUsuario();
            
            $this->buscaTodos($id);
        }
        
        function buscarUsuario(){
            $query = $this->usuarioDAO->selecionaID($this->usuario->getId());
            $row = mysql_fetch_array($query);
            if($row['saldo'] >= 0){
                $this->saldo .= "<span style='color:#00CC00'>R$ {$row['saldo']}</span>";
            }else{
                $this->saldo .= "<span style='color:#FF0000'>R$ {$row['saldo']}</span>";
            }
        }
        
        function buscaTodos($id){
            $query = $this->contaDAO->buscaTodos();
            $tamanho = mysql_num_rows($query);
            $i=0;
            while($row = mysql_fetch_array($query)){
                $codigo[$i] = $row['cod_usuario'];
                $i++;
            }
            $this->relatorio1 .= "<table class='table table-hover' style='background:#F8F8F8;'>";
            $this->relatorio2 .= "<table class='table table-hover' style='background:#F8F8F8;'>";
            foreach ($codigo as $key => $valor){
                for($j=$key+1;$j<$tamanho;$j++){
                    $query = $this->contaDAO->operacaoId($valor,$codigo[$j]);
                    $num = mysql_num_rows($query);
                    //echo $valor . ' - ' . $codigo[$j] . '<br>';
                    while ($row = mysql_fetch_array($query)){
                        if($row['cod_usuario_on']==$id && $row['tipoOperacoes']==1){
                            $saldo = $saldo + $row['valor'];
                        }elseif ($row['cod_usuario_on']==$id && $row['tipoOperacoes']==2){
                            $saldo = $saldo - $row['valor'];
                        }elseif ($row['cod_usuario_off']==$id && $row['tipoOperacoes']==1){
                            $saldo = $saldo - $row['valor'];
                        }elseif ($row['cod_usuario_off']==$id && $row['tipoOperacoes']==2){
                            $saldo = $saldo + $row['valor'];
                        }          
                        if($row['cod_usuario_on'] != $id){
                            $cod = $row['cod_usuario_on'];
                        }
                        if($row['cod_usuario_off'] != $id){
                            $cod = $row['cod_usuario_off'];
                        }
                    }
                    if($saldo > 0){
                        $query2 = $this->contaDAO->buscarUsuario($cod);
                        $row2 = mysql_fetch_array($query2);
                        $this->relatorio1 .= "<tr class='success'>";
                        $this->relatorio1 .= "<td>{$row2['nome']}</td>";
                        $this->relatorio1 .= "<td>R$ {$saldo}</td>";
                        $this->relatorio1 .= "</tr>";
                    }elseif($saldo < 0){
                        $query2 = $this->contaDAO->buscarUsuario($cod);
                        $row2 = mysql_fetch_array($query2);
                        $this->relatorio2 .= "<tr class='error'>";
                        $this->relatorio2 .= "<td>{$row2['nome']}</td>";
                        $this->relatorio2 .= "<td>R$ {$saldo}</td>";
                        $this->relatorio2 .= "</tr>";
                    }
                    $saldo = 0;
                    $cod = 0;
                }
            }
            $this->relatorio1 .= "</table>";
            $this->relatorio2 .= "</table>";
        }
         
        
        function buscaExtrato($data_inicio, $data_fim){
            $query = $this->contaDAO->buscaExtrato($this->usuario->getId(),$data_inicio, $data_fim);
            if(mysql_num_rows($query)!=0){
                $this->relatorio .= "<table class='table table-hover' style='background:#F8F8F8;'>";
                $this->relatorio .= "<thead>";
                $this->relatorio .= "<tr>";
                $this->relatorio .= "<th>Data</th>";
                $this->relatorio .= "<th>Tipo</th>";
                $this->relatorio .= "<th>Nome</th>";
                $this->relatorio .= "<th>Descrição</th>";
                $this->relatorio .= "<th>Valor</th>";
                $this->relatorio .= "</tr>";
                $this->relatorio .= '</thead>';
                while ($row = mysql_fetch_array($query)) {
                    if($row['cod_usuario_on']==$this->usuario->getId() && $row['tipoOperacoes']==1){
                        $tipo = "Emprestado a";
                        $class = "success";
                        $nome = $row['nome_off'];
                    }elseif($row['cod_usuario_on']==$this->usuario->getId() && $row['tipoOperacoes']==2){
                        $tipo = "Pago a";
                        $class = "error";
                        $nome = $row['nome_off'];
                    }elseif($row['cod_usuario_off']==$this->usuario->getId() && $row['tipoOperacoes']==1){
                        $tipo = "Empréstimo de";
                        $class = "error";
                        $nome = $row['nome_on'];
                    }elseif($row['cod_usuario_off']==$this->usuario->getId() && $row['tipoOperacoes']==2){
                        $tipo = "Pagamento de";
                        $class = "success";
                        $nome = $row['nome_on'];
                    }
                    $this->relatorio .= "<tr class='$class'>";
                    $this->relatorio .= "<td>{$this->data->formata_data($row['data_operacao'])}</td>";
                    $this->relatorio .= "<td>{$tipo}</td>";
                    $this->relatorio .= "<td>{$nome}</td>";
                    $this->relatorio .= "<td>{$row['descricao']}</td>";
                    $this->relatorio .= "<td>{$row['valor']}</td>";
                    $this->relatorio .= "</tr>";
                }
                $this->relatorio .= "</table>";
            }else{
                $this->msg .= "<div class='alert alert-error'>";
                $this->msg .= "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                $this->msg .= "<b>Sua busca não obteve resultados!</b>";
                $this->msg .= "</div>";  
            }
        }
        
    }
?>
