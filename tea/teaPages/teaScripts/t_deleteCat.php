<?php

include 't_dbConnect.php';

$toDelete = $_POST[toDelete];

mysqli_query($con,"UPDATE photos SET categoryID=0 WHERE categoryID='$toDelete'");

mysqli_query($con,"DELETE FROM categories WHERE id='$toDelete'");

// echo $toDelete." deleted";

mysqli_close($con);

header( 'Location: ../categories.php');
exit();
?>