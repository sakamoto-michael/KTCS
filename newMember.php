<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome member!</title>
        <!-- This will be used to make a new member -->
  		<!-- not checking for duplicated information -->
  		<!-- FINISHED LMAOOO --> 
    </head>
<body>
<h1>Welcome New member </h1>
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
	// haHAA hackers
	$users_Name = mysql_real_escape_string($users_Name);
	$users_Address = mysql_real_escape_string($users_Address);
	//$users_Phone = mysql_real_escape_string($users_Phone);
	$users_Email = mysql_real_escape_string($users_Email);
	//$users_DLN = mysql_real_escape_string($users_DLN);
	//$users_MMF = mysql_real_escape_string($users_MMF);

	// $query = "INSERT INTO 'ktcs members'('Name','Address','Phone Number','Email','DLN','Monthly Membership Fee') VALUES ('$users_Name','$users_Address',$users_Phone,'$users_Email',$users_DLN,$users_MMF)";
	$query = sprintf("INSERT INTO `ktcs members`(`Name`,`Address`,`Phone Number`,`Email`,`DLN`,`Monthly Membership Fee`) VALUES ('%s','%s',%d,'%s',%d,%d)",
    ($users_Name),($users_Address),($users_Phone),($users_Email),($users_DLN),($users_MMF));
    // echo $query;
	// $result = $con($query); // dont use mysql_query use for db
	$result = mysqli_query($con,$query);

	//echo "hi";

	//Error check verry nice
	if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
}

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


<form name='createProfile' id='createProfile' action='newMember.php' method='post'>
    <table border='0'>
        <tr>
        <tr>
            <td>Enter your NAME</td>
             <td><input type='text' name='Name' id='Name'/></td>
        </tr>
            <td>Make a Username</td>
            <td><input type='text' name='username' id='username'/></td>
        </tr>
        <tr>
            <td>Create a Password</td>
             <td><input type='text' name='password' id='password'/></td>
        </tr>
		<tr>
            <td>Enter your email</td>
            <td><input type='text' name='Email' id='Email' /></td>
        </tr>
        <tr>
            <td>Enter your Address</td>
            <td><input type='text' name='Address' id='Address' /></td>
        </tr>
        <tr>
            <td>Enter your Phone Number (no dashes)</td>
            <td><input type='text' name='Phone Number' id='Phone Number' /></td>
        </tr>
        <tr>
            <td>Enter your Drivers License Number</td>
            <td><input type='text' name='DLN' id='DLN' /></td>
        </tr>
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='newMemberBtn' id='newMemberBtn' value='Register' /> 
            </td>
        </tr>
    </table>
</form>

<h3>Press to return to Login screen</h3>
<form name='returnPrev' id='returnPrev' action='locations.php' method='post'>
    <table border='0'>
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='returnBtn' id='returnBtn' value='Return' /> 
            </td>
        </tr>
    </table>
</form>
</body>
</html>