<?php

require_once "./data/DBOperations/db.php";// $conn [GLOBAL].
require_once "./data/DBOperations/querys.php";

function controller(string|null $key): void {
  global $conn;// Used by query
  if (!$key) {
    echo json_encode(["error" => "key not found"]);
    http_response_code(400);
    return;
  }

  if (!isset($_GET[$key])) {
    echo json_encode(["error" => "id not found"]);
    http_response_code(400);
    return;
  }

  $getQuery = query($_GET[$key]);

  if (!$getQuery) {
    error_log("[SERVICES][GET] Error on query");
    http_response_code(500);
    return;
  }

  echo json_encode($getQuery->fetchArray(SQLITE3_ASSOC)["whitelist"]);
  http_response_code(200);
}

function getWhitelist():void {
  global $conn;// Used by controller 
  if (!isset($_GET["id"] ) && !isset($_GET["purposeName"])) {
    echo json_encode(["error" => "id or purposeName not found"]);
    http_response_code(400);
    return;
  }

  controller("id");
  controller("purposeName");
}

function getAll() {
  global $conn;// Used by queryAll
  $getQuery = queryAll();

  if (!$getQuery) {
    error_log("[SERVICES][GET] Error on query");
    http_response_code(500);
    return;
  }
  echo json_encode($getQuery->fetchArray(SQLITE3_ASSOC));
  http_response_code(200); 
}