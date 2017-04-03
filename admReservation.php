<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kingston Car Share (K-Town Car Share)">
    <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
    <title>Check Reservations</title>

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
<div class="col-md-12">
<h1 style="padding-top:40px;padding-bottom:40px;">Check Reservations</h1>

<?php
 
 // if(isset($_POST['newMemberBtn']) && isset($_SESSION['id'])){
 if(isset($_POST['listreserveBtn'])){

 	include_once 'config/connection.php';

 	$availableDate = $_POST['listReserve'];
 	$availableDate = mysql_real_escape_string($availableDate);

 	//$query = "SELECT DISTINCT Model,VIN,Location FROM `car`,`reservation` WHERE car.VIN = reservation.Car AND reservation.Date > '$availableDate'";
 	$query = "SELECT * FROM `car` NATURAL JOIN `reservation` WHERE  '$availableDate' >= Date AND '$availableDate' <= dropDate";
 	
 	//printf($availableDate);
 	$availResult = mysqli_query($con,$query);
 	if (!$availResult) {
 	echo "Could not successfully run query ($query) from DB: " . mysql_error();
    exit;
	}
	if ($availResult = $con->query($query)){
		while ($row = $availResult->fetch_assoc()){
			printf("Car model: '%s' | \t VIN: %d | \t Daily Fee: %d | \t Reservation Number: %d | \t Member ID: %d | \t Pickup Date: '%s' | \t Drop-Off Date: '%s' | \t Access Code: %d | \t Length of Reservation: %d", $row["Model"],$row["VIN"],$row["Daily Rental Fee"],$row["Reservation Number"],$row["MemberID"],$row["Date"],$row["dropDate"],$row["Access Code"],$row["Length of Reservation"]);
			echo "<br>";
		}
	}


 }
?>

<form name='reserveList' id='reserveList' action='admReservation.php' method='post'>
        <tr>
        <tr>
        	<td>Enter a Date to Check Reservations:</td>
            <td><input type='text' name='listReserve' id='listReserve'/></td>
        </tr>
        </tr>

        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='listreserveBtn' id='listreserveBtn' value='Check' /> 
            </td>
        </tr>
</form>
<form  style="padding-top:20px;" name='returnPrev' id='returnPrev' action='adminHome.php' method='post'>
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='returnBtn' id='returnBtn' value='Return' /> 
            </td>
        </tr>
</form>

</body>
</html>