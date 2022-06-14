<?php
$dbfile = "./db/database.sqlite";
$strConn = "sqlite:" . $dbfile;
$connection = new PDO($strConn);
