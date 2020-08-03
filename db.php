<?php

require_once('./config.php');

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, $db);

if ($conn->connect_error) {
  die('MYSQL connection error');
}