<?php 
const ALLOWED_COLUMNS     = ["purposeName", "whitelist"];
const ALLOWED_IDENTIFIERS = ["id","purposeName"];
const MAX_VALUES_UPDATE   = 2;

function update(array $atualizations, string $identifier, int|string $value): bool|array {
  /**
   * Updates a whitelist based on the given identifier and value.
   *
   * @param array      $atualizations An associative array containing the column names as keys and the new values as values.
   * @param string     $identifier The identifier to update the whitelist with. Can be either "id" or "purposeName".
   * @param int|string $value The value associated with the identifier.
   * @return bool|array Returns true if the update was successful, or an associative array containing the index of the failed update and the error message if the update failed.
   * 
   * @global $conn dependence intacie of SQLite3.
   */
  

  global $conn;

  if (!$atualizations) return false;
  if (!in_array($identifier, ALLOWED_IDENTIFIERS)) return false;
  
  $updateString = "UPDATE whitelist SET %s = ? WHERE %s = ?";
  $conn->exec("BEGIN");
  
  $indexLoop        = 0;
  $arrayErrorsIndex = []; 
  foreach($atualizations as $setName => $atualization) {
    if ($indexLoop +1 > MAX_VALUES_UPDATE) return false;

    $statement = $conn->prepare(sprintf($updateString, $setName, $identifier));
    $statement->bindValue(1, $atualization);
    $statement->bindValue(2, $value);

    if (error_update($indexLoop, $statement)) {
      $arrayErrors[] = ["indexError" => $indexLoop];
    }

    $indexLoop++;
  }

  if ($arrayErrorsIndex) return $arrayErrorsIndex;
  $conn->exec("COMMIT");
  return true;
}

function error_update(int $index, $statement): bool {
  /**
   * Checks if the update statement failed and if so, rollbacks the transaction, logs the error and returns true.
   * 
   * @param int $index Index of the list to update.
   * @param $statement The prepared statement to execute.
   * 
   * @return bool Returns true if the statement failed and false otherwise.
   */
  global $conn;
  if (!$statement->execute()) {
    $conn->exec("ROLLBACK");
    error_log("[DB][UPDATE] Error on update: $index index list.");
    return true;
  }
  return false;
}