<?php

function dbConnect() {
	$con=mysqli_connect("localhost","root","root","tea_master");
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	return $con;
}

function teaGetCategories() {

	// $array["count"] = number of arrays
	// $array[i]["name"] = name of cat i
	// $array[i]["id"] = id of cat i

	$con = dbConnect();

	$result = mysqli_query($con,"SELECT * FROM categories");
	$numCats = mysqli_num_rows ($result);
	$theseCategories = array("count" => $numCats);	
	
	while($row = mysqli_fetch_array($result)) {
		$thisCategory = array(
			"id" => $row[id],
			"name" => $row[name],
			"geoLat" => $row[geoLat],
			"geoLong" => $row[geoLong]
		);
		array_push($theseCategories, $thisCategory);
	}
	mysqli_close($con);  
	return $theseCategories;
}

function teaGetImagesByCategory($category) {
	$con = dbConnect();
	$result = mysqli_query($con,"SELECT * FROM categories WHERE name='$category'");
	while($row = mysqli_fetch_array($result)) {
		$thisCategoryID = $row[id];
	}


	$result = mysqli_query($con,"SELECT * FROM photos WHERE categoryID='".$thisCategoryID."'");
	$numImages = mysqli_num_rows ($result);
	$theseImages = array("count" => $numImages);

	while($row = mysqli_fetch_array($result)) {
		$thisImage = array(
			"largePhoto" => "tea/".$row[largePhoto],
			"thumbPhoto" => "tea/".$row[smallPhoto],
			"category" => $category,
			"uploadTime" => $row[t_stamp],
			"widthFeature" => $row[wFeature],
			"heightFeature" => $row[hFeature],
			"description" => $row[descr]
		);

		array_push($theseImages, $thisImage);
	}
	mysqli_close($con);  
	return $theseImages;
}  

?>