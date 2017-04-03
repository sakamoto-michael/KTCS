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
        <title>Admin Home</title>

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
    <div class="container-fluid dashboard-styling">
        <div class="row">
            <div class="col-md-12" id="dashboard">
                <h1> Welcome to the KTCS Dashboard! </h1>
                <h3 class="wow fadeIn" data-wow-delay="0.3s"> Find everything you need here.</h3>
            </div>
        </div>
        <div class="row features">
            <a href="invoice.php">
            <div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="0.8s">
                <div class="inner text-center">
                    <p><b>Invoice Generation</b></p>
                    <i class="fa fa-paperclip fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
            <a href="highLow.php">
            <div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1s">
                <div class="inner text-center">
                    <p><b>Most / Least Popular Cars</b></p>
                    <i class="fa fa-car fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="row features">
            <a href="admReservation.php">
            <div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="1.2s">
                <div class="inner text-center">
                    <p><b>Check Reservations</b></p>
                    <i class="fa fa-book fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
            <a href="admReply.php">
            <div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1.4s"">
                <div class="inner text-center">
                    <p><b>Reply To User Comment</b></p>
                    <i class="fa fa-comments-o fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="row features">
            <a href="carHistory.php">
            <div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="1.6s">
                <div class="inner text-center">
                    <p><b>Car History</b></p>
                    <i class="fa fa-history fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
            <a href="damaged.php">
            <div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1.8s">
                <div class="inner text-center">
                    <p><b>Damaged Cars</b></p>
                    <i class="fa fa-chain-broken fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
        </div>
        <div class="row features">
            <a href="locationCars.php">
            <div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="1.6s">
                <div class="inner text-center">
                    <p><b>Location-Car Information</b></p>
                    <i class="fa fa-info-circle fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
            <a href="index.php">
            <div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1.8s">
                <div class="inner text-center">
                    <p><b>Logout</b></p>
                    <i class="fa fa-sign-out fa-5x" aria-hidden="true"></i>
                </div>
            </div>
            </a>
        </div>
    </div>

<?php
//Create a user session or resume an existing one
session_start();
?>

</body>
</html>