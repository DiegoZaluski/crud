<?php
require_once __DIR__ . "/../../../data/DBOperations/db.php";
require_once __DIR__ . "/../../../data/DBOperations/querys.php";

function fetchByKey(string $key): void {
  global $conn;

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

function getAll(): void {
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
  global $conn;
  if (!isset($_GET["id"]) && !isset($_GET["purposeName"])) {
    getAll();
    return;
  }

  $key = isset($_GET["id"]) ? "id" : "purposeName";
  fetchByKey($key);
}