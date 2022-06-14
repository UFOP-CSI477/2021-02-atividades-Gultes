<?php

namespace App\Models;

class Produto
{
    private $id, $nome, $um;

    public function __construct($id, $nome, $um)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->um = $um;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getUm()
    {
        return $this->um;
    }
}
