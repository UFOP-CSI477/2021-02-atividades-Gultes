<?php
require_once "./connection.php";
require_once "./cabecalho.php";
$produtos = $connection->query("SELECT * FROM produtos");
require_once "./produtosView.php";
