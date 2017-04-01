<!DOCTYPE HTML>
<html>
    <head>
        <title>Welcome member!</title>
        <!-- This will be used to make a new member -->
  		<!-- not checking for duplicated information -->
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
	$query = "INSERT INTO ktcs members ('Name','Address','Phone Number','Email','DLN','Monthly Membership Fee') VALUES (?,?,?,?,?,?)";
	// have a 30?
    // update user table, set password = what you typed in
	$stmt = $con->prepare($query);	// this is the error / next one
	var_dump($query);
	$stmt->bind_param("ssisii", $_POST['Name'], $_POST['Address'], $_POST['Phone Number'], $_POST['Email'], $_POST['DLN'],30);
	// Execute the query
        if($stmt->execute()){
            echo "User was added. <br/>";
        }else{
            echo 'Unable to update record. Please try again. <br/>';
        }
 }

 // have a button that says return to login with these 3 lines under
 // 	session_destroy(oid)roy();
 // 	header("Location: index.php"); // get outta here
	// die();
 ?>

<!-- -->

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
                <input type='submit' name='newMemberBtn' id='newMemberBtn' value='Update' /> 
            </td>
        </tr>
    </table>
</form>

</body>
</html>