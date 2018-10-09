<?php
    $cookie_name = "user";
    $cookie_seconds = "cookieSeconds";
    $cookie_date = date("l jS \of F Y h:i:s A");
    setcookie($cookie_name, $cookie_date, time()+(84600 * 30), "/");
    setcookie($cookie_seconds, time(), time()+(84600 * 30), "/");
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
            
            
            $currentTime = time();
            $timeDiff = $currentTime - $_COOKIE[$cookie_seconds];
            
            $timeDiffSec = $timeDiff;
            $timeDiffMin = 0;
            $timeDiffHour = 0;
            $timeDiffDay = 0;

            while ($timeDiffSec > 59) {
                $timeDiffSec = $timeDiffSec - 60;
                $timeDiffMin++;
            }

            while ($timeDiffMin > 59 {
                $timeDiffMin = $timeDiffMin - 60;
                $timeDiffHour++;
            }

            while ($timeDiffHour > 23) {
                $timeDiffHour = $timeDiffHour - 24;
                $timeDiffDay++;
            }
            
            echo "<br>You were last here " . $timeDiffDay . " days, " . $timeDiffHour . " hours, " . $timeDiffMin . " minutes and " . $timeDiffSec . " seconds ago. <br>";

            setcookie($cookie_name, $cookie_date, time()+(84600 * 30), "/");
            setcookie($cookie_seconds, time(), time()+(84600 * 30), "/");
            
        } else {
            echo "This is your first time here! Welcome!";
            setcookie($cookie_name, $cookie_date, time()+(84600 * 30), "/");
            
        }
    ?>
</body>
</html>