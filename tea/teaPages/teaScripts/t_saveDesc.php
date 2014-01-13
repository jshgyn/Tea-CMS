<?php
include 't_dbConnect.php';
$thisID = (isset($_POST['id'])) ? $_POST['id'] : ""; //id of the element
$newDesc = (isset($_POST['value'])) ? $_POST['value'] : ""; //value posted
$newDesc = addslashes($newDesc);
mysqli_query($con,"UPDATE photos SET descr='$newDesc' WHERE id='$thisID'");        
mysqli_close($con);
echo stripslashes($newDesc);
?>