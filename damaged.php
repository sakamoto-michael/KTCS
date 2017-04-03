<!DOCTYPE HTML>
<html>
<head>
        <title>Check Damaged Cars</title>
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
<div class="col-md-12">
<h1 style="padding-top:30px;padding-bottom:30px;"> Damaged Cars </h1>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
include_once 'config/connection.php';
 $testString='damage'; // eh
 $VIN;
 $comment;
 if(isset($_POST['damageBtn'])){
 $query = "SELECT `VIN`,`Return Status` FROM `car rental history` WHERE `Return Status` LIKE '%damage%'";
 $result = mysqli_query($con,$query);
 while ($row = $result->fetch_assoc()){
 	$VIN = $row["VIN"];
 	$comment = $row["Return Status"];
 	echo "VIN: $VIN is damaged. Full report is";
 	echo "<br>";
 	echo "$comment";
 	echo "<br>";
	}
}
?>

<form style="padding-top:10px;" name='damage' id='damage' action='damaged.php' method='post'>
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='damageBtn' id='damageBtn' value='Check damaged cars' /> 
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