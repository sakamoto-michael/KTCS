<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kingston Car Share (K-Town Car Share)">
    <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
    <title>Highest / Lowest Rented Cars</title>

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
<h1 style="padding-top:40px;padding-bottom:40px;">Most / Least Rented Cars</h1>
<h3> Most Popular:</h3>
<?php
//Create a user session or resume an existing one
session_start();
?>

<?php 
include_once 'config/connection.php';
$model;
$VIN;
$totalCount;
if(isset($_POST['mostPopBtn'])){
	$query = "SELECT `Model`,`VIN`,`totalCount` FROM `car` NATURAL JOIN (SELECT `VIN`,MAX(`hi`) AS totalCount FROM (SELECT `VIN`, COUNT(`VIN`) as hi FROM `car rental history` GROUP BY `VIN` ORDER BY `hi` DESC) AS getCount) AS getMax ";
	$result = mysqli_query($con,$query);
	while ($row = $result->fetch_assoc()){
 			$model = $row["Model"]; // this gets it lmao
 			$VIN = $row["VIN"];
 			$totalCount = $row["totalCount"];
 		}
	echo "Most Popular Car: $model | VIN: $VIN | Number of times rented: $totalCount";
	}
?>
<form name='popular' id='popular' action='highLow.php' method='post'> 
    <!-- Submit -->
    <input type='submit' name='mostPopBtn' id='mostPopBtn' value='Most Popular' /> 
</form>


<h3>Least Popular:</h3>
<?php 
$model1;
$VIN1;
$totalCount1;
if(isset($_POST['leastPopBtn'])){
	$query = "SELECT `Model`,`VIN`,`totalCount` FROM `car` NATURAL JOIN (SELECT `VIN`,`hi` AS totalCount FROM (SELECT `VIN`, COUNT(`VIN`) as hi FROM `car rental history` GROUP BY `VIN` ORDER BY `hi` DESC) AS getCount) AS getMax";
	$resultL = mysqli_query($con,$query);
    if(mysqli_num_rows($resultL) == 0){
        echo "Multiple least popular cars";
    }
    else{
	while ($row1 = $resultL->fetch_assoc()){
 			$model1 = $row1["Model"]; // this gets it lmao
 			$VIN1 = $row1["VIN"];
 			$totalCount1 = $row1["totalCount"];
 		}
 
	echo "Least Popular Car: $model1 | VIN: $VIN1 | Number of times rented: $totalCount1";
	}
}
?>

<form name='leastPopular' id='leastPopular' action='highLow.php' method='post'>
    <!-- Submit -->
    <input type='submit' name='leastPopBtn' id='leastPopBtn' value='Least Popular' /> 
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