<!DOCTYPE HTML>
<html>
    <head>
        <title>KTCS</title>
  
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


<!-- Test buttons -->
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
	
	// SELECT query
        $query = "SELECT id,username, 'e-mail' FROM user WHERE username=? AND password=?";
 
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
			//$_SESSION['id'] = $myrow['id'];
			//Redirect the browser to the profile editing page and kill this page.
			header("Location: newMember.php"); // replace this later
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

<!-- dynamic content will be here -->
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
                <input type='submit' id='loginBtn' name='loginBtn' value='Log In' /> 
            </td>
        </tr>
    </table>
</form>

<h1>SUP</h1>
<form name='register' id='register' action='index.php' method='post'>
	<table border='0'>
		<tr>
        	<td>
            	<input type='submit' id='registerBtn' name='registerBtn' value='REGISTER' /> 
            </td>
        </tr>
    </table>
</form>


<!-- Test buttons -->
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