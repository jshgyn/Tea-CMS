<?php
 

$upload_dir = 'teaContent/img/big';


if (!empty($_FILES)) {
 include 't_dbConnect.php';

 $tempFile = $_FILES['file']['tmp_name'];
 
 // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
 $targetPath = dirname(dirname(dirname( __FILE__ ))) . DIRECTORY_SEPARATOR . $upload_dir . DIRECTORY_SEPARATOR;
 
 // Adding timestamp with image's name so that files with same name can be uploaded easily.
 $tstamp = time();
 $mainFileForDB = $tstamp.'-1tea_7'.$_FILES['file']['name'];
 $mainFile = $targetPath.$mainFileForDB;
 $mainFile = str_replace(' ', '_', $mainFile);
 $mainFileForDB = str_replace(' ', '_', $mainFileForDB);

 move_uploaded_file($tempFile,$mainFile);

 $thumbFileForDB = str_replace("big","thumb",$mainFileForDB);
 $thumbFile = str_replace("big","thumb",$mainFile);

 list($current_width, $current_height) = getimagesize($mainFile);

  $result = mysqli_query($con,"SELECT thumbSize FROM info");
  while($row = mysqli_fetch_array($result)) {
    $crop_width = $row[thumbSize];
    $crop_height = $crop_width;
  }

 
 if ($current_width <= $current_height) {
     $width = $current_width;
     $height = $width;
 }
 else if ($current_height < $current_width) {
     $height = $current_height;
     $width = $height;     
 }
 
 $x1 = ($current_width / 2) - ($width / 2);
 $y1 = ($current_height / 2) - ($height / 2);
 
 $new = imagecreatetruecolor($crop_width, $crop_height);
 
 $what = getimagesize($mainFile);
 switch(strtolower($what['mime']))
 {
    case 'image/png':
        $current_image = imagecreatefrompng($mainFile);
        break;
    case 'image/jpeg':
        $current_image = imagecreatefromjpeg($mainFile);
        break;
    case 'image/gif':
        $current_image = imagecreatefromgif($mainFile);
        break;
    default: die();
 }
 
 imagecopyresampled($new, $current_image, 0, 0, $x1, $y1, $crop_width, $crop_height,  $width, $height);

 imagejpeg($new, $thumbFile, 95);

 $mainFileForDB = "teaContent/img/big/".$mainFileForDB;
 $thumbFileForDB = "teaContent/img/thumb/".$thumbFileForDB;


 mysqli_query($con,"INSERT INTO photos(largePhoto, smallPhoto, categoryID, t_stamp) VALUES ('$mainFileForDB', '$thumbFileForDB', 0, '$tstamp')");
 mysqli_close($con);
}

?>
