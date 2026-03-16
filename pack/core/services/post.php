<?php 
require_once "./data/DBOperations/db.php";// $conn [GLOBAL].
require_once "./data/DBOperations/inserts.php";

function post(): void{
  global $conn;// used by insert and insertStream
  $boby = file_get_contents("php://input");

  if (!$boby) {
    echo json_encode(["error" => "body not found"]);
    http_response_code(400);
    return;
  }

  // SANITIZE HERE [CONTINUE]

  $data = json_decode($boby, true);

  if (isset($data["arrayLists"]) && !insertStream($data["arrayLists"])) { 
    echo json_encode(["error" => "Error on insertStream"]);
    http_response_code(500);
    return;
  }

  if (!isset($data["purposeName"]) || !isset($data["whitelist"])) {
    echo json_encode(["error" => "purposeName or whitelist not found"]);
    http_response_code(400);
    return;
  }

  $insert = insert($data["purposeName"], $data["whitelist"]);
  
  if (!$insert) {
    echo json_encode(["error" => "Error on insert"]);
    http_response_code(500);
    return;
  }

  http_response_code(200);
}
