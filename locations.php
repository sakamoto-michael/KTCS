<!DOCTYPE HTML>
<html>
    <head>
        <title>KTCS Locations</title>
        <!-- This will be used to make a new member -->
  		<!-- not checking for duplicated information -->
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
	$query = "SELECT * FROM 'parking location'";
	// prepare query for execution
        if($stmt = $con->prepare($query)){
		
        // bind the parameters. This is the best way to prevent SQL injection hacks.
        $stmt->bind_Param();
        // Execute the query
		$stmt->execute();
		/* resultset */
		$result = $stmt->get_result();
		// Get the number of rows returned
		$num = $result->num_rows;;
		
		if($num>0){
			//If the username/password matches a user in our database
			//Read the user details
			$myrow = $result->fetch_assoc();
			//Create a session variable that holds the user's id
			//$_SESSION['id'] = $myrow['id'];
			echo $myrow['Address'];
			//Redirect the browser to the profile editing page and kill this page.
		} else {
			echo "Failed to login";
			}
		}
		 else {
			echo "failed to prepare the SQL";
		}
	//$stmt = $con->prepare($query);	$stmt->bind_param();
	// Execute the query
	// $results = mysqli_query($query);
	// var_dump($results);

	// if (!$results->query("SET @a:='this will not work'")) {
 //  	printf("Error: %s\n", $results->error);
 //  	die();
	// }

	// $results2 = mysqli_query($query);
	// var_dump($results2);
	//echo $query;
	// $result = mysql_query($query);
	// while($row = mysql_fetch_array($result)) {
	// echo $row['Address'];
	// echo $row['Number of Spaces'];	
//}
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