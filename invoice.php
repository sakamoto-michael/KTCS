<!DOCTYPE HTML>
<html>
    <head>
        <!-- This will be used to make a new member -->
  		<!-- not checking for duplicated information -->
        <meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Monthly Invoice Generation</title>
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
<h1 style="padding-top:30px;padding-bottom:60px;">Monthly Invoice Generation</h1>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
 
if(isset($_POST['invoiceBtn'])){
	include_once 'config/connection.php';
	$memberID = $_POST['memberID'];
    $theDate = $_POST['currentDate'];
	$totalCost = 0;
	$daysUsed;
	$dateReturned;
	$model;
	$costOfCar;
	$userName;
	$findQuery = "SELECT `Date`,`Length of Reservation`,`Model`,`Daily Rental Fee` FROM `car rental history` NATURAL JOIN `car` WHERE `MemberID`= $memberID AND `Date` BETWEEN ('$theDate' - INTERVAL 1 MONTH) AND '$theDate';"; 
	$findResult = mysqli_query($con,$findQuery); // execute the query
	
	$findName = "SELECT `Name` FROM `ktcs members` WHERE `DLN`=$memberID";
	$nameResult = mysqli_query($con,$findName);
	while ($rowName = $nameResult->fetch_assoc()){
 			$userName = $rowName["Name"];
 	}
 	// assumes only one result returned
 	echo "Invoice for user: $memberID";
 	echo "<br>";
 	echo "Name: $userName";
 	echo "<br>";
 	while ($row = $findResult->fetch_assoc()){
 			$dateReturned = $row["Date"]; // this gets it lmao
 			$daysUsed = $row["Length of Reservation"];
 			$model = $row["Model"];
 			$costOfCar = $row["Daily Rental Fee"];
 			$costOfCar = ($daysUsed * $costOfCar);
 			$totalCost = ($totalCost + $costOfCar);
 			echo "Model: $model | Date Returned: $dateReturned | Length of Use: $daysUsed | Cost: $costOfCar";
 			echo "<br>";
 	} // does this work lul
 	$totalCost = ($totalCost + 30);
 	echo "Total Money owed: $totalCost";
 }
?>

<form name='invoice' id='invoice' action='invoice.php' method='post'>
        <label style="color:#000;">Enter the Member ID:</label>
        <td><input type='text' name='memberID' id='memberID'/></td>
        <label style="color:#000;">Enter the Date:</label>
        <td><input type='text' name='currentDate' id='currentDate'/></td>
        <!-- Submit -->
        <td>
            <input type='submit' name='invoiceBtn' id='invoiceBtn' value='Generate it!' /> 
        </td>

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
<!-- Check which cars need repairs -->
</body>
</html>