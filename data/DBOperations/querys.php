<?php 

function query(
  int|null $id             = null, 
  string|null $name = null): bool|SQLite3Result {
  /**
   * @param int|null    $id: If omitted the $name will be used to perform the query.
   * @param string|null $name: Used when id omitted.
   * 
   * @return bool|SQLite3Result Returns false, if both parameters were omitted or the query failed.
   * 
   * @global $conn dependence intacie of SQLite3.
  */

  if (!$id && !$name) return false;
  
  global $conn;
  $selectString = "SELECT * FROM ". NAME_TABLE . " WHERE %s = ?";
  
  if ($id) {
    $statement = $conn->prepare(sprintf($selectString, "id"));
    $statement->bindValue(1, $id, SQLITE3_INTEGER);
  } else {
    $statement = $conn->prepare(sprintf($selectString, "name"));
    $statement->bindValue(1, $name, SQLITE3_TEXT);
  }
  
  return $statement->execute();
}

function queryAll(): bool|SQLite3Result {
  global $conn;
  return $conn->query("SELECT * FROM ". NAME_TABLE);
}