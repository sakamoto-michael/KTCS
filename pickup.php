<!DOCTYPE HTML>
<html>
<head>
        <title>Car Pick-Up</title>
  		<!-- Returns all of the locations that KTCS has  -->
  		<!-- finished i think -->
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
<h1 style="padding-top:30px;padding-bottom:60px;">Car Pick-Up</h1>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
include_once 'config/connection.php';
 $accCode;
 $theDate;
 $theStatus;
 $resNum;
 $VIN;

 if(isset($_POST['pickupBtn'])){
 	$accCode = $_POST['accCode'];
 	$theDate = $_POST['theDate'];
 	$query = "SELECT `VIN`, `Reservation Number` FROM `reservation` WHERE `Access Code` = '$accCode' AND `Date` = '$theDate'";
 	$result = mysqli_query($con,$query);
 	if(mysqli_num_rows($result) == 0 ){
 		// nothing was found
 		echo "Incorrect information given";
 	}
 	else{
 		 while ($row = $result->fetch_assoc()){
 			$VIN = $row["VIN"];
 			$resNum = $row["Reservation Number"];
 		}
 		echo "You can now use your car. Reservation Number: $resNum | VIN: $VIN";
 	}
}
?>

<form name='Pickup' id='Pickup' action='pickup.php' method='post'>
<p>
        Enter your access code:
        <input type='text' name='accCode' id='accCode'/>
</p>
<p>
        Enter the date:
         <input type='text' name='theDate' id='theDate'/>
</p>
<p>
        Enter the current status of car:
        <input type='text' name='theStatus' id='theStatus'/>
</p>
    <!-- Submit -->
    <input type='submit' name='pickupBtn' id='pickupBtn' value='Pickup Your Car!' /> 
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