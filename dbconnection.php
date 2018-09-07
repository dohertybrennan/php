<?php
  $db_host = 'localhost';
  $db_user = 'brennan';
  $db_password = 'southhills#';
  $db_name = 'brennan';
  $conn = new mysqli($db_host, $db_user, $db_password, $db_name);
  if ($con->connection_error) {
    die("Connection failed! ". $conn->connection_error);
  } else {
    echo "Connection Successful";
  }
?>
