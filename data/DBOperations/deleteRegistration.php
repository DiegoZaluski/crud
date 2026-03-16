<?php
function deleteRegistration($identifierValue): bool {
  global $conn; 
  
  $dropString ="DELETE FROM " . NAME_TABLE . " WHERE %s = ?";
  $identifier = is_numeric($identifierValue) ? "id" : "name";
  
  $conn->exec("BEGIN");

  $statement = $conn->prepare(sprintf($dropString, $identifier));
  $statement->bindValue(1, $identifierValue);

  if (!$statement->execute()) {
    $conn->exec("ROLLBACK");
    return false;
  }
  $conn->exec("COMMIT");
  return true;
}