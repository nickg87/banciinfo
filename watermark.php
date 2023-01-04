<?
  
 
// Load the requested image
$image = imagecreatefromstring(file_get_contents($SourceFile));

$w = imagesx($image);
$h = imagesy($image);

// Load the watermark image
$watermark = imagecreatefrompng(SITE_DIR.'watermark.png');
$ww = imagesx($watermark);
$wh = imagesy($watermark);

// Merge watermark upon the original image
imagecopy($image, $watermark, $w-$ww, $h-$wh, 0, 0, $ww, $wh);

// Send the image
header('Content-type: image/jpeg');
imagejpeg($image);

 }

?>