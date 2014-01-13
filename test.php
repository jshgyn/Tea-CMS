<?php

include 'tea/tea.php';

// $img = teaGetImagesByCategory("Art");
// echo '<img src="'.$img[0]["largePhoto"].'">';

// $img = tea("getImagesByCategory", "Science");
// echo '<img src="'.$img[0]["largePhoto"].'">';


$cats = teaGetCategories();
for ($i = 0; $i <= $cats["count"]; $i++) {
	$cat = $cats[$i]["name"];
	echo $cat."<br>";

	$images = teaGetImagesByCategory($cat);
	for ($j = 0; $j <= $images["count"]; $j++) {
		echo $images[$j]["largePhoto"]."<br>"; 
	}
}

?>