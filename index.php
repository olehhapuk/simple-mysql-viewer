<?php

require_once('./config.php');

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
if ($conn->connect_error) {
  die('MYSQL connection error');
}

$sql = 'SHOW DATABASES;';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $dbs = $result->fetch_all();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MySQL Client</title>
</head>
<body>
  <h1>Databases</h1>
  <ul>
    <?php
    if ($result->num_rows > 0) {
      foreach ($dbs as $db) {
        echo '<li><a href="view_db.php?db_name=' . $db[0] . '">' . $db[0] . '</a></li>';
      }
    }
    ?>
  </ul>
</body>
</html>