<?php $t_page="category"; include 'teaScripts/t_header.php'; ?>
<!-- MAIN -->

<div class="editBox">
	<div class="editCenterColumn">
		<div class="addCat">
			<a href="categories.php?new=1">Add New Category</a>
		</div>
	</div>
</div>


<div>  
  <?php 
  	include 'teaScripts/t_dbConnect.php';

  	if ($_GET['new']==1)
  	{
  		mysqli_query($con, "INSERT INTO categories (name) VALUES ('-New Category-')");
  	}

	$result = mysqli_query($con,"SELECT * FROM categories ORDER BY name");
	if (mysqli_num_rows($result)!=0) {
		while($row = mysqli_fetch_array($result)) {
			if ($row[name]!="Hidden")
			{  
				echo '<div class="editBox">';
				echo '  <div class="catDelete"><form name="deleteCat" action="teaScripts/t_deleteCat.php" method="POST" onsubmit="return confirm('."'Are you sure you want to delete this category?'".');"><input type="hidden" name="toDelete" value="'.$row[id].'"><input type="submit" id="submitDelete" value="Delete"></form></div>';

				echo '	<div class="editLeftColumn">';          
				echo '      <div class="sectionTitle">';       
				echo '          <div class="sectionTitleHeader">Title: </div><div class="catTitle" id="'.$row[id].'">'.$row[name].'</div><br>'; 
				echo '      </div>';
				echo '	</div>';
				echo '	<div class="editRightColumn">';
				$result2 = mysqli_query($con,"SELECT * FROM photos WHERE categoryID='$row[id]'");
				echo '		<div class="catNumImages">Number of Images: '.mysqli_num_rows($result2).'</div>';	
				echo '		<div class="sectionTitle">Super Category: '.$row[supercatID].'</div>';			
				echo '      <div class="catLatWrapper">';            
				echo '          <div class="catLatDesc">Latitude (Double Click to Edit): </div><div class="catLat" id="'.$row[id].'">'.$row[geoLat].'</div>'; 
				echo '      </div>';	
				echo '      <div class="catLongWrapper">';            
				echo '          <div class="catLongDesc">Longitude (Double Click to Edit): </div><div class="catLong" id="'.$row[id].'">'.$row[geoLong].'</div>'; 
				echo '      </div>';
				echo '	</div>';
				echo '</div>';	
			}	 
		}

	}
        
   	mysqli_close($con);
  ?>
</div>

<!-- /MAIN -->
<?php include 'teaScripts/t_footer.php'; ?>