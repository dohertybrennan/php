<?php
    //Check to see if the session has started
    if (!isset($_SESSION)) {
        session_start();
    }

    //Sends user to login if not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }

    if (isset($_POST['submit'])) {
        $sql = "UPDATE users SET username = \" $_POST['username']\", password = \" $_POST['password'] \" WHERE user_id = $_POST['id']";
        $result = $conn->query($sql);
    }

    if (isset($_POST['id']) && $_POST['edit'] == 'Edit') {
        require('dbconnection.php');
        $sql = "SELECT * FROM users WHERE user_id = ". $_POST['id'];
        $result = $conn->query($sql);

        echo "<form action='' method='post'>";

        while ($row = $result->fetch_assoc()) {
            echo "<input type=\"text\" disabled value='" . $row['user_id'] . "' name='id'><br>";
            echo "<input type=\"text\" value='" . $row['username'] . "' name='username'><br>";
            echo "<input type=\"text\" value='" . $row['password'] . "' name='password'>";
        }

        echo "<button type=\"submit\" value=\"Save Changes\" name=\"submit\">";


    } else {
        echo "Thall shall not pass!";

    }
?>