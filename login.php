<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>

  <?php
    $username = $_POST['username'];
    $password = $_POST['password'];
  ?>

  <body>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username"><br />
      <input type="password" name="password"><br />
      <input type="submit" name="submit" value="Go! Go! Power Rangers!">
    </form>

    <?php
      if (isset($username) || isset($password)) {
        echo "Username was $username";
        echo "<br />";
        echo "Password was $password";
      }
    ?>

  </body>
</html>
