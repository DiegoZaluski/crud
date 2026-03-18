<?php 
require_once __DIR__ .  "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/deleteRegistration.php";
require_once __DIR__ . "/util/validations.php";

function delete(): void {
  global $conn;

  header('Content-Type: application/json');

  $idValue = isset($_GET["id"]) ? $_GET["id"] : $_GET["email"];

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
  echo json_encode(["success" => true, "message" => "delete success"]);
}