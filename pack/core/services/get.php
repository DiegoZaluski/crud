<?php
require_once __DIR__ . "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/querys.php";

function fetchByKey(string $key): void {
  /**
   * Fetch whitelist by given key (id or purposeName).
   *
   * @param string $key: Key to fetch whitelist (id or purposeName).
   *
   * @return void: Returns whitelist associated with given key.
   *
   * @throws json_encode        of error message if key is not found.
   * @throws http_response_code of 400 if key is not found.
   * @throws json_encode        of error message if query failed.
   * @throws http_response_code of 500 if query failed.
   * 
   * @global $conn dependence intacie of SQLite3.
   */
  global $conn;

  $getQuery = $key === "id" 
  ? query($_GET[$key])
  : query(null, $_GET[$key]);

  if (!$getQuery) {
    error_log("[SERVICES][GET] Error on query");
    http_response_code(500);
    return;
  }

  echo json_encode($getQuery->fetchArray(SQLITE3_ASSOC)["whitelist"]);
  http_response_code(200);
}

function getAll(): void {
  /**
   * Fetch all whitelists in the database.
   *
   * @return void: Returns all whitelists in the database.
   *
   * @throws json_encode of error message if query failed.
   * @throws http_response_code of 500 if query failed.
   */
  global $conn;

  $getQuery = queryAll();

  if (!$getQuery) {
    error_log("[SERVICES][GET] Error on query");
    http_response_code(500);
    return;
  }

  echo json_encode($getQuery->fetchArray(SQLITE3_ASSOC));
  http_response_code(200);
}

function get(): void {
  /**
   * Fetch whitelist by given key (id or purposeName) or all whitelists.
   *
   * If id or purposeName is not found, it will fetch all whitelists.
   *
   * @return void: Returns whitelist associated with given key or all whitelists.
   *
   * @throws json_encode of error message if key is not found.
   * @throws http_response_code of 400 if key is not found.
   * @throws json_encode of error message if query failed.
   * @throws http_response_code of 500 if query failed.
   */
  
  global $conn;
  if (!isset($_GET["id"]) && !isset($_GET["purposeName"])) {
    getAll();
    return;
  }

  $key = isset($_GET["id"]) ? "id" : "purposeName";
  fetchByKey($key);
}