<?php
 // include captcha class
 require_once(dirname(__FILE__).'/../Library/captcha/php-captcha/php-captcha.inc.php');
 // define fonts
 $aFonts = array(dirname(__FILE__).'/../Library/captcha/php-captcha/fonts/Vera.ttf', dirname(__FILE__).'/../Library/captcha/php-captcha/fonts/VeraSe.ttf');
 // create new image
 $oPhpCaptcha = new PhpCaptcha($aFonts, 100, 50);
 $oPhpCaptcha->SetBackgroundImages(dirname(__FILE__).'/../images/ph_left_bg.jpg');
 $oPhpCaptcha->UseColour(true);
 $oPhpCaptcha->Create();
?>