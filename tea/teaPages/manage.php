<?php $t_page="manage"; include 'teaScripts/t_header.php'; ?>
<!-- MAIN -->

<div>  
  <?php 
  	include 'teaScripts/t_dbConnect.php';
    if ($_GET[id] != null) {
        $id = $_GET[id];
        $newCat = $_GET[cat];
        mysqli_query($con,"UPDATE photos SET categoryID='$newCat' WHERE id='$id'");
        // SET UP BELOW TO WORK WITH NEW FILENAMES FROM NOW ON 
    }

	$result = mysqli_query($con,"SELECT * FROM categories");
	if (mysqli_num_rows($result)!=0) {
		while($row = mysqli_fetch_array($result)) {
			echo '<div class="sectionTitle">'.$row[name].'</div>';
		    $result2 = mysqli_query($con,"SELECT * FROM photos WHERE categoryID='$row[id]'");
		    if (mysqli_num_rows($result2)==0) {
		        echo '- NONE';
		    }
		    while($row2 = mysqli_fetch_array($result2)) {
		        outputImage($row2[id],$row2[smallPhoto],$row2[descr],$row2[categoryID],$row2[t_stamp]);
		    }
		    // echo '</div>';
		}
	}
        
   	mysqli_close($con);
  ?>
</div>

<?php 
function outputImage($id,$largePhoto,$desc,$categoryID,$date) {
	$imageParts = explode("-1tea_7", $largePhoto);
	
	// $thisCat = $row['category'];
	date_default_timezone_set('Europe/Amsterdam');
	echo '<div class="editBox">';
	echo '  <div class="imageDelete"><form name="deleteImg" action="teaScripts/t_deleteImg.php" method="POST" onsubmit="return confirm('."'Are you sure you want to delete this image?'".');"><input type="hidden" name="toDelete" value="'.$id.'"><input type="submit" id="submitDelete" value="Delete"></form></div>';
	echo '  <div class="editLeftColumn">';          
	echo '      <div class="imageImage"><img src="'."../".$largePhoto.'" /><br /></div>';
	echo '  </div>';                        
	echo '  <div class="editRightColumn">';          
	echo '      <div class="imageTextWrapper">';
	echo '          <div class="imageTitle">'.$imageParts[1].'</div>';
	echo '          <div class="imageTimestamp">Uploaded: '.date('l jS \of F Y h:i:s A',$date).'</div>';
	echo '          <div class="imageCategory">Current Category: '.$categoryID.'</div>';
	echo '          <div class="imageCategoryChange">Set New Category: ';   

  	include 'teaScripts/t_dbConnect.php';
	$categories = mysqli_query($con,"SELECT * FROM categories");

	while($rowCat = mysqli_fetch_array($categories)) {
		if ($rowCat[id]==0)
		{
			$hiddenCatID = $rowCat[id];
			$hiddenCatName = $rowCat[name];
		}
		else 
		{
			echo '<a href="manage.php?id='.$id.'&cat='.$rowCat[id].'">'.$rowCat[name].'</a> / ';
		} 
    }
    echo '/ <a href="manage.php?id='.$id.'&cat='.$hiddenCatID.'">'.$hiddenCatName.'</a>';
    echo '</div><br>';

	// echo '              <a href="manage.php?id='.$id.'&cat=art">Art</a> / 
	//                     <a href="manage.php?id='.$id.'&cat=sketch">Sketch</a> / 
	//                     <a href="manage.php?id='.$id.'&cat=project">Project</a> //
	//                     <a href="manage.php?id='.$id.'&cat=hidden">None</a>
	//                 </div><br>';

	echo '          <div class="imageThumbnailChange"><a href="thumbnail.php?id='.$id.'">Set Thumbnail</a></div>';
	echo '      </div>';
	echo '      <div class="imageDescWrapper">';            
	echo '          Description (Double Click to Edit):<br><div class="imageDesc" id="'.$id.'">'.$desc.'</div><br>'; 
	echo '      </div>';
	echo '  </div>';                                  
	echo '</div>';
}
?>
<!-- /MAIN -->
<?php include 'teaScripts/t_footer.php'; ?>