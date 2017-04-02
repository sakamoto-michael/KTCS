<!DOCTYPE HTML>
<html>
    <head>
        <title>KTCS home page</title>
  
    </head>
<body>
<h2> Home Page </h2>

 <?php
  //Create a user session or resume an existing one
 session_start();
 ?>
 
 <?php
 //check if the user clicked the logout link and set the logout GET parameter
if(isset($_GET['logout'])){
	//Destroy the user's session.
	//$_SESSION['id']=null; // get outta here duude
	session_destroy();
}
 ?>
 
 
<!--  <?php
 //check if the user is already logged in and has an active session
//if(isset($_SESSION['id'])){
	//Redirect the browser to the profile editing page and kill this page.
	//could just do away with this shenanigans and always have them login (safety kappa)
//	header("Location: profile.php");
//	die();
//}
 ?> -->
 
<!-- REGISTER -->
<?php
//check if the login form has been submitted
if(isset($_POST['registerBtn'])){
    // include database connection
    include_once 'config/connection.php'; 
	//Redirect the browser to the profile editing page and kill this page.
	header("Location: newMember.php");
	die("Lul died");
 }
 ?>


<!-- USE THIS TO TEST VARIOUS PAGES -->
<?php
//check if the login form has been submitted
if(isset($_POST['testBtn'])){
    // include database connection
    include_once 'config/connection.php'; 
	//Redirect the browser to the profile editing page and kill this page.
	header("Location: locations.php");
	die("Lul died");
 }
 ?>

 <!-- LOGIN -->
 <?php
 
//check if the login form has been submitted
if(isset($_POST['loginBtn'])){
 
    // include database connection
    include_once 'config/connection.php'; 
	$users_UName = $_POST['username'];
	$users_pass = $_POST['password'];
	$users_UName = mysql_real_escape_string($users_UName);
	$users_pass = mysql_real_escape_string($users_pass);
	// SELECT query
    $query = "SELECT name,isAdmin FROM `ktcs members` WHERE username='$users_UName' AND password='$users_pass'";
    // Check to see if there is one that matches
	// http://php.net/manual/en/mysqli-result.fetch-assoc.php
    $result = mysqli_query($con,$query);
    if(!$result){ // If nothing was found
    	$message = "Incorrect username or password";
		echo "<script type='text/javascript'>alert('$message');</script>";
		// echo "Could not successfully run query ($query) from DB: " . mysql_error();
    }
    // Should only be one result
    // put it into a variable each
    // could make the name the sessionID for all i care
    while ($row = $result->fetch_assoc()){
		$theName = $row["name"]; // this gets it lmao
		$adminPerm = $row["isAdmin"];
	}
	echo $theName;
	echo $adminPerm;
    if ($adminPerm == 0) {
    	// if a normal user
    	header("Location: locations.php"); // change this to go to some main page user
		die("Lul died");
    }
    else{ // else they are an admin
    	header("Location: adminHome.php");
    	die("lmao");
    }
    // error check
}
?>

<!-- dynamic content will be here -->
<h4> Member Login </h4>
 <form name='login' id='login' action='index.php' method='post'>
    <table border='0'>
        <tr>
            <td>Username</td>
            <td><input type='text' name='username' id='username' /></td>
        </tr>
        <tr>
            <td>Password</td>
             <td><input type='password' name='password' id='password' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' id='adminLoginBtn' name='loginBtn' value='Log In' /> 
            </td>
        </tr>
    </table>
</form>

<h4>New Here?</h4>
<form name='register' id='register' action='index.php' method='post'>
	<table border='0'>
		<tr>
        	<td>
            	<input type='submit' id='registerBtn' name='registerBtn' value='REGISTER' /> 
            </td>
        </tr>
    </table>
</form>


<!-- Test buttons to test out functions -->
<h1>TEST</h1>
<form name='test' id='test' action='index.php' method='post'>
	<table border='0'>
		<tr>
        	<td>
            	<input type='submit' id='testBtn' name='testBtn' value='TEST' /> 
            </td>
        </tr>
    </table>
</form>
</body>
</html>