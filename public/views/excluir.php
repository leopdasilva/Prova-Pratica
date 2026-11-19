<?php

    require_once __DIR__ . '/../config/conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? '';

        if ($id === '' || ctype_digit((string) $id)) {
            die("ID inválido!");
        }  

        try {
            $sql = "DELETE FROM funcionarios WHERE id = :id";

            $stmt->execute([
                ':id'=> $id
            ]);

            if ($stmt->rowcount() > 0) {
                echo "Funcionario excluido com sucesso.";
            } else {
                echo "Funcionario não encontrado.";
            }

            echo '<br> <a href="listar.php">Voltar para a lista</a>';

        } catch (PDOException $e) {
            echo "Erro ao excluir: " . $e->getMessage();
        }
    } else {
        echo "Requisição inválida";
    }

?>