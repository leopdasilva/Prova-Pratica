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
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Funcionarios</title>
</head>
<body>
    <h2>Dados do funcionário</h2>
    <p>ID: <?= $funcionario->getId() ?></p>
    <p>Nome: <?= htmlspecialchars($funcionario->getNome()) ?></p>
    <p>E-mail: <?= htmlspecialchars($funcionario->getEmail()) ?></p>
    <p>Salario: <?= $funcionario->getSalario() ?></p>
    <p>Salario + Bonus: <?= $funcionario->calcularBonus($salario) ?></p>
    <p>Tipo: <?= htmlspecialchars($dados['tipo']) ?></p>
    <p>Função: <?= htmlspecialchars($funcionario->executarFuncao()) ?></p>
    <br><br>
    <a href="listar.php">Voltar para a lista</a>
</body>
</html>