<!DOCTYPE HTML>
<html>
    <head>
        <title>KTCS Locations</title>
  		<!-- Returns all of the locations that KTCS has  -->
  		<!-- finished i think -->
    </head>
<body>
<h1>Here are the locations</h1>

<?php
//Create a user session or resume an existing one
session_start();
?>


<?php
  // include database connection
    include_once 'config/connection.php'; 
	$query = "SELECT * FROM `parking location`";
	// http://php.net/manual/en/mysqli-result.fetch-assoc.php
    $result = mysqli_query($con,$query);
    // error check
    if (!$result) {
    echo "Could not successfully run query ($query) from DB: " . mysql_error();
    exit;
}
	if ($result = $con->query($query)){
		while ($row = $result->fetch_assoc()){
			printf("Address %s \t Spaces Available (%d)", $row["Address"],$row["Number of Spaces"]);
			echo "<br>";
		}
	}
	// optional clean up here if you want, go to site linked above
?>

<?php
if(isset($_POST['returnBtn'])){
	session_destroy();
	header("Location: index.php"); // or wherever you want it to return
	die(); 
	}
?>

<h3>Press to return home</h3>
<form name='returnPrev' id='returnPrev' action='locations.php' method='post'>
    <table border='0'>
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='returnBtn' id='returnBtn' value='Return' /> 
            </td>
        </tr>
    </table>
</form>
</body>
</html>