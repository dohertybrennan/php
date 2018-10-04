<?php
    /*$cookie_name = "user";
    $cookie_value = "bob";
    setcookie($cookie_name, $cookie_value, time()+(84600 * 30), "/");*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cookie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php
        if (isset($_COOKIE['user'])) {
            echo "You have been here before! Good to see you again!";
        } else {
            echo "This is your first time here! Welcome!";
        }
    ?>
</body>
</html>