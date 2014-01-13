<?php
include 't_dbConnect.php';

$thisPhoto = $_POST[id];

$result = mysqli_query($con,"SELECT * FROM photos WHERE id='$thisPhoto'");
while($row = mysqli_fetch_array($result)) {
    $filename = $row[largePhoto];
}

//die(print_r($_POST));
$new_filename = str_replace("/big/","/thumb/",$filename);
$new_filenameForDB = $new_filename;
$new_filename = "../../".$new_filename;
$filename = "../../".$filename;

// Get dimensions of the original image
list($current_width, $current_height) = getimagesize($filename);

// The x and y coordinates on the original image where we
// will begin cropping the image, taken from the form
$x1   = $_POST['x1'];
$y1    = $_POST['y1'];
$x2   = $_POST['x2'];
$y2    = $_POST['y2'];

$crop_width = $_POST['cW'];
$crop_height = $_POST['cH'];

$scale = $_POST['t_scale'];

$x1 = $x1/$scale*$current_width;
$y1 = $y1/$scale*$current_width;
$x2 = $x2/$scale*$current_width;
$y2 = $y2/$scale*$current_width;

$width = $x2-$x1;
$height = $y2-$y1;


// echo $scale."!".$x1."!".$y1."!".$x2."!".$y2."!".$width."!".$height."!";

// Create our small image
$new = imagecreatetruecolor($crop_width, $crop_height);
// Create original image

$what = getimagesize($filename);
switch(strtolower($what['mime']))
{
    case 'image/png':
        $current_image = imagecreatefrompng($filename);
        break;
    case 'image/jpeg':
        $current_image = imagecreatefromjpeg($filename);
        break;
    case 'image/gif':
        $current_image = imagecreatefromgif($filename);
        break;
    default: die();
}
// resamling (actual cropping)
imagecopyresampled($new, $current_image, 0, 0, $x1, $y1, $crop_width, $crop_height,  $width, $height);

// creating our new image
imagejpeg($new, $new_filename, 95);

$wFeature = 0;
$hFeature = 0;
if ($crop_width > $crop_height) {
    $wFeature = 1;
}
if ($crop_height > $crop_width) {
    $hFeature = 1;    
}

if ($wFeature==0 && $hFeature== 0)
{
    mysqli_query($con,"UPDATE photos SET smallPhoto='$new_filenameForDB', wFeature='0', hFeature='0' WHERE id='$thisPhoto'");
}
else if ($wFeature==1 && $hFeature== 0)
{
    mysqli_query($con,"UPDATE photos SET smallPhoto='$new_filenameForDB', wFeature='1', hFeature='0' WHERE id='$thisPhoto'");    
}
else if ($wFeature==0 && $hFeature== 1)
{
    mysqli_query($con,"UPDATE photos SET smallPhoto='$new_filenameForDB', hFeature='1', wFeature='0' WHERE id='$thisPhoto'");        
}

mysqli_close($con);

header( 'Location: ../manage.php');
exit();

?>