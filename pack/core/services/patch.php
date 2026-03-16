<?php 
require_once __DIR__ . "/../../../data/DBOperations/updates.php";

/**
 * Updates a whitelist based on the given identifier and value.
 *
 * If the id or purposeName is not found, it will return an error.
 *
 * If the update failed, it will return an error.
 *
 * If the update was successful, it will return a success message.
 * 
 * @throws json_encode        of error message if id or purposeName is not found.
 * @throws http_response_code of 400 if id or purposeName is not found.
 * @throws json_encode        of error message if update failed.
 * @throws http_response_code of 500 if update failed.
 * @throws json_encode        of success message if update was successful.
 * @throws http_response_code of 200 if update was successful.
 * 
 * @global $conn dependence intacie of SQLite3.
*/
function patch(): void {

  global $conn;
  $value = isset($_GET["id"]) 
    ? $_GET["id"] 
    : (isset($_GET["purposeName"]) ? $_GET["purposeName"] : null);

  $identifier = isset($_GET["id"]) ? "id" : "purposeName";
  
  if (!$value) {
    echo json_encode(["error" => "id not found"]);
    http_response_code(400);
    return;
  }

  $body       = file_get_contents("php://input");
  $body_patch = json_decode($body, true);

  if (!$_GET["id"] && !$_GET["purposeName"]) {
    echo json_encode(["error" => "id not found"]);
    http_response_code(400);
    return;
  }
  
  if (!update($body_patch["atualizations"], $identifier, $value)) {
    echo json_encode(["error" => "update failed"]);
    http_response_code(500);
    return;
  }

  echo json_encode(["success" => "update success"]);
  http_response_code(200);
}