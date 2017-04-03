<!DOCTYPE HTML>
<html>
    <head>
        <!-- This will be used to make a new member -->
  		<!-- not checking for duplicated information -->
  		<!-- I think this is done -->
        <meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Rental History</title>

        <!-- Bootstrap Base CSS -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Animate.css -->
         <link rel="stylesheet" type="text/css" href="css/animate.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" type="text/css" href="font-a/css/font-awesome.css">
        <!-- Custom Page Styling CSS -->
         <link rel="stylesheet" type="text/css" href="css/main.css">
        <!-- Page Fonts -->
         <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">
    </head>
<body>
<div class="container-fluid locations">
<div class="row">
<div class="col-md-12">
<form style="padding-bottom:10px;" name='rentalHistory' id='rentalHistory' action='userRentalHistory.php' method='post'>
<h1>Rental History</h1>
<h3>Confirm your account credentials to check your personal rental history:</h3>
    <p>
      <label>Enter Username:</label>
      <input type='text' name='username' id='username'/>
    </p>
    <p>
      <label>Enter Password:</label>
      <input type='password' name='password' id='password'/>
    </p>
    <!-- Submit -->
    <input type='submit' name='historyBtn' id='historyBtn' value='Discover your history' /> 
</form>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
if(isset($_POST['historyBtn'])){
include_once 'config/connection.php';
$user_UName = $_POST["username"];
$user_Pass = $_POST["password"];
$user_UName = mysql_escape_string($user_UName);
$user_Pass = mysql_escape_string($user_Pass);
$date;
$cost;
$lengthOfUse;
$model;
$findQuery = "SELECT `Date`,`Length of Reservation`,`Model`,`Daily Rental Fee` FROM `car rental history` NATURAL JOIN `car` WHERE `MemberID`=(SELECT `DLN` FROM `ktcs members` WHERE username='$user_UName' AND password='$user_Pass')";

$findResult = mysqli_query($con,$findQuery); // execute the query
 	// assumes only one result returned
 	while ($row = $findResult->fetch_assoc()){
 			$date = $row["Date"]; // this gets it lmao
 			$lengthOfUse = $row["Length of Reservation"];
 			$model = $row["Model"];
 			$cost = $row["Daily Rental Fee"];
 			// should i put the display in here? i guess for multiple shit
 			$cost = ($lengthOfUse * $cost);
 			echo "Model: $model | Date Returned: $date | Length of Use: $lengthOfUse | Cost: $cost";
 			echo "<br>";
 	} // does this work lul
 }
?>

<form style="padding-top:20px;" name='returnPrev' id='returnPrev' action='home.php' method='post'>
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='returnBtn' id='returnBtn' value='Return' /> 
            </td>
        </tr>
</form>
</div>
</div>
</div>
</body>
</html>