<?php

    abstract class Funcionario {
        private $id;
        private $nome;
        private $email;
        private $salario;

        public function __construct($nome, $email, $salario){
            $this->nome = $nome;
            $this->email = $email;
            $this->salario = $salario;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getSalario() {
            return $this->salario;
        }

        public function setSalario($salario) {
            $this->salario = $salario;
        }

        abstract public function executarFuncao();

        abstract public function calcularBonus();
    }
?>