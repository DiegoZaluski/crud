<?php 
include_once __DIR__ . "/../../../config/constants.php";

function isValidEmail($email): bool {
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "email not valid"]);
    return false;
  }
  return true;
}

function isValidAge($age): bool {
  if (!is_numeric($age) || (int)$age != $age) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "id not valid"]);  
    return false; 
  }

  if ($age < 0 || $age > 120) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "age not valid [between 0 and 120]"]);
    return false;
  }
  return true;
}

function isValidName($name): bool {

  if (preg_match('/[0-9]/', $name)) {
    ERRORNAME();
    return false;
  }

  $chars = mb_str_split($name);
  foreach ($chars as $char) {
    if (in_array($char, INVALID_CHARS)) {
      ERRORNAME();
      return false;
    }
  }

  if (hasEmoji($name)) {
    ERRORNAME();
    return false;
  }

  return true;
}

function ERRORNAME() {
  http_response_code(400);
  echo json_encode(["success" => false, "message" => "name not valid"]);
}


function hasEmoji($str) {
    return preg_match('/\p{Extended_Pictographic}/u', $str);
}