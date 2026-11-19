<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
</head>
<body>
    <h2>Cadastro Funcionario</h2>

    <form action="views/cadastrar.php" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" required>
        <br><br>

        <label for="email">E-mail: </label>
        <input type="email" name="email" id="email" required>
        <br><br>

        <label for="salario">Salario: </label>
        <input type="salario" name="salario" id="salario" step="0.01" required>
        <br><br>

        <label for="tipo">Tipo: </label>
        <select name="tipo" id="tipo">
            <option value="">Selecione</option>
            <option value="FuncionarioComum">Funcionario Comum</option>
            <option value="Gerente">Gerente</option>
        </select>
        <br><br>

        <button type="submit">Cadastrar</button>
        <br><br>

        <a href="views/listar.php">Listar funcionarios</a>

    </form>
</body>
</html>