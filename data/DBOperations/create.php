<?php

function createTable():bool {
  global $conn;
  return $conn->exec("
    CREATE TABLE IF NOT EXISTS whitelist (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    purposeName TEXT NOT NULL,
    whitelist TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP
  )"); 
}

