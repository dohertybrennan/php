<?php
//Start session 
//Uses $_SESSION['email'] to display email in navbar
//Include image url. load in $_SESSION['img_url']
//Need to create $_SESSION['first_name'] and $_SESSION['last_name']
//Modify fm_users to add title and descripton and add them in the $_SESSION.

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['submit'])) {
   require('../../example/dbconnection.php');

    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $username = trim($username);
    //$username = stripcslashes($username);
    $username = str_replace("/", "", $username);
    $username = str_replace("\\", "", $username);
    $username = preg_replace("/\s+/", "", $username);

    $_SESSION['username'] = $username;
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['title'] = $_POST['title'];
    $_SESSION['description'] = $_POST['description'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    if (isset($_FILES['upload'])) {
        $img_path = "../assets/img/faces/$user_id/";
        //checks to see if uploads directory exists
        if (!file_exists($img_path)) {
          mkdir($img_path);
        }
    
        $target_dir = $img_path;
        $target_file = $target_dir.basename($_FILES['upload']['name']);
        $uploadVerification = true;
    
        if (file_exists($target_file)) {
          $uploadVerification = false;
          $ret = "Sorry. File already exists!";
        }
    
        //Check file for type
        $file_type = $_FILES['upload']['type'];
    
        switch ($file_type) {
          case 'image/jpeg':
            $uploadVerification = true;
            break;
          case 'image/png':
            $uploadVerification = true;
            break;
          case 'image/gif':
            $uploadVerification = true;
            break;
          case 'application/pdf':
            $uploadVerification = true;
            break;
          default:
            $uploadVerification = false;
            $ret = "Sorry. Only .jpg, .png, gif, .pdf files are allowed";
        }
    
        if ($_FILES['upload']['size'] > 2000000) {
          $uploadVerification = false;
          $ret = "Sorry. File is too big";
        }
    
        if ($uploadVerification) {
          move_uploaded_file($_FILES['upload']['tmp_name'], $target_file);
        }
      }

    $sql = "UPDATE fm_users SET username = '$username', first_name = '$first_name', last_name = '$last_name', title = '$title', description = '$description', img_url = '$target_file' where user_id = $user_id ";
    $conn->query($sql);
    $_SESSION['img_url'] = $target_file;
    header('Location: profile.php');
    echo "test";
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Profile Home</title>

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
                            <?php 
                                echo $_SESSION['username'];
                            ?>
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
            <div class="section landing-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">Edit Profile</h2>
                            <form class="contact-form" action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name:</label>
										<div class="input-group">
	                                        <span class="input-group-addon">
	                                            <i class="nc-icon nc-single-02"></i>
	                                        </span>
	                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $_SESSION['first_name'];?>">
	                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name:</label>
										<div class="input-group">
	                                        <span class="input-group-addon">
	                                            <i class="nc-icon nc-single-02"></i>
	                                        </span>
	                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $_SESSION['last_name'];?>">
	                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="nc-icon nc-email-85"></i>
											</span>
											<input type="text" class="form-control" placeholder="Email" name="username" value="<?php echo $_SESSION['username'];?>">
										</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Title:</label>
										<div class="input-group">
											<span class="input-group-addon">
												<!--<i class="nc-icon nc-email-85"></i>-->
											</span>
											<input type="text" class="form-control" placeholder="Title" name="title" value="<?php echo $_SESSION['title'];?>">
										</div>
                                    </div>
                                </div> <!--Ends first row-->
                                <label>Description:</label>
                                <textarea class="form-control" rows="4" placeholder="Tell everyone a little about you..." name="description"><?php echo $_SESSION['description'];?></textarea>
                                <input type="file" name="upload">
                                <br>
                                <div class="row">
                                    <div class="col-md-4 ml-auto mr-auto text-center">
                                        <button class="btn btn-danger btn-lg btn-fill" type="submit" name="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
