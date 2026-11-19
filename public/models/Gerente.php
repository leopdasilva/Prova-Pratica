<?php 

    require_once __DIR__ . '/Funcionario.php';

    class Gerente extends Funcionario {
        public function executarFuncao(){
            return "Gerencia os processos e acompanha os resultados.";
        }

        public function calcularBonus($salario){ 
            return $this->$salario * 0.10;
        }
    }

?>