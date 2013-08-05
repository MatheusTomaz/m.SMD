<?php
    class ContaDAO{
        
        public function ContaDAO(){
                        
        }
        
        public function recuperarUsuario($login, $email){
            $query = mysql_query("SELECT * FROM usuario WHERE login = '$login' OR email = '$email'");
            return $query;
        }

        public function cadastrar($usuario){
            $data = date("Y-m-d H:i:s");
            $query = mysql_query("INSERT INTO solicitacao VALUES (null,
            '{$usuario->getLogin()}',
            '{$usuario->getId()}',
            '{$usuario->getTipo()}',
            '{$usuario->getDesc()}',
            '{$usuario->getValor()}',
            '1',    
            '$data')");
            
            return $query;
        }
        //
        public function buscarUsuario($id){
            $query = mysql_query("SELECT * FROM usuario WHERE cod_usuario = $id");
            return $query;
        }
        
        public function cadastrarOperacao($usuario){
            $query = mysql_query("INSERT INTO operacoes VALUES (null,
            '{$usuario->getCodOn()}',
            '{$usuario->getCodOff()}',
            '{$usuario->getTipo()}',
            '{$usuario->getDesc()}',
            '{$usuario->getValor()}',
            '{$usuario->getData()}')");
            
            return $query;
        }
        
        public function buscarOperacao($solicitacao){
            $query = mysql_query("
                SELECT * FROM solicitacao WHERE cod_solicitacao = '$solicitacao'
            ");
            return $query;
        }
        
        public function procurarOperacao($id, $usuario, $tipo){
            $query = mysql_query("
                SELECT * FROM operacoes WHERE $usuario = '$id' and tipoOperacoes = '$tipo' ORDER BY cod_operacao DESC LIMIT 1
            ");
            return $query;
        }
        
        public function buscaTodos(){
            $query = mysql_query("SELECT * FROM usuario ORDER BY cod_usuario ASC");
            return $query;
        }


        public function selecionaID($id){
            $query = mysql_query("SELECT * FROM usuario WHERE cod_usuario = '$id'");
            return $query;
        }
        
        public function atualizaSaldo($saldo,$id){
            $query = mysql_query("UPDATE usuario SET saldo = '$saldo' where cod_usuario = '$id' ");
        }
        
        public function atualizaSolicitacao($solicitacao, $ativo){
            $query = mysql_query("UPDATE solicitacao SET ativo = $ativo where cod_solicitacao = '$solicitacao' ");
        }
        
        public function buscaSolicitacao($id){
            $query = mysql_query("
                SELECT 
                    S.cod_solicitacao, U.nome, T.descricaoTipo, S.descricao, S.valor, S.data_operacao
                FROM 
                    solicitacao as S, usuario as U, tipo_operacao as T 
                WHERE
                    ativo = 1 
                    and cod_usuario_off = '$id' 
                    and U.cod_usuario = S.cod_usuario_on 
                    and T.cod_tipoOperacao = S.tipoOperacao
                ORDER BY
                    S.data_operacao DESC
            ");
            return $query;
        }
        
        public function buscaExtrato($id, $data_inicio, $data_fim){
            $query = mysql_query("
                SELECT
                    u1.nome as nome_on, op.cod_usuario_on, u2.nome as nome_off,
                    op.cod_usuario_off, op.tipoOperacoes, op.descricao, op.valor, 
                    op.data_operacao
                FROM
                    operacoes as op
                LEFT OUTER JOIN usuario as u1 ON u1.cod_usuario = op.cod_usuario_on
                LEFT OUTER JOIN usuario as u2 on u2.cod_usuario = op.cod_usuario_off
                WHERE
                    (op.cod_usuario_on = '$id' OR op.cod_usuario_off = '$id')
                    AND op.data_operacao between '$data_inicio' and '$data_fim'
                ORDER BY op.data_operacao ASC
            ");
            return $query;
        }
        
        public function operacaoId($idOn, $idOff){
            $query = mysql_query("SELECT * FROM operacoes WHERE (cod_usuario_on = '$idOn' AND cod_usuario_off = '$idOff')
                    OR (cod_usuario_on = '$idOff' AND cod_usuario_off = '$idOn')
                    ORDER BY data_operacao ASC");
            return $query;
        }
        
        public function solicitacaoId($idOn, $idOff){
            $query = mysql_query("SELECT * FROM solicitacao WHERE ((cod_usuario_on = '$idOn' AND cod_usuario_off = '$idOff')
                    OR (cod_usuario_on = '$idOff' AND cod_usuario_off = '$idOn'))
                    AND ativo = 1
                    ORDER BY data_operacao ASC");
            return $query;
        }
    }
?>
