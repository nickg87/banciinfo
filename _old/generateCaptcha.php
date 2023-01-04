<?php
session_start();
 
/*
* File: CaptchaSecurityImages.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 03/08/06
* Updated: 07/02/07
* Requirements: PHP 4/5 with GD and FreeType libraries
* Link: http://www.white-hat-web-design.co.uk/articles/php-captcha.php
* 
* This program is free software; you can redistribute it and/or 
* modify it under the terms of the GNU General Public License 
* as published by the Free Software Foundation; either version 2 
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful, 
* but WITHOUT ANY WARRANTY; without even the implied warranty of 
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
* GNU General Public License for more details: 
* http://www.gnu.org/licenses/gpl.html
*
*/
 
class CaptchaSecurityImages {
 
   var $font = './ARIALNR.TTF';
 
   function generateCode($characters) {
      /* list all possible characters, similar looking characters and vowels have been removed */
      $possible = '23456789bcdfghjkmnpqrstvwxyz';
      $code = '';
      $i = 0;
      while ($i < $characters) { 
         $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
         $i++;
      }
      return $code;
   }
 
   function CaptchaSecurityImages($width='120',$height='40',$characters='6', $color) {
      list($color_r, $color_g, $color_b) = explode('.', $color);
      
      $code = $this->generateCode($characters);
      /* font size will be 75% of the image height */
      $font_size = $height * 0.82;
      $image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
      /* set the colours */
      $background_color = imagecolorallocate($image, 255, 255, 255);
      $text_color = imagecolorallocate($image, $color_r, $color_g, $color_b);
      $noise_color = imagecolorallocate($image, 100, 120, 180);
      #$noise_color = imagecolorallocate($image, $color_r, $color_g, $color_b);
      /* generate random dots in background */
      for($i=0; $i<($width*$height)/20; $i++) {
         imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
      }
      /* generate random lines in background */
      for( $i=0; $i<($width*$height)/450; $i++ ) {
         imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
      }
      /* create textbox and add text */
      $textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
      $x = ($width - $textbox[4])/2;
      $y = ($height - $textbox[5])/2;
      imagettftext($image, $font_size, rand(-6, 8), $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
      /* output captcha image to browser */
      header('Content-Type: image/jpeg');
      imagejpeg($image);
      imagedestroy($image);
      
      $_SESSION['security_code'] = $code;
   }
 
}
 
#$width = isset($_GET['width']) && $_GET['width'] < 600 ? $_GET['width'] : '120';
#$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '40';
#$characters = isset($_GET['characters']) && $_GET['characters'] > 2 ? $_GET['characters'] : '6';

if(isset($_GET['color']) && preg_match('`^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$`', $_GET['color'])) {
	$color = $_GET['color'];
} else {
	$color = '20.40.100';
}

$color = '47.64.129';

$captcha = new CaptchaSecurityImages(110, 29, 4, $color);
 
?>