<?php
include 't_dbConnect.php';
$thisID = (isset($_POST['id'])) ? $_POST['id'] : ""; //id of the element
$newLong = (isset($_POST['value'])) ? $_POST['value'] : ""; //value posted
$newLong = addslashes($newLong);
mysqli_query($con,"UPDATE categories SET geoLong='$newLong' WHERE id='$thisID'");        
mysqli_close($con);
echo stripslashes($newLong);
?>