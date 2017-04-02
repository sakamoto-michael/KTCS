<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="utf-8">
      <meta http-equiv="X UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
      <meta name="description" content="Kingston Car Share (K-Town Car Share) Registration">
      <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
      <title>KTCS Registration</title>

      <!-- Bootstrap Base CSS -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Animate.css -->
         <link rel="stylesheet" type="text/css" href="css/animate.css">
      <!-- Custom Page Styling CSS -->
         <link rel="stylesheet" type="text/css" href="css/registration.css">
      <!-- Page Fonts -->
         <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">
    </head>
<body>

<?php
//Create a user session or resume an existing one
session_start();
?>

<!-- Insert the user into our database -->
<!-- do we need a session iD? -->

<?php
 
 // if(isset($_POST['newMemberBtn']) && isset($_SESSION['id'])){
 if(isset($_POST['newMemberBtn'])){

  // include database connection
  // if you are in a session, and updateBtn is clicked
    include_once 'config/connection.php';
	// Assign variables?
	// http://www.inmotionhosting.com/support/edu/website-design/using-php-and-mysql/php-insert-database
	// http://php.net/manual/en/function.mysql-query.php
	// see whats in array
	// foreach (array_keys($_POST) as $randy){
	// 	echo "$randy";
	// 	echo " ^ ";
	// see the keys
	// }

	$users_Name = $_POST['Name'];
	$users_Address = $_POST['Address'];
	$users_Phone = $_POST['Phone_Number'];
	$users_Email = $_POST['Email'];
	$users_DLN = $_POST['DLN'];
	$users_MMF = 30;
	$users_UName = $_POST['username'];
	$users_pass = $_POST['password'];
	// haHAA hackers
	$users_Name = mysql_real_escape_string($users_Name);
	$users_Address = mysql_real_escape_string($users_Address);
	//$users_Phone = mysql_real_escape_string($users_Phone);
	$users_Email = mysql_real_escape_string($users_Email);
	$users_UName = mysql_real_escape_string($users_UName);
	$users_pass = mysql_real_escape_string($users_pass);
	//$users_DLN = mysql_real_escape_string($users_DLN);
	//$users_MMF = mysql_real_escape_string($users_MMF);

	// $query = "INSERT INTO 'ktcs members'('Name','Address','Phone Number','Email','DLN','Monthly Membership Fee') VALUES ('$users_Name','$users_Address',$users_Phone,'$users_Email',$users_DLN,$users_MMF)";
	$query = sprintf("INSERT INTO `ktcs members`(`Name`,`Address`,`Phone Number`,`Email`,`DLN`,`Monthly Membership Fee`, `username`, `password`) VALUES ('%s','%s',%d,'%s',%d,%d,'%s','%s')",
    ($users_Name),($users_Address),($users_Phone),($users_Email),($users_DLN),($users_MMF),($users_UName),($users_pass));
    // echo $query;
	// $result = $con($query); // dont use mysql_query use for db
	$result = mysqli_query($con,$query);

	//echo "hi";

	$message = "User succesfully created";
	echo "<script type='text/javascript'>alert('$message');</script>";
	//Error check verry nice
	// if (!$result) {
 //    $message  = 'Invalid query: ' . mysql_error() . "\n";
 //    $message .= 'Whole query: ' . $query;
 //    die($message);
//}

 }

 // have a button that says return to login with these 3 lines under
 // 	session_destroy(oid)roy();
 // 	header("Location: index.php"); // get outta here
	// die();
 ?>

<!-- Return home --> 
<?php
if(isset($_POST['returnBtn'])){
	session_destroy();
	header("Location: index.php"); // or wherever you want it to return
	die(); 
	}
?>

<!-- HTML form here -->
<div class="container-fluid registration-layout">
    <div class="row">
    <h1>K-Town Car Share</h1>
    <div class="col-md-6" id="registration-box">
        <h2><b>Let's get started.</b></h2>
    <form name='createProfile' id='createProfile' action='newMember.php' method='post'>
    <div id="reg-wrapper">
        <p>
            <label>Name</label>
            <input type='text' name='Name' id='Name'/>
        </p>
        <p>
            <label>Username</label>
            <input type='text' name='username' id='username'/>
        </p>
        <p>
            <label>Password</label>
            <input type='password' name='password' id='password'/>
        </p>
		<p>
            <label>E-mail</label>
            <input type='text' name='Email' id='Email' />
        </p>
        <p>
            <label>Address</label>
            <input type='text' name='Address' id='Address' />
        </p>
        <p>
            <label>Phone Number (Only Numbers)</label>
            <input type='text' name='Phone Number' id='Phone Number' />
        </p>
        <p>
            <label>Driver's License Number</label>
            <input type='text' name='DLN' id='DLN' />
        </p>
        <!-- Submit -->
        <p>
            <input type='submit' name='newMemberBtn' id='newMemberBtn' value='Register' />
        </p>
    </div>
    </form>
    </div>

    <form name='returnPrev' id='returnPrev' action='index.php' method='post'>
        <input type='submit' name='returnBtn' id='returnBtn' value='Return To Login'/>
    </form>
    </div>
</div>
</body>
</html>