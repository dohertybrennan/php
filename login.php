<?php
  session_start();
  require('dbconnection.php');

  if (isset($_POST(['username']))) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //SQL statment to execute
    $sql = "SELECT username, password FROM users WHERE username = '$username'";

    //Execute the SQL and return an array to $result
    $result = $conn->query($sql);

    //Extracting the returned query information
    while ($row = $result->fetch_assoc()) {
      if ($username == $row['username'] && $password == $row['password']) {
        $_SESSION['username'] = $username;
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>

  <?php
    if (isset($_POST['logout'])) {
      unset($_SESSION['username']);
    }
  ?>

  <body>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username"><br />
      <input type="password" name="password"><br />
      <input type="submit" name="submit" value="Go! Go! Power Rangers!">
      <br>
      <input type="submit" name="logout" value="logout">
    </form>
    <?php
      echo "Logged in as: " . $_SESSION['username'];
    ?>
  </body>
</html>
