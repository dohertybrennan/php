<?php
    echo "<br>";

    if (basename($_SERVER['PHP_SELF']) == "login.php") {
        echo "<a href='login.php'><strong>Login</strong></a>";
    } else {
        echo "<a href='login.php'>Login</a>";
    }

    echo " | ";

    if (basename($_SERVER['PHP_SELF']) == "users.php") {
        echo "<a href='users.php'><strong>Users</strong></a>";
    } else {
        echo "<a href='users.php'>Users</a>";
    }

    echo " | ";

    if (basename($_SERVER['PHP_SELF']) == "upload.php") {
        echo "<a href='upload.php'><strong>Upload</strong></a>";
    } else {
        echo "<a href='upload.php'>Upload</a>";
    }

    echo "<br>";
?>