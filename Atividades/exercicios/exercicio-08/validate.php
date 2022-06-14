<?php

require_once "./connection.php";


$name = $_POST['name'];
$un = $_POST['un'];


if (empty($name) || empty($un)) {
    die("Campos em branco");
}

try {

    $connection->beginTransaction();
    $stmt = $connection->prepare("INSERT INTO produtos(nome, um) VALUES(:name, :un);");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':um', $um);

    $stmt->execute();


    $connection->commit();
    header('Location: ./index.php');

    exit();
} catch (Exception $e) {
    $connection->rollBack();
    die("Erro no banco de dados");
}
