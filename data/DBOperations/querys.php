<?php 
function query(
  int|null $id             = null, 
  string|null $purposeName = null): bool|SQLite3Result {
  /**
   * @param int|null $id: If omitted the $purposeName will be used to perform the query.
   * @param string|null $purposeName: Used when id omitted.
   * @return bool|SQLite3Result: Returns false, if both parameters were omitted or the query failed.
  */

  if (!$id && !$purposeName) return false;
  
  global $conn;
  $selectString = "SELECT * FROM whitelist WHERE %s = ?";
  
  if ($id) {
    $statement = $conn->prepare(sprintf($selectString, "id"));
    $statement->bindValue(1, $id, SQLITE3_INTEGER);
  } else {
    $statement = $conn->prepare(sprintf($selectString, "purposeName"));
    $statement->bindValue(1, $purposeName, SQLITE3_TEXT);
  }
  
  return $statement->execute();
}

function queryAll(): bool|SQLite3Result {
  global $conn;
  return $conn->query("SELECT * FROM whitelist");
}