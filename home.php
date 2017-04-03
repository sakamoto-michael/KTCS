<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<meta name="description" content="Kingston Car Share (K-Town Car Share)">
	<meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
	<title>Kingston Car Share</title>

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
<!-- Cover For Loading: Fade In -->
	<div id="loading-cover"></div>

	<nav class="navbar navbar-light navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
          			<i class="fa fa-bars"></i>
        		</button>
        		<a class="navbar-brand nav-link" href="#"></a>
			</div>
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse" id="nav-menu">
        		<ul class="nav navbar-nav">
        		</ul>
      		</div>
		</div>
	</nav>

	<div class="container-fluid dashboard-styling">
		<div class="row">
			<div class="col-md-12" id="dashboard">
				<h1> Welcome to the KTCS Dashboard! </h1>
				<h3 class="wow fadeIn" data-wow-delay="0.3s"> Find everything you need here.</h3>
			</div>
		</div>
		<div class="row features">
			<a href="locations.php">
			<div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="0.8s">
				<div class="inner text-center">
					<p><b>Locations</b></p>
					<i class="fa fa-map-marker fa-5x" aria-hidden="true"></i>
				</div>
			</div>
			</a>
			<a href="cars.php">
			<div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1s">
				<div class="inner text-center">
					<p><b>Cars</b></p>
					<i class="fa fa-car fa-5x" aria-hidden="true"></i>
				</div>
			</div>
			</a>
		</div>
		<div class="row features">
			<a href="pickUp.php">
			<div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="1.2s">
				<div class="inner text-center">
					<p><b>Pick-Up</b></p>
					<i class="fa fa-exchange fa-5x" aria-hidden="true"></i>
				</div>
			</div>
			</a>
			<a href="dropOff.php">
			<div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1.4s"">
				<div class="inner text-center">
					<p><b>Drop-Off</b></p>
					<i class="fa fa-exchange fa-5x" aria-hidden="true"></i>
				</div>
			</div>
			</a>
		</div>
		<div class="row features">
			<a href="userRentalHistory.php">
			<div class="col-md-5 col-md-offset-1 feature-box wow fadeIn" data-wow-delay="1.6s">
				<div class="inner text-center">
					<p><b>Rental History</b></p>
					<i class="fa fa-history fa-5x" aria-hidden="true"></i>
				</div>
			</div>
			</a>
			<a href="#">
			<div class="col-md-5 feature-box wow fadeIn" data-wow-delay="1.8s">
				<div class="inner text-center">
					<p><b>Logout</b></p>
					<i class="fa fa-sign-out fa-5x" aria-hidden="true"></i>
				</div>
			</div>
			</a>
		</div>
	</div>

	<footer>
		<div class="row footer">
			<div class="col-md-12">
				<p> &copy; 2017 Matsuda/Xiao/Sakamoto </p>
			</div>
		</div>
	</footer>

  <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

  <!-- Bootstrap JavaScript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!-- WOW JavaScript Fade-In (Developed by Matthieu Aussaguel) -->
      <script src="./js/wow.min.js"></script>
      <script>
          new WOW().init();
      </script>

  <!-- Main JS -->
    <script src="./js/main.js"></script>
</body>
</html>