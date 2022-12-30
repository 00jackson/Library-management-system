<?php 
session_start(); 
$text = rand(10000,99999); 
$_SESSION["vercode"] = $text; 
$height = 25; 
$width = 65;   
$image_p = imagecreate($width, $height); 
$black = imagecolorallocate($image_p, 197, 206, 218); 
$white = imagecolorallocate($image_p, 0, 0, 51); 
$font_size = 14; 
imagestring($image_p, $font_size, 5, 5, $text, $white); 
imagejpeg($image_p, null, 80); 
?>