<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['username'])) {
    //die("Don't even think about it");
    header('login.php');
  }
?>

Upload you file.
<form action="" method="post">
  <input type="file" name="upload">
</form>
