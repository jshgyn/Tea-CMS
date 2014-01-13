<?php

include '/var/www/tea/tea.php';

$img = teaGetImagesByCategory("Science");
echo $img[0]["category"];

?>