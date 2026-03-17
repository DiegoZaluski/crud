<?php
require_once __DIR__ . "/services/get.php";
require_once __DIR__ . "/services/post.php";
require_once __DIR__ . "/services/patch.php";
require_once __DIR__ . "/services/delete.php";

$method = $_SERVER["REQUEST_METHOD"] ?? false;
if (!$method) {
  http_response_code(404);
  echo json_encode(["error" => "Route not found"]);
  exit;
  }
  
$routers = [
  "GET"    => get(...),
  "POST"   => post(...),
  "PATCH"  => patch(...),
  "DELETE" => delete(...), 
];

$routers[$method]();