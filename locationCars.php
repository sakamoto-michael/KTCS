<!DOCTYPE HTML>
<html>
    <head>
        <title>Location-Car Information</title>
        <!-- This will be used to make a new CAR -->
  		<!-- not checking for duplicated information -->
  		<!-- NOT CHECKING FOR INVALID INPUT (ie) addresses dont match-->
  		<meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
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
<div class="row text-center">
<div class="col-md-12 invoice">
<h1 style="padding-top:30px;padding-bottom:60px;">Available Cars</h1>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
include_once 'config/connection.php';

if(isset($_POST['showCarsBtn'])){
	$location = $_POST['location'];
	$location = mysql_real_escape_string($location);
	$currentDay = $_POST['day'];
	$model;
	$VIN;
	$pickup;
	$dropOff;
	echo "Cars at location: $location";
	echo "<br>";
	// Find all the cars
	$findAvailCars = "SELECT DISTINCT `VIN`,`Model`,`Date`,`dropDate` FROM  `reservation` NATURAL JOIN (SELECT `VIN`,`Model` FROM `car` WHERE `Address` = '$location') AS tableA WHERE (('$currentDay'<`Date` || '$currentDay'>`dropDate`) AND !(('$currentDay' >= `Date`) AND ('$currentDay' <= `dropDate`)))";
	// either less than (so it hasnt happened)
	// or it the day is passed the drop date
	// and it is not in the middle of the drop date and such 
	$availResult = mysqli_query($con,$findAvailCars); // currently available
	if(mysqli_num_rows($availResult) == 0){
		echo "Error, no tables returned";
	}
	while ($row = $availResult->fetch_assoc()){
		$model = $row["Model"];
		$VIN = $row["VIN"];
		$pickup = $row["Date"];
		$dropOff = $row["dropDate"];
		echo "Model: $model is available  |  VIN: $VIN  |";
		echo "<br>";
		$checkIfTaken = "SELECT `Date`,`dropDate` FROM `reservation` WHERE ('$currentDay' < `Date` AND `VIN`=$VIN)"; 
		// any reservations made on a date after today
		// check for cars that have a reservation
		$checkTakenRes = mysqli_query($con,$checkIfTaken);
		if(mysqli_num_rows($checkTakenRes) == 0){
			echo "No reservations for current car";
			echo "<br>";
			continue; // move on to next thing because there are no reservations made for car
		}
		else{
			while ($row1 = $checkTakenRes->fetch_assoc()){
				$pickup = $row1["Date"];
				$dropOff = $row1["dropDate"];
				echo "Has future reservations for Pickup: $pickup and Dropoff: $dropOff";
				echo "<br>";
			}
		}
	} // end first while
} // end if
?>

<form style="padding-top:20px;" name='showCars' id='showCars' action='locationCars.php' method='post'>
        <tr>
            <td>Enter in search location:</td>
             <td><input type='text' name='location' id='location'/></td>
        </tr>  
        <tr>
            <td>Enter YYYY-MM-DD:</td>
             <td><input type='text' name='day' id='day'/></td>
        </tr>           
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='showCarsBtn' id='showCarsBtn' value='Find the cars' /> 
            </td>
        </tr>
</form>
<form style="padding-top:10px;" name='returnPrev' id='returnPrev' action='adminHome.php' method='post'>
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
