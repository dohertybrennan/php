<?php
    $cookie_name = "user";
    $cookie_date = time();
    setcookie($cookie_name, $cookie_date, time()+(84600 * 30), "/");
    setcookie("cookieSeconds", time() , time()+(84600 * 30), "/");
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
            echo "You have been here before! Good to see you again! <br>";
            echo "You have last been here ". $_COOKIE['user'];
            
            
            $currentTime = date_create();
            $timeDiff = date_diff($_COOKIE['cookieSeconds'], $currentTime);
            echo $timeDiff->s . "seconds";
            echo $_COOKIE['cookieSeconds'];
            setcookie($cookie_name, $cookie_date, time()+(84600 * 30), "/");

            
        } else {
            echo "This is your first time here! Welcome!";
            setcookie($cookie_name, $cookie_date, time()+(84600 * 30), "/");
            
        }
    ?>
</body>
</html>