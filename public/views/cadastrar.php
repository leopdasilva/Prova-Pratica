<?php
    require_once __DIR__ . '/config/conexao.php';
    require_once __DIR__ . '/models/FuncionarioComum.php';
    require_once __DIR__ . '/config/Gerente.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $salario = trim($_POST['salario'] ?? '');
        $tipo = $_POST['tipo'] ?? '';

        if (
            $nome === '' ||
            $email === '' ||
            $salario === '' ||
            !in_array($tipo, ['FuncionarioComum', 'Gerente'], true)
        ) {
            die("Preencha todos os campos!");
        }

        try {

            if ($tipo === 'FuncionarioComum') {
                $funcionario = new FuncionarioComum($nome, $email, $salario);
            } else {
                $funcionario = new Gerente($nome, $email, $salario);
            }

            $sql = "INSERT INTO funcionarios (nome, email, salario, tipo) VALUES (:nome, :email, :salario, :tipo)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nome'=>$funcionario->getNome(),
                ':email'=>$funcionario->getEmail(),
                ':salario'=>$funcionario->getSalario(),
                ':tipo'=>$tipo
            ]);

            echo "Funcionário cadastrado com sucesso";

            echo '<br><a href="listar.php">Ver funcionários</a>';

        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }

    } else {
        echo "Formulário não enviado";
    }

?>