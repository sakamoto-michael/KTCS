<!DOCTYPE HTML>
<html>
<head>
  		<!-- Returns all of the locations that KTCS has  -->
  		<!-- finished i think -->
        <meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Reservation Page</title>

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
<h1> Reservations </h1>

<?php
function generateRandomString($length = 8) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
?>

<?php
//Create a user session or resume an existing one
session_start();
?>

<?php
if(isset($_POST['returnBtn'])){
    session_destroy();
    header("Location: index.php"); // or wherever you want it to return
    die(); 
    }
?>


<?php
 
 // if(isset($_POST['newMemberBtn']) && isset($_SESSION['id'])){
 if(isset($_POST['availabilityBtn'])){

    include_once 'config/connection.php';

    $availableDate = $_POST['available'];
    $availableDate = mysql_real_escape_string($availableDate);

    //$query = "SELECT DISTINCT Model,VIN,Address FROM `car`,`reservation` WHERE car.VIN = reservation.Car AND reservation.Date > '$availableDate'";
   $query = "SELECT car.Model, car.VIN, car.Address FROM `car` LEFT JOIN (SELECT `Model`, `VIN`, `Address` FROM `car` NATURAL JOIN `reservation` WHERE `VIN` NOT IN (SELECT `VIN` FROM `reservation` WHERE  '$availableDate' >= reservation.Date AND '$availableDate' <= reservation.dropDate) GROUP BY `VIN`) as tableA ON car.VIN = tableA.VIN GROUP BY `VIN`";
    
    //printf($availableDate);
    $availResult = mysqli_query($con,$query);
    if (!$availResult) {
    echo "Could not successfully run query ($query) from DB: " . mysql_error();
    exit;
    }
    if ($availResult = $con->query($query)){
        while ($row = $availResult->fetch_assoc()){
            printf("Car model: %s, \t VIN: %d, \t Location: %s", $row["Model"],$row["VIN"],$row["Address"]);
            echo "<br>";
        }
    }


 }
?>


<?php
 
 // if(isset($_POST['newMemberBtn']) && isset($_SESSION['id'])){
 if(isset($_POST['reserveBtn'])){

  // include database connection
  // if you are in a session, and updateBtn is clicked
    include_once 'config/connection.php';
    // Assign variables?
    // http://www.inmotionhosting.com/support/edu/website-design/using-php-and-mysql/php-insert-database
    // http://php.net/manual/en/function.mysql-query.php
    // see whats in array
    // foreach (array_keys($_POST) as $randy){
    //  echo "$randy";
    //  echo " ^ ";
    // see the keys
    // }
    //$users_Name = $_POST['resNum'];
    $users_Address = $_POST['memID'];
    $users_Phone = $_POST['car'];
    $users_Email = $_POST['pick'];
    $users_DLN = $_POST['drop'];
    $users_UName = generateRandomString();//$_POST['accessCode'];
    $users_pass = $_POST['days'];
    // haHAA hackers
    //$users_Name = mysql_real_escape_string($users_Name);
    //$users_Address = mysql_real_escape_string($users_Address);
    //$users_Phone = mysql_real_escape_string($users_Phone);
    $users_Email = mysql_real_escape_string($users_Email);
    $users_UName = mysql_real_escape_string($users_UName);
    //$users_pass = mysql_real_escape_string($users_pass);
    $users_DLN = mysql_real_escape_string($users_DLN);
    //$users_MMF = mysql_real_escape_string($users_MMF);

    // $query = "INSERT INTO 'ktcs members'('Name','Address','Phone Number','Email','DLN','Monthly Membership Fee') VALUES ('$users_Name','$users_Address',$users_Phone,'$users_Email',$users_DLN,$users_MMF)";
    $query = sprintf("INSERT INTO `reservation`(`MemberID`,`VIN`,`Date`,`dropDate`, `Access Code`, `Length of Reservation`) VALUES (%d,'%s','%s','%s','%s',%d)",
    ($users_Address),($users_Phone),($users_Email),($users_DLN),($users_UName),($users_pass));
    //echo $query;
    // echo $query;
    // $result = $con($query); // dont use mysql_query use for db
    echo "Reservation Number: $users_UName";
    $result = mysqli_query($con,$query);

    //Error check verry nice
    // if (!$result) {
 //    $message  = 'Invalid query: ' . mysql_error() . "\n";
 //    $message .= 'Whole query: ' . $query;
 //    die($message);
//}

 }

 // have a button that says return to login with these 3 lines under
 //     session_destroy(oid)roy();
 //     header("Location: index.php"); // get outta here
    // die();
 ?>

<h4>Find Available Cars</h4>
<form name='reserveMake' id='reserveMake' action='reservation.php' method='post'>

        	<td>Enter a date to check availability:</td>
            <td><input type='text' name='available' id='available'/></td>

        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='availabilityBtn' id='availabilityBtn' value='Check' /> 
            </td>
        </tr>

</form>

<h4>Make a Reservation</h4>
<form name='checkAvail' id='checkAvail' action='reservation.php' method='post'>
        <p>
            <td>Enter Desired Car VIN:</td>
             <td><input type='text' name='car' id='car'/></td>
        </p>
        <p>
            <td>Enter Pickup Date (YYYY-MM-DD):</td>
            <td><input type='text' name='pick' id='pick'/></td>
        </p>
        <p>
            <td>Enter Drop-off Date:</td>
             <td><input type='text' name='drop' id='drop'/></td>
        </p>
        <p>
            <td>Enter Your DLN:</td>
            <td><input type='text' name='memID' id='memID' /></td>
        </p>
        <p>
            <td>Enter Reservation Length (Days):</td>
            <td><input type='text' name='days' id='days' /></td>
        </p>
        <!-- Submit -->
            <td>
                <input style="margin-bottom: 10px;" type='submit' name='reserveBtn' id='reserveBtn' value='Reserve' /> 
            </td>
        </tr>

</form>

<form name='returnPrev' id='returnPrev' action='home.php' method='post'>
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