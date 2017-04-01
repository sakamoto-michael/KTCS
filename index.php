<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
      	<meta http-equiv="X UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      	<meta name="description" content="Kingston Car Share (K-Town Car Share)">
      	<meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Kingston Car Share</title>

        <!-- Bootstrap Base CSS -->
	         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Animate.css -->
	         <link rel="stylesheet" type="text/css" href="css/animate.css">
        <!-- Custom Page Styling CSS -->
	         <link rel="stylesheet" type="text/css" href="css/main.css">

        <!-- Page Fonts -->
	         <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">
    </head>
<body>

 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>

 <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
	//Destroy the user's session.
	$_SESSION['id']=null;
	session_destroy();
}
 ?>


 <?php
 //check if the user is already logged in and has an active session
if(isset($_SESSION['id'])){
	//Redirect the browser to the profile editing page and kill this page.
	header("Location: profile.php");
	die();
}
 ?>

 <?php


//check if the login form has been submitted
if(isset($_POST['loginBtn'])){

    // include database connection
    include_once 'config/connection.php';

	// SELECT query
        $query = "SELECT id,username, password, email FROM user WHERE username=? AND password=?";

        // prepare query for execution
        if($stmt = $con->prepare($query)){

        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param("ss", $_POST['username'], $_POST['password']);



        // Execute the query
		$stmt->execute();

		/* resultset */
		$result = $stmt->get_result();

		// Get the number of rows returned
		$num = $result->num_rows;;

		if($num>0){
			//If the username/password matches a user in our database
			//Read the user details
			$myrow = $result->fetch_assoc();
			//Create a session variable that holds the user's id
			$_SESSION['id'] = $myrow['id'];
			//Redirect the browser to the profile editing page and kill this page.
			header("Location: profile.php");
			die("Lul died");
		} else {
			//If the username/password doesn't matche a user in our database
			// Display an error message and the login form
			echo "Failed to login";
		}
		} else {
			echo "failed to prepare the SQL";
		}
 }

?>

<!-- Dynamic Content Section -->
<!-- Cover For Loading: Fade In -->
	<div id="loading-cover"></div>

	<nav class="navbar navbar-light navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand nav-link" href="#"></a>
			</div>
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse" id="nav-menu">
                <ul class="nav navbar-nav">
                    <li class="nav-item active">
                    	<a href="#"></a>
                    </li>
                </ul>
            </div>
		</div>
	</nav>

	<div class="container-fluid landing">
		<div class="row text-center">
			<div class="col-md-12">
				<h1 class="wow fadeInDown" data-wow-delay="0.2s">K-Town Car Share</h1>
				<p class="wow fadeIn quote" data-wow-delay="0.35s">KTCS</p>
			</div>
			<div class="col-xs-12 login-window wow fadeIn" data-wow-delay="0.3s">
				<!-- Login Form Section -->
        <form name='login' id='login' action='index.php' method='post'>
  				<h2 class="wow fadeIn" data-wow-delay="0.4s">Sign In</h2>
  				<div id="u-name" class="wow fadeIn" data-wow-delay="0.45s">
  					<input type="text" placeholder="Username" id="username">
  				</div>
  				<div id="p-word" class="wow fadeIn" data-wow-delay="0.5s">
  					<input type="text" placeholder="Password" id="password">
  				</div>
  				<div id="sign-in" class="wow fadeIn" data-wow-delay="0.55s">
  					<input type="submit" id="loginBtn" name="loginBtn" value="Connect">
  				</div>
  				<div id="register-prompt">
  					<p class="wow fadeIn" data-wow-delay="0.6s"> Not a member? Sign up <a href="#">here</a>.</p>
  				</div>
        </form>
			</div>
			<div class="col-md-12 company">
				<h6 class="wow fadeInUp" data-wow-delay="0.8s">&copy; 2017 Matsuda/Xiao/Sakamoto</h6>
			</div>
		</div>
	</div>

	<footer class="container-fluid">

	</footer>

	<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

	<!-- Bootstrap JavaScript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<!-- WOW JavaScript Fade-In (Developed by Matthieu Aussaguel) -->
	    <script src="./js/wow.min.js"></script>
	    <script>
	        new WOW().init();
	    </script>

	<!-- Main JS -->
		<script src="./js/main.js"></script>

</body>
</html>
