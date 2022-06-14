<?php

namespace App\Database;

use PDO;

class AdapterSQLite implements AdapterInterface
{


    private $strConn;
    private $connection;

    public function __construct(string $dbfile)
    {
        $this->strConn = "sqlite:" . $dbfile;
        $this->connection = null;
    }

    public function open()
    {
        $this->connection = new PDO($this->strConn);
    }

    public function close()
    {
        $this->connection = null;
    }

    public function get()
    {
        return $this->connection;
    }
}
