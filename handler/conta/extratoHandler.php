<?php
    require_once('../dao/ContaDAO.php');
    require_once('../bean/bean.php');
    require_once('../class/Data.class');

    class extratoHandler{
        
        public $relatorio;
        private $contaDAO, $usuario, $data;
                
        function extratoHandler($id){
            $this->data = new data();
            $this->contaDAO = new ContaDAO();
            
            $this->usuario = new Usuario();
            $this->usuario->setId($id);
            
            if(isset($_POST['acao']) && isset($_POST['data_inicio']) && isset($_POST['data_fim'])){
                $data_inicio = $this->data->formata_dataBD($_POST['data_inicio']);
                $data_fim = $this->data->formata_dataBD($_POST['data_fim']);
                if($_POST['data_inicio'] == NULL && $_POST['data_fim'] == NULL){
                    $data_inicio = '2010-12-31';
                    $data_fim = '2020-12-31';
                }
                $this->buscaExtrato($data_inicio, $data_fim);
            }
        }
        function buscaUsuario(){
            
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
                        $tipo = "Emprestei a";
                        $class = "success";
                        $nome = $row['nome_off'];
                    }elseif($row['cod_usuario_on']==$this->usuario->getId() && $row['tipoOperacoes']==2){
                        $tipo = "Paguei a";
                        $class = "error";
                        $nome = $row['nome_off'];
                    }elseif($row['cod_usuario_off']==$this->usuario->getId() && $row['tipoOperacoes']==1){
                        $tipo = "Peguei emprestado de";
                        $class = "error";
                        $nome = $row['nome_on'];
                    }elseif($row['cod_usuario_off']==$this->usuario->getId() && $row['tipoOperacoes']==2){
                        $tipo = "Fui pago por";
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
