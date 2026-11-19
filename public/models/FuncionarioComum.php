<?php 

    require_once __DIR__ . '/Funcionario.php';

    class FuncionarioComum extends Funcionario {
        public function executarFuncao(){
            return "Realiza seus serviços no chão de fábrica.";
        }

        public function calcularBonus($salario){ 
            return $this->$salario * 0.05;
        }
    }

?>