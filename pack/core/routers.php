<?php

require_once __DIR__ . "/services/get.php";

$queryParams = $_SERVER["QUERY_STRING"] ?? false;

if (!$queryParams) {
  http_response_code(404);
  echo json_encode(["error" => "Route not found"]);
  exit;
} 


$routers = [
  "GET"    => get(),
  "POST"   => post(),
  // "PATCH"  => put(),
  // "DELETE" => delete(), 
  ];