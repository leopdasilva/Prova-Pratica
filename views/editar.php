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