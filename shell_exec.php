<?php
    $output = shell_exec('ls -lah');
    echo "<pre>" . $output . "</pre>";

    $pwd = shell_exec("pwd");
    echo "<pre>" . $pwd . "</pre>";

    //Check to see if directory exists

    $dir = "test";
    $ls = shell_exec($dir);
    $fail = "ls: cannot access '$dir/': No such file or directory";

    if ($ls == $fail) {
        echo "This directory does not exist";
    } else {
        echo "this directory does exist";
    }
?>