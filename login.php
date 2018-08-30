<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>

  <?php
    $username = $_GET['username'];
    $password = $_GET['password'];
  ?>

  <body>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username"><br />
      <input type="password" name="password"><br />
      <input type="submit" name="submit" value="Go! Go! Power Rangers!">
    </form>

    <?php
      echo "Username was $username";
      echo "<br />";
      echo "Password was $password";
    ?>

  </body>
</html>
