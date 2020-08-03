<?php

if (isset($_GET['db_name'])) {
  $db = $_GET['db_name'];
}
else {
  exit('Please specify db name!');
}
require('./db.php');

if (isset($_GET['table_name'])) {
  $table = $_GET['table_name'];
}
else {
  exit('Please specify table name!');
}

$sql = 'SELECT * FROM ' . $table;
$data = $conn->query($sql);

$sql = 'SHOW COLUMNS FROM ' . $table;
$cols = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MySQL Client</title>
</head>
<body>

  <style>
  th, td {
    padding: 0.3em;
  }
  </style>

  <h1><?php echo $table; ?></h1>

  <table border="1">
    <thead align="left">
      <?php
      if ($cols->num_rows > 0) {
        $colsNames = [];
        while($row = $cols->fetch_assoc()) {
          array_push($colsNames, $row['Field']);
          echo '<th>' . $row['Field'] . '</th>';
        }
      }
      ?>
    </thead>
    <tbody>
      <?php
      if ($data->num_rows > 0) {
        while($row = $data->fetch_assoc()) {
          echo '<tr>';
            for ($i=0; $i < count($colsNames); $i++) { 
              echo '<td>' . $row[$colsNames[$i]] . '</td>';
            }
          echo '</tr>';
        }
      }
      ?>
    </tbody>
  </table>
</body>
</html>