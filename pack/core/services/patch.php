<?php 
require_once __DIR__ . "/../../../data/DBOperations/updates.php";

/**
 * @throws json_encode        of error message if id or name is not found.
 * @throws http_response_code of 400 if id or name is not found.
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
    : (isset($_GET["email"]) ? $_GET["email"] : null);

  $identifier = isset($_GET["id"]) ? "id" : "email";
  
  if (!$value) {
    echo json_encode(["error" => "id not found"]);
    http_response_code(400);
    return;
  }

  $body       = file_get_contents("php://input");
  $body_patch = json_decode($body, true);
  if (!$body_patch) {
    echo json_encode(["error" => "body not found"]);
    http_response_code(400);
    return;
  }
  
  if (!$_GET["id"] && !$_GET["email"]) {
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