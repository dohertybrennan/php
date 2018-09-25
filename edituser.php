<?php
    //Check to see if the session has started
    if (!isset($_SESSION)) {
        session_start();
    }

    //Sends user to login if not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }

    if (isset($_GET['id']) && $GET['edit'] == 'edit') {
        require('dbconnection.php');
        $sql = "SELECT * FROM users WHERE user_id = ". $_GET['id'];
        $result = $conn->query($sql);

        echo "<form action=\"\" method=\"post\">";

        while ($row = $result->fetch_assoc()) {
            echo "<input type=\"text\" disabled value" . $row['user_id'] . ">";
        }

    } else {
        echo "Thall shall not pass!";

    }
?>