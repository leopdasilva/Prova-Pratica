<?php

    require_once __DIR__ . '/../config/conexao.php';
    require_once __DIR__ . '/../models/FuncionarioComum.php';
    require_once __DIR__ . '/../models/FuncionarioComum.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $salario = $_POST['salario'] ?? '';
        $tipo = $_POST['tipo'] ?? '';

        if (
            $id === '' ||
            !ctype_digit((string) $id) ||
            $nome === '' ||
            $email === '' ||
            $salario === '' ||
            !in_array($tipo,['FuncionarioComum', 'Gerente'], true)
        ) {
            die("Preencha todos os campos corretamente!");
        }

        try {
            if ($tipo === 'FuncionarioComum') {
                $funcionario = new FuncionarioComum($nome, $email, $salario);
            } else {
                $funcionario = new Gerente($nome, $email, $salario);
            }
    
            $sql = "UPDATE funcionarios SET 
                nome = :nome, 
                email = :email, 
                salario = :salario, 
                tipo = :tipo
                WHERE id = :id";
    
            $stmt = $pdo->prepare($sql);
    
            $stmt->execute([
                ':nome'=>$funcionario->getNome(),
                ':email'=>$funcionario->getEmail(),
                ':salario'=>$funcionario->getSalario(),
                ':tipo'=>$tipo,
                ':id'=>$id
            ]);
    
            echo "Funcionario cadastrado com sucesso!";
    
            echo '<br> <a href="listar.php">Voltar para a lista</a>';

        } catch (PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
        }

        
    } else {
        echo "Requisição inválida!";
    }
    
?>