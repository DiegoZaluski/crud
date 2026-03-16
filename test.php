<?php 
require_once "./data/DBOperations/db.php";
require_once "./data/DBOperations/create.php";
require_once "./data/DBOperations/inserts.php";
require_once "./data/DBOperations/querys.php";

$q= queryAll();
$i = 0;
while($i < 7) {
  var_dump($q->fetchArray(SQLITE3_ASSOC));
  $i ++ ;
}
  