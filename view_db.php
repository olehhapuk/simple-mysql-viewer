<?php

if (isset($_GET['db_name'])) {
  $db = $_GET['db_name'];
}
else {
  exit('Please specify database name!');
}
require('./db.php');

$sql = 'show tables';
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MySQL Client</title>
</head>
<body>
  <h1>Tables</h1>
  <ul>
    <?php
    $tables = [];
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $tableName = $row['Tables_in_' . $db];
        echo '<li><a href="view_table.php?db_name=' . $db . '&table_name=' . $tableName . '">' . $tableName . '</a></li>';
      }
    }
    ?>
  </ul>
</body>
</html>