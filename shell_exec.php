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
            
            $files = array();

            foreach (scandir($dir) as $file) {
                if ('.' === $file) continue;
                if ('..' === $file) continue;

                $files[] = $file;
                echo $file . "<br>";
            }
            

        } else {
            echo "This is a file.";
        }
    } else {
        echo "This directory does not exist. Creating directory...";
        shell_exec("mkdir " . $dir);
    }

    echo "<br><br>";

    var_dump(shell_exec('w'));
    echo "<br><br>";
    var_dump(shell_exec('who'));
    echo "<br><br>";

    $w = shell_exec("w");
    $users = explode("\n", $w);
    var_dump($users);

    for ($i=0; $i < count($users); $i++) { 
        if (i < 2) {
            continue;
        }
        //$user = substr($users[i], 0, strpos($users[i], " "));
        echo $users[i];
    }
    
?>