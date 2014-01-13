<?php
include 't_dbConnect.php';
$thisID = (isset($_POST['id'])) ? $_POST['id'] : ""; //id of the element
$newTitle = (isset($_POST['value'])) ? $_POST['value'] : ""; //value posted
$newTitle = addslashes($newTitle);
mysqli_query($con,"UPDATE categories SET name='$newTitle' WHERE id='$thisID'");        
mysqli_close($con);
echo stripslashes($newTitle);
?>