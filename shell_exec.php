<?php
    $output = shell_exec('ls -lah');
    echo "<pre>" . $output . "</pre>";

    $pwd = shell_exec("pwd");
    echo "<pre>" . $pwd . "</pre>";

    //Check to see if directory exists

    $dir = "test";
    $ls = shell_exec($dir);
    $fail = "ls: cannot access '$dir/': No such file or directory";
    var_dump($ls);
    echo "<pre>" . $ls . "</pre>";

    if ($ls == NULL) {
        echo "This directory does not exist. Creating directory...";
        shell_exec("mkdir" . $dir);
    } else {
        echo "this directory does exist.";
    }
?>