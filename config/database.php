<?php
define('DB_HOST', 'SECRET');
define('DB_USER', 'SECRET');
define('DB_PASS', 'SECRET');
define('DB_NAME', 'SECRET');
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// echo 'Connected successfully';
