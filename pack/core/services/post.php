<?php 
require_once __DIR__ . "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/inserts.php";

function post(): void{
  /**
   * Inserts a new whitelist into the database.
   *
   * The request body must contain a JSON object with the following structure:
   * {
   *   "purposeName": string,
   *   "whitelist": string
   * }
   *
   * If the request body does not contain the required fields, a 400 error will be returned.
   *
   * If the insert fails, a 500 error will be returned.
   *
   * @return void
   * @throws json_encode        of error message if request body is not valid.
   * @throws http_response_code of 400 if request body is not valid.
   * @throws json_encode        of error message if insert fails.
   * @throws http_response_code of 500 if insert fails.
   * 
   * @global $conn dependence intacie of SQLite3.
   */
  
  global $conn;
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
