<?php
 
echo '<div id="options" >
      <div class="option-combo teaMenu">
        <ul class="menu-left">
          <li><a href="upload.php">Upload</a></li>
          <li><a href="photo_categories.php">PhotoCategories</a></li>
          <li><a href="photo_manage.php"> Photos</a></li>
          <li><a href="text_categories.php">TextCategories</a></li>
          <li><a href="text_manage.php">Text</a></li>
        </ul>
        <ul class="menu-right">
          <li><a href="http://'.$_SERVER['SERVER_NAME'].'" target="_new">Site</a></li>
          <li><a href="teaScripts/t_logout.php">Logout</a></li>        
        </ul>
      </div>
    </div>';
?>