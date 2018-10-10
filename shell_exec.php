<?php
    $output = shell_exec('ls -lah');
    echo "<pre>" . $output . "</pre>";

    $pwd = shell_exec("pwd");
    echo "<pre>" . $pwd . "</pre>";

    //Check to see if directory exists

    $dir = "test";

    if (file_exists($dir)) {
        if (is_dir($dir)) {
            echo "This directory exists.";
        } else {
            echo "This is a file.";
        }
    } else {
        echo "This directory does not exist. Creating directory...";
        shell_exec("mkdir " . $dir);
    }
?>