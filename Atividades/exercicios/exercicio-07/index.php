<?php
require_once "./connection.php";
require_once "./cabecalho.php";
$estados = $connection->query("SELECT * FROM estados");

require_once "./estadosView.php";
