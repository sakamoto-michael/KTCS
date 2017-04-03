<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <meta http-equiv="X UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="description" content="Kingston Car Share (K-Town Car Share)">
        <meta name="author" content="Michael Sakamoto, Ito (Jose) Matsuda, Jack (Yilun) Xiao">
        <title>Reply To User Comment</title>

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
<h1 style="padding-top:40px;padding-bottom:40px;">List of Comments from Users</h1>

<?php
  // include database connection
    include_once 'config/connection.php'; 
    $query = "SELECT Model, Rating, `Comment Text`, VIN, commentID, adminReply FROM `rental comments`";
    $result = mysqli_query($con,$query);
    // error check
    if (!$result) {
    echo "Could not successfully run query ($query) from DB: " . mysql_error();
    exit;
}
    if ($result = $con->query($query)){
        while ($row = $result->fetch_assoc()){
            printf("%s(%d), rating %d/10, comment: %s, comment ID: %d, admin reply: %s", $row["Model"],$row["VIN"],$row["Rating"],$row["Comment Text"],$row["commentID"],$row["adminReply"]);
            echo "<br>";
        }
    }
    // optional clean up here if you want, go to site linked above
?>


<?php
 
 // if(isset($_POST['newMemberBtn']) && isset($_SESSION['id'])){
 if(isset($_POST['replyBtn'])){

 	include_once 'config/connection.php';

 	$CommID = $_POST['repComID'];
    $admReply = $_POST['adReply'];
    //echo "$admReply";
 	$CommID = mysql_real_escape_string($CommID);
    $admReply = mysql_real_escape_string($admReply);
    //echo "$admReply";
    $query = "UPDATE `rental comments` SET adminReply = '$admReply' WHERE commentID = $CommID";
    //echo $query;
    // $result = $con($query); // dont use mysql_query use for db
    $result = mysqli_query($con,$query);


 }
?>

<h4>Reply to a comment</h4>
<form name='reply' id='reply' action='admReply.php' method='post'>
    <table border='0'>

        <tr>
        <tr>
        	<td>Enter a comment ID to reply to</td>
            <td><input type='text' name='repComID' id='repComID'/></td>
        </tr>

        <tr>
            <td>Enter your reply</td>
            <td><input type='text' name='adReply' id='adReply'/></td>
        </tr>
        </tr>

        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='replyBtn' id='replyBtn' value='Check' /> 
            </td>
        </tr>

    </table>
</form>

<form name='returnPrev' id='returnPrev' action='adminHome.php' method='post'>
    <input type='submit' name='returnBtn' id='returnBtn' value='Return' /> 
</form>
</div>
</div>
</div>
</body>
</html>