<?php

// loop through uploaded files and save each one
$wscale = 400;
$hscale = 400;
for($i=0; $i < count($_FILES['uploadfile']['name']); $i++)
{
	$file = array();
	$file['error'] = $_FILES['uploadfile']['error'][$i];
	$file['name'] = $_FILES['uploadfile']['name'][$i];
	$file['tmp_name'] = $_FILES['uploadfile']['tmp_name'][$i];
	$file['type'] = $_FILES['uploadfile']['type'][$i];

	// This is the temporary file created by PHP
	//$uploadedfile = $_FILES['uploadfile']['tmp_name'];
	//$destination = dirname(__FILE__).'/../../Assets/marketplace/listing/upload/';
	//$uploadedfile = $destination . $file['name'];
	//$uploadedfile = $destination . szRand;
	$uploadedfile = $file['tmp_name'];

	// Create an Image from it so we can do the resize
	$src = imagecreatefromjpeg($uploadedfile);

	// Capture the original size of the uploaded image
	list($width,$height)=getimagesize($uploadedfile);

	// For our purposes, I have resized the image to be
	// 600 pixels wide, and maintain the original aspect
	// ratio. This prevents the image from being "stretched"
	// or "squashed". If you prefer some max width other than
	// 600, simply change the $newwidth variable
	if($width > $wscale)
	{
		$newwidth=$wscale;
		$newheight=($height/$width)*$wscale;
	}
	elseif($height > $hscale)
	{
		$newwidth = $hscale;
		$newheight = ($width/$height)*$hscale;
	}
	else
	{
		$newwidth = $width;
		$newheight = $height;
	}
	$tmp=imagecreatetruecolor($newwidth,$newheight);

	// this line actually does the image resizing, copying from the original
	// image into the $tmp image
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

	// now write the resized image to disk. I have assumed that you want the
	// resized, uploaded image file to reside in the ./images subdirectory.
	//$szRand = md5(mktime() . rand(0, 25));
	$filename = $szRand . "_00". ($i + 1) . ".jpg";
	$tmpfile = $destination . $filename;
	imagejpeg($tmp,$tmpfile,100);

	imagedestroy($src);
	imagedestroy($tmp); // NOTE: PHP will clean up the temp file it created when the request has completed.

	$Params->Images[] = $filename . "|" . $tmpfile;

	//echo "<br/>$filename | $tmpfile";
}
?>