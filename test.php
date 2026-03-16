<?php 
require_once "./data/DBOperations/db.php";
require_once "./data/DBOperations/create.php";
require_once "./data/DBOperations/inserts.php";
require_once "./data/DBOperations/querys.php";

createTable();
insert('newList', 'test test test test test test test test test');
$q = (query(purposeName:'newList'));
var_dump($q->fetchArray(SQLITE3_ASSOC)["whitelist"]);
