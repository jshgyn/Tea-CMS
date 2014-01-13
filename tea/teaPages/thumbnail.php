<?php $t_page="thumbnail"; include 'teaScripts/t_header.php'; ?>
<!-- MAIN -->

<div id="thumbContent"> 
    <?php 
        include 'teaScripts/t_dbConnect.php';

        $result = mysqli_query($con,"SELECT * FROM photos WHERE id='$_GET[id]'");
        while($row = mysqli_fetch_array($result)) {
            $thisPhoto = $row[largePhoto]; 
        }
        echo '<img id="largePhoto" class="imageThumbEdit" src="'."../".$thisPhoto.'" />'; 
    ?>
    
    <div id="thumbForm">    
        <form action="teaScripts/t_saveThumb.php" method="post">
            <select name="thumbType" id="thumbType" onchange="changeThumbType()">
                <option value="norm" select="selected">Normal</option>
                <option value="tall">Tall</option>
                <option value="wide">Wide</option>
            </select>
            <input type="hidden" name="x1" value="" />
            <input type="hidden" name="y1" value="" />
            <input type="hidden" name="x2" value="" />
            <input type="hidden" name="y2" value="" />
            <input type="hidden" name="cW" value="" />
            <input type="hidden" name="cH" value="" />
            <input type="hidden" name="t_scale" value="10" />
            <input type="hidden" name="id" value="<?php echo $_GET[id]; ?>" />
            <input type="submit" value="Save Thumbnail" />
        </form> 
    </div>
  </div>

  <?php
    $result = mysqli_query($con,"SELECT thumbSize FROM info");
    while($row = mysqli_fetch_array($result)) {
      $crop_width = $row[thumbSize];
      $crop_height = $crop_width;
    }

    mysqli_close($con);       
  ?>
  <script> var cWidth = '<?php echo $crop_width; ?>'; var cHeight = '<?php echo $crop_height; ?>';</script>
  <script src="teaJS/crop.js"></script>

<!-- /MAIN -->
<?php include 'teaScripts/t_footer.php'; ?>