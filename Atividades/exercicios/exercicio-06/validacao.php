<?php

var_dump($_POST);

$name = $_POST['name'];
$age = $_POST['age'];
$cep = $_POST['cep'];
$tel = $_POST['tel'];
$gender = $_POST['gender'];
$area = $_POST['area'];


if ($name == "" || $age == "" || $cep == "" || $gender == "" || count($area) == 0) {
    echo '<p> Formulário inválido</p>';
} else {
    echo "<p>Nome: $name";
    echo "<p>Idade: $age";
    echo "<p>Cep: $cep";
    echo "<p>Telefone: $tel";
    echo "<p>Gênero: $gender";
    foreach ($area as $item) {
        echo "<p>Area: $item";
    }
}
