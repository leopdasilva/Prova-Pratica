<?php

    require_once __DIR__ . '/../config/conexao.php';
    require_once __DIR__ . '/../models/FuncionarioComum.php';
    require_once __DIR__ . '/../models/Gerente.php';

    $id = $_GET['id'] ?? '';

    if ($id === '' || ctype_digit((string) $id)) {
        die("ID inválido");
    }

    $sql = "SELECT * FROM funcionarios WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id'=>$id
    ]);

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dados) {
        die("Funcionario não encontrado!");
    } 

    if ($dados['tipo'] === 'FuncionarioComum') {
        $funcionario = new FuncionarioComum(
            $dados['nome'],
            $dados['email'],
            $dados['salario']
        );
    } else {
        $funcionario = new Gerente(
            $dados['nome'],
            $dados['email'],
            $dados['salario']
        );
    }

    $funcionario->setId($dados['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>