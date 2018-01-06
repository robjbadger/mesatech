<!-- modify existing images -->

<?php
echo "<div class='section-frame'><center>";
echo "<img src='images/atm-sup.jpg'> --> Becomes: ";
$file = "images/atm-sup.jpg";
$image = file_get_contents("$file");

$source = imagecreatefromstring($image);

$width = imagesx($source);
$height = imagesy($source);
$thumb = imagecreatetruecolor(80, 60);
imagecopyresampled($thumb, $source, 0, 0, 0, 0, 80, 60, $width, $height);
imagejpeg($thumb, "newthumb.jpg");
	echo " New Image -- <img src='newthumb.jpg'> --Created</div>";
?>
