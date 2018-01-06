<?php
	$image = imagecreatetruecolor(150,150);
	$bc = imagecolorallocate($image, 200, 200, 200);
	$fc = imagecolorallocate($image, 0,0,0);

	imagefilledrectangle($image, 0, 0, 150, 150, $bc);
	imagestring($image, 25, 70, 50, "NO",$fc);
	imagestring($image, 25, 60, 65,"IMAGE", $fc);
	imagestring($image, 25, 60, 80, "FOUND",$fc);

	imagejpeg($image, "noimage.jpg");

	imagedestroy($image);
	echo "<div style='position:absolute; top:500px; left:500px; width:300px; height:300px; margin:auto;'>Image <img src='noimage.jpg'> Created</div>";






?>