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
        <title>Car Rental History</title>

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
<div class="col-md-12 text-center">
<h1 style="padding-top:40px;padding-bottom:40px;"> Rental History of Car </h1>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
if(isset($_POST['historyBtn'])){
include_once 'config/connection.php';
$carVIN = $_POST["carVIN"];
$member;
$date;
$cost;
$lengthOfUse;
$model;
$pickUp;
$dropOff;
$year;
$returnStatus;

$staticQuery = "SELECT `Model`,`Daily Rental Fee`,`Year` FROM `car rental history` NATURAL JOIN `car` WHERE `VIN`=$carVIN";
$findStaticResult = mysqli_query($con,$staticQuery); // execute the query
if(mysqli_num_rows($findStaticResult)==0){ // If nothing was found
      $message = "Nothing was found";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "Error, query returned empty result";
    //session_destroy(); // just get rid of it all
    // echo "Could not successfully run query ($query) from DB: " . mysql_error();
      header("Location: carHistory.php");
      die();
    }
 	// assumes only one result returned
 	while ($row = $findStaticResult->fetch_assoc()){
 			$model = $row["Model"]; // this gets it lmao
 			$cost = $row["Daily Rental Fee"];
 			$year = $row["Year"];
 	}
 	echo "Model: $model | Daily Cost: $cost | Model Year: $year";
 	echo "<br>";

$findQuery = "SELECT `Date`,`Length of Reservation`,`Return Status`,`Pick-up Odometer Reading`,`Drop-off Odometer Reading`,`MemberID` FROM `car rental history` NATURAL JOIN `car` WHERE `VIN`=$carVIN";

$findResult = mysqli_query($con,$findQuery); // execute the query
 	// assumes only one result returned
 	while ($row = $findResult->fetch_assoc()){
 			$date = $row["Date"]; // this gets it lmao
 			$lengthOfUse = $row["Length of Reservation"];
 			$returnStatus = $row["Return Status"];
 			$pickUp = $row["Pick-up Odometer Reading"];
 			$dropOff = $row["Drop-off Odometer Reading"];
 			$member = $row["MemberID"];
 			echo "Date Returned: $date | Length of Use: $lengthOfUse | Return Status: $returnStatus | Pick-up Odometer: $pickUp | Drop-off Odometer: $dropOff | Taken by Member: $member";
 			echo "<br>";
 	} // does this work lul
 }
?>

<form name='carHistory' id='carHistory' action='carHistory.php' method='post'>
<p>
  <td>Enter VIN:</td>
  <input type='text' name='carVIN' id='carVIN'/>      
</p>
  <!-- Submit -->
  <input type='submit' name='historyBtn' id='historyBtn' value='Discover your cars history' /> 
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
</div>
</div>
</div>
</body>
</html>