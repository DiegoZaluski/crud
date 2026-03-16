<?php 
require_once __DIR__ .  "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/deleteRegistration.php";


function delete(): void {
  global $conn;

  $idValue = isset($_GET["id"]) ? $_GET["id"] : $_GET["purposeName"];

  if (!$idValue) {
    http_response_code(400);
    echo json_encode(["error" => "id not found"]);
    return;
  }

  if (!deleteRegistration($idValue)) {
    http_response_code(500);
    echo json_encode(["error" => "delete failed"]);
    return;
  }

  http_response_code(200);
  echo json_encode(["success" => "delete success"]);
}