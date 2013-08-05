<?php
    class Usuario{
        
        private $id, $nome, $login, $senha, $email, $telefone, $grupo, $desc, $valor, $cod_usuario_on, $cod_usuario_off, $data_operacao, $tipo;
        
        public function getCodOn() {
            return $this->cod_usuario_on;
        }

        public function setCodOn($cod_usuario_on) {
            $this->cod_usuario_on = $cod_usuario_on;
        }
        
        public function getCodOff() {
            return $this->cod_usuario_off;
        }

        public function setCodOff($cod_usuario_off) {
            $this->cod_usuario_off = $cod_usuario_off;
        }
        
        public function getData() {
            return $this->data_operacao;
        }

        public function setData($data_operacao) {
            $this->data_operacao = $data_operacao;
        }
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }
        
        public function setNome($nome){
            $this->nome = $nome;
        }
                
        public function getNome(){
            return $this->nome;
        }

        public function getLogin() {
            return $this->login;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        public function getGrupo() {
            return $this->grupo;
        }

        public function setGrupo($grupo) {
            $this->grupo = $grupo;
        }

        public function getDesc() {
            return $this->desc;
        }

        public function setDesc($desc) {
            $this->desc = $desc;
        }
        
        public function getValor() {
            return $this->valor;
        }

        public function setValor($valor) {
            $this->valor = $valor;
        }
        
        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }
    }
?>
