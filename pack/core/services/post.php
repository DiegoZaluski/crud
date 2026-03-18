<?php 
require_once __DIR__ . "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/inserts.php";
require_once __DIR__ . "/util/validations.php";

function post(): void {
  /**
   * Inserts a new whitelist into the database.
   *
   * The request body must contain a JSON object with the following structure:
   * {
   *   "name": string,
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

  header('Content-Type: application/json');

  $boby = file_get_contents("php://input");
  if (!$boby) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "body not found"]);
    return;
  }

  $data = json_decode($boby, true);

  if (!isset($data["name"]) || !isset($data["age"]) || !isset($data["email"])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "name or age or email not found"]);
    return;
  }
  
  if ( 
    !isValidEmail($data["email"]) ||
    !isValidAge($data["age"])     ||
    !isValidName($data["name"])
  ) { return; } 

  $insert = insert($data["name"], $data["age"], $data["email"]);
  if (!$insert) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error on insert"]);
    return;
  }

  http_response_code(201);
  echo json_encode(["success" => true,    "message" => "Created"]);
}
