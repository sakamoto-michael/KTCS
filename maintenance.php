<!DOCTYPE HTML>
<html>
    <head>
        <title>Since last maintenance</title>
        <!-- This will be used to make a new CAR -->
  		<!-- not checking for duplicated information -->
  		<!-- NOT CHECKING FOR INVALID INPUT (ie) addresses dont match-->
    </head>
<body>
<h1>Car travelled 5k or more since last maintenance</h1>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
 
if(isset($_POST['maintenanceBtn'])){
	include_once 'config/connection.php';
	$date;
	$VIN;
	$lastOdometer;
	$newVIN;
	$findLastMaint = "SELECT MAX(`Date`) AS theDate,`VIN`,`Odometer Reading` FROM `car maintenance history` GROUP BY `VIN`";
	$findMaintResult = mysqli_query($con,$findLastMaint);
	// if(mysqli_num_rows($findMaintResult)==0){
	// }
	while ($rowName = $findMaintResult->fetch_assoc()){
 			$date = $rowName["theDate"];
 			$VIN = $rowName["VIN"];
 			$lastOdometer = $rowName["Odometer Reading"];
 			// Only check the 5 k after they have dropped it off
 			// because you dont know how far they'll take it
 			$check5K = "SELECT `VIN` FROM `car rental history` WHERE `VIN`=$VIN AND $date<`Date` AND (`Drop-off Odometer Reading` -$lastOdometer>5000)";
 			$find5kResult = mysqli_query($con,$check5K);
			while ($rowName1 = $find5kResult->fetch_assoc()){
				if(mysqli_num_rows($find5kResult) == 0){
 					continue; // if its empty continue may or may not need this
 				}
				$newVIN = $rowName1["VIN"];
				echo "Car number: $newVIN is due for a checkup";
			} 
 		} // end overarching loop
	} // end maintenance btn
?>

<form name='find5K' id='find5K' action='maintenance.php' method='post'>
    <table border='0'>          
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='maintenanceBtn' id='maintenanceBtn' value='Find 5k since last' /> 
            </td>
        </tr>
    </table>
</form>
</body>
</html>