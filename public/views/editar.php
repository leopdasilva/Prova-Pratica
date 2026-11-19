<?php
    require_once __DIR__ . '/../config/conexao.php';

    $id = $_GET['id'] ?? '';

    if ($id === '' || ctype_digit((string) $id)) {
        die("ID inválido!");
    } 

    $sql = "SELECT * FROM funcionarios WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id'=>$id
    ]);

    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$funcionario) {
        die("Funcionario não encontrado!");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionario</title>
</head>
<body>
    <h2>Editar Funcionario</h2>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?=htmlspecialchars($funcionario['id'])?>">
        <br><br>

        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" value="<?=htmlspecialchars($funcionario['nome'])?>" required>
        <br><br>

        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" value="<?=htmlspecialchars($funcionario['email'])?>" required>
        <br><br>

        <label for="salario">Salario: </label>
        <input type="number" name="salario" id="salario" step="0.01" value="<?=$funcionario['salario']?>" required>
        <br><br>

        <label for="tipo">Tipo: </label>
        <select name="tipo" id="tipo">
            <option value="FuncionarioComum" 
                <?= $funcionario['tipo']?>> Funcionario Comum
            </option>
            <option value="Gerente" 
                <?= $funcionario['tipo']?>> Gerente
            </option>
        </select>
        <br><br>
        <button type="submit">Salvar alteração</button>

    </form>
    <br><br>
    <a href="listar.php">Voltar</a>
</body>
</html>