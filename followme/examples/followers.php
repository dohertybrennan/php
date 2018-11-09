<?php
//Start Session if it is not running
//Add name attributes to form elements
//Set default values for each form element from $_SESSION
//Update submitted values to database
//Upldate submitted values to $_SESSION

if (!isset($_SESSION)) {
        session_start();
}

require('../../example/dbconnection.php');
        $self_id = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                foreach ($_POST as $key => $value) {
                        echo $value;
                    $updated_followers_ids[] = $value;
                }
                foreach ($follower_user_ids as $a => $i) {
                    foreach ($updated_followers_ids as $b => $j) {
                        if ($i == $j) {
                            $match = true;
                            break;
                        } else {
                            $match = false;
                        }
                    }
            
                    if (!$match) {
                        $sql = "SELECT exists(select * from fm_followers where user_id = $user_id and follower = $i) as bool";
                        $bool = $conn->query($sql);
                        while ($row = $bool->fetch_assoc()) {
                            if ($row['bool'] == '1') {
                                $sql = "DELETE FROM fm_followers WHERE user_id = $user_id and follower = $i";
                                $delete = $conn->query($sql);
                            } else {
                                $sql = "INSERT INTO fm_followers values ($user_id, $i)";
                                $insert = $conn-query($sql);
                            }
                        }
                    }
                }
                /*$sql = "SELECT follower from fm_followers WHERE user_id = $user_id";
                $follower_result = $conn->query($sql);
                while ($row = $follower_result->fetch_assoc()) {
                    $follower_user_ids[] = $row['follower'];
                }
                
                }*/
                header("Location: followers.php");
            }
                $sql = "SELECT follower from fm_followers WHERE user_id = $self_id";
                $follower_result = $conn->query($sql);
                while ($row = $follower_result->fetch_assoc()) {
                    $updated_followers_ids[] = $row['follower'];
                }

                $sql = "select count(*) from fm_users";
                $count_followers = $conn->query($sql);
                while ($row = $count_followers->fetch_row()) {
                    $num_followers = $row[0];
                }
            
        $sql = "SELECT * FROM fm_users WHERE user_id";
        $result = $conn->query($sql);

?>
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Follow me by Matthew</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <meta name="viewport" content="width=device-width" />

        <!-- Bootstrap core CSS     -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/paper-kit.css?v=2.1.0" rel="stylesheet"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="../assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href="../assets/css/nucleo-icons.css" rel="stylesheet">

</head>
<body>
  <nav class="navbar navbar-expand-md fixed-top navbar-transparent" color-on-scroll="150">
    <div class="container">
                        <div class="navbar-translate">
               <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-bar"></span>
                                   <span class="navbar-toggler-bar"></span>
                                   <span class="navbar-toggler-bar"></span>
               </button>
               <a class="navbar-brand" href="#">Follow Me</a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                                                                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                                                                                <?php echo $_SESSION['email']; ?>
                                                                                        </a>
                        </li>
                    </ul>
                </div>
                </div>
    </nav>

    <div class="wrapper">
      <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('../assets/img/fabio-mangione.jpg');">
                          <div class="filter"></div>
                  </div>

                        <br />
                        <br />

                        <div class="row">
                                <div class="col-md-6 ml-auto mr-auto">
                                        <form action="" method="POST">
                                        <ul class="list-unstyled follows">
                                                <?php
                                                for ($i=0; $i < $num_followers; $i++) { 
                                                        $current_user = $updated_followers_ids[$i];
                                                        $sql = "SELECT * FROM fm_users";
                                                        $result = $conn->query($sql);
                                                
                                                while ($row = $result->fetch_assoc()) {
                                                        $first_name = $row['first_name'];
                                                        $last_name = $row['last_name'];
                                                        $img_url = $row['img_url'];
                                                        $title = $row['title'];
                                                        $user_id = $row['user_id'];

                                                        foreach ($updated_followers_ids as $key => $value) {
                                                                if ($value == $user_id) {
                                                                        $checked = "checked";
                                                                        break;
                                                                } else {
                                                                        $checked = " ";
                                                                }
                                                        }

                                                        echo "<li>
                                                                <div class=\"row\">
                                                                        <div class=\"col-md-2 col-sm-2 ml-auto mr-auto\">
                                                                                <img src=\"$img_url\" alt=\"Circle Image\" class=\"img-circle img-no-padding img-responsive\">
                                                                        </div>
                                                                        <div class=\"col-md-7 col-sm-4  ml-auto mr-auto\">
                                                                                <h6>$first_name $last_name<br/><small>$title</small></h6>
                                                                        </div>
                                                                        <div class=\"col-md-3 col-sm-2  ml-auto mr-auto\">
                                                                                <div class=\"form-check\">
                                                                                        <label class=\"form-check-label\">
                                                                                                <input class=\"form-check-input\" type=\"checkbox\" value=\"$user_id\" name=\"$i\" $checked>
                                                                                                <span class=\"form-check-sign\"></span>
                                                                                        </label>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </li>
                                                        <hr>";
                                                }
                                                }
                                                ?>

                                                <!--<li>
                                                        <div class="row">
                                                                <div class="col-md-2 col-sm-2 ml-auto mr-auto">
                                                                        <img src="../assets/img/faces/clem-onojeghuo-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                                </div>
                                                                <div class="col-md-7 col-sm-4  ml-auto mr-auto">
                                                                        <h6>Flume<br/><small>Musical Producer</small></h6>
                                                                </div>
                                                                <div class="col-md-3 col-sm-2  ml-auto mr-auto">
                                                                        <div class="form-check">
                                                                                <label class="form-check-label">
                                                                                        <input class="form-check-input" type="checkbox" value="" checked>
                                                                                        <span class="form-check-sign"></span>
                                                                                </label>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </li>
                                                <hr />-->
                                        </ul>
                                        <button class="btn btn-warning btn-round" type="submit" value="submit">Find artists</button>
                                        </form>
                                </div>
                        </div>
                </div>


        <footer class="footer section-dark">
        <div class="container">
            <div class="row">
                <nav class="footer-nav">
                    <ul>
                        <li><a href="https://www.creative-tim.com">Creative Tim</a></li>
                        <li><a href="http://blog.creative-tim.com">Blog</a></li>
                        <li><a href="https://www.creative-tim.com/license">Licenses</a></li>
                    </ul>
                </nav>
                <div class="credits ml-auto">
                    <span class="copyright">
                        © <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                    </span>
                </div>
            </div>
        </div>
    </footer>
</body>

<!-- Core JS Files -->
<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<!-- <script src="../assets/js/tether.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>


<!--  Paper Kit Initialization snd functons -->
<script src="../assets/js/paper-kit.js?v=2.1.0"></script>

</html>
