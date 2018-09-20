<?php
    //Check to see if the session has started
    if (!isset($_SESSION)) {
        session_start();
    }

    //Sends user to login if not logged in
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
    }

    //Bring in the database connection
    require('dbconnection.php');

    //Create the SQL query
    $sql = "SELECT * FROM users";

    //Execute the SQL query
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Password Hash</th>
        </tr>
        <?php
            //Loop through all table records
            while ($row = $result->fetch_assoc()) {
                echo("<tr>");
                    echo("<td>". $row['userid'] ."</td");
                    echo("<td>". $row['username'] ."</td");
                    echo("<td>". $row['password'] ."</td");
                echo("</tr>");
            }
        ?>
    </table>
</body>
</html>