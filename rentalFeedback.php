<!DOCTYPE HTML>
<html>
    <head>
        <!-- Used for feedback on a rental
        Should this should be reached after the user has dropped off a car only
        ONLY CALLED IN DROP-OFF THING
        -->
        <meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Rental Feedback</title>

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
//session_start();
?>

<?php
// Get the memberID and VIn from previous page
// http://stackoverflow.com/questions/13135131/php-getting-variable-from-another-php-file
// $memID = $memberID; // memID is this page's version of dropOff.php's memberID
// $vinNum = $VIN; // same as above, just have a diff variable
// $modelN = $model; // same as above
include_once 'config/connection.php'; // done with setting variables
// $date = $_POST['theDate'];
// $findStuffQuery = "SELECT `memberID`,`VIN`,`Model` FROM `car rental history` NATURAL JOIN `car` WHERE `Date` = '$date'";
// $result = mysqli_query($con,$findStuffQuery); // execute the query
// 	// assumes only one result returned
// 	while ($row = $result->fetch_assoc()){
// 			$memID = $row["memberID"]; // this gets it lmao
// 			$vinNum = $row["VIN"];
// 			$modelN = $row["Model"];
// 	}
if(isset($_POST['yesFeedbackBtn'])){
	$memID;
	$vinNum;
	$modelN;
	$comment = $_POST['theFeedback'];
	$rating = $_POST['theRating'];
	$date = $_POST['theDate'];
	$comment = mysql_real_escape_string($comment);

    $findStuffQuery = "SELECT `memberID`,`VIN`,`Model` FROM `car rental history` NATURAL JOIN `car` WHERE `Date` = '$date'";
    $findStuffResult = mysqli_query($con,$findStuffQuery); // execute the query
 	// assumes only one result returned
 	while ($row = $findStuffResult->fetch_assoc()){
 			$memID = $row["memberID"]; // this gets it lmao
 			$vinNum = $row["VIN"];
 			$modelN = $row["Model"];
 	}
	$query = sprintf("INSERT INTO `rental comments`(`MemberID`,`Model`,`Rating`,`Comment Text`,`VIN`) VALUES (%d,'%s',%d,'%s',%d)",
    ($memID),($modelN),($rating),($comment),($vinNum));
    $result = mysqli_query($con,$query);
    header("Location: home.php");
    die();
}
?>

<?php
if(isset($_POST['noFeedbackBtn'])){
header("Location: home.php"); // put main page here
die();
}
?>

<!-- Webpage Content -->
<div class="row feedback">
<div class="col-md-12 text-center">
    <h1>Feedback On Rental</h1>
    <h3>How was your experience?</h3>
    <form name='yesFeedback' id='yesFeedback' action='rentalFeedback.php' method='post'>
        <p>
            <label>Enter your feedback:</label>
                <input type='text' name='theFeedback' id='theFeedback'/>
        </p>
        <p>
            <label>Leave a rating:</label>
                <input type='text' name='theRating' id='theRating'/>
        </p>
        <p>
            <label>Please confirm the date:</label>
                <input type='text' name='theDate' id='theDate'/>   
        </p> 
            <!-- Submit -->
            <input type='submit' name='yesFeedbackBtn' id='yesFeedbackBtn' value='Submit feedback' /> 
    </form>

    <h3>No Feedback</h3>
    <form name='noFeedback' id='noFeedback' action='rentalFeedback.php' method='post'>
        <input type='submit' name='noFeedbackBtn' id='noFeedbackBtn' value='No Feedback' /> 
    </form>
    </div>
</div>
</body>
</html>