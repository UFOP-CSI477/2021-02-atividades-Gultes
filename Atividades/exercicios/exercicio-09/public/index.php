<?php

require_once '../vendor/autoload.php';


use App\Models\Estado;
use App\Models\Cidade;
use App\Models\Produto;
use App\Database\Connection;
use App\Database\AdapterSQLite;

$connection = new Connection(new AdapterSQLite('../App/Database/database.sqlite'));
$connection->getAdapter()->open();
$estados_db  = $connection->getAdapter()->get()->query("SELECT * FROM estados");
$produtos_db = $connection->getAdapter()->get()->query("SELECT * FROM produtos");
$cidades_db = $connection->getAdapter()->get()->query("SELECT * FROM cidades");




$estados = [];
foreach ($estados_db as $estado) {
    $estados[] = new Estado($estado['id'], $estado['nome'], $estado['sigla']);
}
$cidades = [];
foreach ($cidades_db as $cidade) {
    $cidades[] = new Cidade($cidade['id'], $cidade['nome']);
}
$produtos = [];
foreach ($produtos_db as $produto) {
    $produtos[] = new Produto($produto['id'], $produto['nome'], $produto['un']);
}

require_once '../Views/cabecalho.php';
echo "<body>";
require_once '../Views/cidadeView.php';
require_once '../Views/estadoView.php';
require_once '../Views/produtoView.php';
echo "</body>";
echo "</html>";
