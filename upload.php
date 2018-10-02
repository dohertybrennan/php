<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  if (!isset($_SESSION['username'])) {
    //die("Don't even think about it");
    header('Location: login.php');
  }

  if (isset($_SESSION['username'])) {
    require('navbar.php');
  }

  var_dump($_POST['upload']);
  echo "<hr>";
  var_dump($_FILES['upload']);

  if (isset($_FILES['upload'])) {
    //checks to see if uploads directory exists
    if (!file_exists('uploads')) {
      mkdir('uploads/');
    }
    //if upload directory does not exists, create it.
    if (!file_exists("uploads/" . $_SESSION['username'])) {
      mkdir("uploads/" . $_SESSION['username']);
    }

    $target_dir = "uploads/" . $_SESSION['username'] . "/";
    $target_file = $target_dir.basename($_FILES['upload']['name']);
    $uploadVerification = true;

    if (file_exists($target_file)) {
      $uploadVerification = false;
      $ret = "Sorry. File already exists!";
    }

    //Check file for type
    $file_type = $_FILES['upload']['type'];

    switch ($file_type) {
      case 'image/jpeg':
        $uploadVerification = true;
        break;
      case 'image/png':
        $uploadVerification = true;
        break;
      case 'image/gif':
        $uploadVerification = true;
        break;
      case 'application/pdf':
        $uploadVerification = true;
        break;
      default:
        $uploadVerification = false;
        $ret = "Sorry. Only .jpg, .png, gif, .pdf files are allowed";
    }

    if ($_FILES['upload']['size'] > 2000000) {
      $uploadVerification = false;
      $ret = "Sorry. File is too big";
    }

    if ($uploadVerification) {
      move_uploaded_file($_FILES['upload']['tmp_name'], $target_file);
    }
  }
?>

Upload your file.
<form action="" method="post" enctype="multipart/form-data">
  <input type="file" name="upload">
  <br>
  <input type="submit" name="submit">
</form>

<h5 style="color: red;">
  <?php
    if ($ret) {
      echo($ret);
    }
  ?>
</h5>
