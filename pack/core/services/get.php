<?php
require_once __DIR__ . "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/querys.php";

function fetchByKey(string $key): void {
  /**
   * @param string $key: Key to fetch data (id or name).
   *
   * @return void: Returns data associated with given key.
   *
   * @throws json_encode        of error message if key is not found.
   * @throws http_response_code of 400 if key is not found.
   * @throws json_encode        of error message if query failed.
   * @throws http_response_code of 500 if query failed.
   * 
   * @global $conn dependence intacie of SQLite3.
   */
  global $conn;

  header('Content-Type: application/json');

  $getQuery = $key === "id" 
    ? query($_GET[$key])
    : query(null, $_GET[$key]);

  if (!$getQuery) {
    error_log("[SERVICES][GET] Error on query");
    http_response_code(500);
    echo json_encode(["error" => "query failed"]);
    return;
  }

  http_response_code(200);
  echo json_encode($getQuery->fetchArray(SQLITE3_ASSOC));
}

function getAll(): bool {
  /**
   *
   * @return void: Returns all consults in the database.
   *
   * @throws json_encode of error message if query failed.
   * @throws http_response_code of 500 if query failed.
   */
  global $conn;

  header('Content-Type: application/json');

  $getQuery = queryAll();

  if (!$getQuery) {
    error_log("[SERVICES][GET] Error on query");
    http_response_code(500);
    echo json_encode(["error" => "query failed"]);
    return false;
  }

  // echo json_encode($getQuery->fetchArray(SQLITE3_ASSOC));
  // echo json_encode($getQuery->fetchAll(SQLITE3_ASSOC));
  http_response_code(200);
  return true;
}

function get(): void {
  /**
   * @return void: Returns data associated with given key or all names.
   *
   * @throws json_encode of error message if key is not found.
   * @throws http_response_code of 400 if key is not found.
   * @throws json_encode of error message if query failed.
   * @throws http_response_code of 500 if query failed.
   */
  global $conn;

  if (!isset($_GET["id"]) && !isset($_GET["name"])) {
    if (!getAll()) http_response_code(500);
    return;
  }

  $key = isset($_GET["id"]) // test 
    ? "id" : (isset($_GET["email"]) ? "email" : "name");

  fetchByKey($key);
}