<?php

include 't_dbConnect.php';

$toDelete = $_POST[toDelete];

$result = mysqli_query($con,"SELECT * FROM photos WHERE id='$toDelete'");
while($row = mysqli_fetch_array($result)) {
	$largePhoto = "../../".$row[largePhoto];
	$smallPhoto = "../../".$row[smallPhoto];
}

unlink($largePhoto);
unlink($smallPhoto);

mysqli_query($con,"DELETE FROM photos WHERE id='$toDelete'");

// echo $toDelete." deleted";

mysqli_close($con);

header( 'Location: ../manage.php');
exit();
?>