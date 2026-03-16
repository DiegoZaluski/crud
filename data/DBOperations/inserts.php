<?php 
// Isert data from a data array.  
function insertStream(array $arrayDatas):bool {
  /**
   * @param array $arrayDatas: List of arrays with purposeName and whitelist.
   * @return bool: Returns false if the array is empty, any query failed and true if all inserts were successful.
  */
  global $conn;

  if (!$arrayDatas) return false;
  $conn->exec("BEGIN");  

  foreach($arrayDatas as $index => $data) {
    $statement = $conn->prepare("
      INSERT INTO whitelist 
      VALUES (NULL, ?, ?, NULL)");

    $statement->bindValue(1, $data[0]);
    $statement->bindValue(2, $data[1]);

    if (!$statement->execute()) {
      $conn->exec("ROLLBACK");
      error_log("[DB][ISERTSTREAM] Error on insert: $index index list.");
      return false;
    }
  }
  $conn->exec("COMMIT");
  return true;
}

// Simple Inserts.  
function insert(string $purposeName, string $whitelist): bool {
  /**
   * @param string $purposeName: Name of the list. 
   * @param string $whitelist: Content of the list.
   * @return bool: Returns false, if the query failed or the list already exists and true if it was successful.
  */
  global $conn;

  $conn->exec("BEGIN");

  $statement = $conn->prepare("
    INSERT INTO whitelist 
    VALUES (NULL, ?, ?, NULL)
  ");

  $statement->bindValue(1, $purposeName);
  $statement->bindValue(2, $whitelist);
  
  if (!$statement->execute()) {
    $conn ->exec("ROLLBACK");
    return false;
  }
  $conn->exec("COMMIT");
  return true;
}