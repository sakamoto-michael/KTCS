<!DOCTYPE HTML>
<html>
    <head>
        <title>Admin Home page</title>
        <!-- This will be used to make a new member -->
  		<!-- not checking for duplicated information -->
    </head>
<body>
<h1>Admin Home page</h1>

<?php
//Create a user session or resume an existing one
session_start();
?>


<!-- Add a car to a fleet -->
<form name='adminHome' id='adminHome' action='adminHome.php' method='post'>
    <table border='0'>       
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='newCarBtn' id='newCarBtn' value='Add a new Car' /> 
            </td>
        </tr>
    </table>
</form>

<!-- Generate an invoice -->

<?php
if(isset($_POST['invoiceBtn'])){
include_once 'config/connection.php';
$query = "";
// need to group with ktcs members to for the dln
// need to group car (to get daily rental fee)
// need to group with car rental history (to see who got that)
// also need to see how long they had it for
?>
<form name='monthlyInvoice' id='monthlyInvoice' action='adminHome.php' method='post'>
    <table border='0'> 
      <tr>
            <td>Enter the member DLN</td>
             <td><input type='text' name='memberID' id='memberID'/></td>
        </tr>      
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='invoiceBtn' id='invoiceBtn' value='Generate an Invoice' /> 
            </td>
        </tr>
    </table>
</form>

<!-- Show car rental history -->
<form name='carHist' id='carHist' action='adminHome.php' method='post'>
    <table border='0'> 
      <tr>
            <td>Enter the car ID</td>
             <td><input type='text' name='carID' id='carID'/></td>
        </tr>      
        <!-- Submit -->
        <tr>
            <td></td>
            <td>
                <input type='submit' name='carHistBtn' id='carHistBtn' value='Show a car rental history' /> 
            </td>
        </tr>
    </table>
</form>


</body>
</html>