<!DOCTYPE HTML>
<html>
    <head>
        <!-- 
        SHOULD ONLY BE CALLED FROM USER HOME PAGE
        Puts stuff into car rental history
        removes from reservation
        -->
        <meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Drop-Off</title>

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
<?php
//Create a user session or resume an existing one
session_start();
?>

<!-- Removes the car from reservation and inserts a new thing into car rental history -->
<!-- The odometer readings and return status should be done by an admin only -->
<?php
include_once 'config/connection.php';
$memberID;
$VIN;
$model;
// http://stackoverflow.com/questions/13135131/php-getting-variable-from-another-php-file

if(isset($_POST['retCarBtn'])){
	$access_code = $_POST['accCode'];
	$date = $_POST['theDate'];
	$pastOdom = $_POST['ogOdom'];
	$nowOdom = $_POST['currentOdom'];
	$condition = $_POST['condition'];
	$lengthRes = $_POST['lengthU'];

	$access_code = mysql_real_escape_string($access_code);
	$condition = mysql_real_escape_string($condition);
	$date = mysql_real_escape_string($date);

	// get the memberID, vin, model
	$query = "SELECT `memberID`,`VIN`,`Model` FROM `reservation` NATURAL JOIN `car` WHERE `Access Code` = '$access_code'";
	$result = mysqli_query($con,$query); // execute the query
	// assumes only one result returned
	while ($row = $result->fetch_assoc()){
			$memberID = $row["memberID"]; // this gets it lmao
			$VIN = $row["VIN"];
			$model = $row["Model"];
	}
	
	// use this to get rid of reservation
	$deleteQuery = "DELETE FROM `reservation` WHERE `Access Code` = '$access_code'";
	$resultDelete = mysqli_query($con,$deleteQuery); // execute the query
	
	// Must now add to car rental history
	$addToRental = sprintf("INSERT INTO `car rental history`(`VIN`,`Pick-up Odometer Reading`, `Drop-off Odometer Reading`, `Return Status`, `MemberID`, `Date`,`Length of Reservation`) VALUES (%d,%d,%d,'%s',%d,'%s',%d)",($VIN),($pastOdom),($nowOdom),($condition),($memberID),($date),($lengthRes));
	$resultInsert = mysqli_query($con,$addToRental);

	header("Location: rentalFeedback.php");
	die();
}
?>


<!-- Webpage Content -->
<div class="container-fluid locations">
<div class="row">
<div class="col-md-12 text-center">
<h1> Drop-Off Your Rental</h1>
<form name='drop-off' id='drop-off' action='dropOff.php' method='post'>
    <p>
        <label>Enter Your Access Code:</label>
        <input type='text' name='accCode' id='accCode'/>
    </p>    
	<p>
        <label>Enter Original Odometer Reading:</label>
        <input type='text' name='ogOdom' id='ogOdom'/>
    </p>
    <p>
        <label>Enter Current Odometer Reading:</label>
        <input type='text' name='currentOdom' id='currentOdom'/>
    </p>
    <p>
        <label>Enter Condition:</label>
        <input type='text' name='condition' id='condition'/>
    </p>
    <p>
        <label>Enter The Date:</label>
        <input type='text' name='theDate' id='theDate'/>
    </p>
    <p>
        <label>Enter Length Of Reservation:</label>
        <input type='text' name='lengthU' id='lengthU'/>
    </p>
    <p>
        <!-- Submit -->
        <input type='submit' name='retCarBtn' id='retCarBtn' value='Return Car' /> 
    </p>
     
</form>
<form style="padding-top:10px;" name='returnPrev' id='returnPrev' action='home.php' method='post'>
    <!-- Submit -->
    <input type='submit' name='returnBtn' id='returnBtn' value='Return' /> 
</form>
</div>
</div>
</div>
</body>
</html>