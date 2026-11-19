<?php 

    require_once __DIR__ . '/../config/conexao.php';

    $sql = "SELECT * FROM funcionarios";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de funcionarios</title>
</head>
<body>
    <h2>Funcionarios cadastrados</h2>

    <a href="/index.php">Cadastrar Funcionario</a>
    <br><br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Salario</th>
            <th>Ações</th>
        </tr>

        <?php if (count($funcionarios) > 0): ?>
            <?php foreach ($funcionarios as $funcionario): ?>
                <tr>
                    <td><?=$funcionario['id']?></td>
                    <td><?=htmlspecialchars($funcionario['nome'])?></td>
                    <td><?=htmlspecialchars($funcionario['email'])?></td>
                    <td><?=$funcionario['salario']?></td>
                    <td>
                        <a href="consultar.php?id=<?=$funcionario['id']?>">Consultar</a>
                        <a href="editar.php?id=<?=$funcionario['id']?>">Editar</a>
                        <form action="excluir.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<? $funcionario['id']?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum funcionário cadastrado</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>