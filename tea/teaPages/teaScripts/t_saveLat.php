<?php
include 't_dbConnect.php';
$thisID = (isset($_POST['id'])) ? $_POST['id'] : ""; //id of the element
$newLat = (isset($_POST['value'])) ? $_POST['value'] : ""; //value posted
$newLat = addslashes($newLat);
mysqli_query($con,"UPDATE categories SET geoLat='$newLat' WHERE id='$thisID'");        
mysqli_close($con);
echo stripslashes($newLat);
?>