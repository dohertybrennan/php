<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('dbconnection.php');

    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $username = trim($username);
    $username = stripcslashes($username);
    $username = str_replace(' ', '', $username);

    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $conn->query($sql);
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register Now!</title>
  </head>
  <body>
    <form class="" action="" method="post">
      <input type="text" name="username"> <br>
      <input type="password" name="password"><br>
      <input type="submit" name="" value="">
    </form>
  </body>
</html>
