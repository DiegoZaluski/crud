<?php 
// Simple Inserts.  
function insert(
  string $name,
  int $age,
  string $description): bool {
  /**
   * @param string $name: Name of the list. 
   * @param string $: Content of the list.
   * @return bool: Returns false, if the query failed or the list already exists and true if it was successful.
  */
  global $conn;
  if (!is_integer($age)) {
    echo json_encode(["error" => "age must be an integer"]);
    http_response_code(400);
    return false;
  }

  $conn->exec("BEGIN");

  $statement = $conn->prepare("
    INSERT INTO " . NAME_TABLE . " VALUES (NULL, ?, ?, ?, NULL)");

  $statement->bindValue(1,       $name);
  $statement->bindValue(2, (int) $age);
  $statement->bindValue(3,       $description);
  
  if (!$statement->execute()) {
    $conn ->exec("ROLLBACK");
    return false;
  } 
  $conn->exec("COMMIT");
  return true;
}