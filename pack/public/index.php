<?php 
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/constants.php";

// CORS.
$method = $_SERVER["REQUEST_METHOD"] ?? false;
$origin = $_SERVER["HTTP_ORIGIN"]    ?? false;
$damain = $_SERVER["HTTP_HOST"]      ?? false;
// Headers.
in_array($origin, $allowedOrigins) 
  ? header("Access-Control-Allow-Origin: $origin")
  : null; 
header("Access-Control-Allow-Methods:" . implode(", ", $allowedMethods));
header("Access-Control-Allow-Headers:" . implode(", ", $allowedHeaders));

// Detected bot-agent.
// ...
//
// Preflight.
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
  http_response_code(204);
  exit;
}

// Route. 
$uri = strtok($_SERVER["REQUEST_URI"], "?");

$routers = [
  "/api/users" => require_once __DIR__ . "/../core/routers.php",
  // ... 
];

if (!array_key_exists($uri, $routers)) {
  http_response_code(404);
  echo json_encode(["error" => "Route not found"]);
  exit;
}

$routers[$uri]();