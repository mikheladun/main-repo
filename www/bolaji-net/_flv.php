<?php
 require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Utils.php");

function getFiles($directory) {
   // Try to open the directory
   if($dir = opendir($directory)) {
       // Create an array for all files found
       $tmp = Array();

       // Add the files
       while($file = readdir($dir)) {
           // Make sure the file exists
           if($file != "." && $file != ".." && $file[0] != '.') {
               // If it's a directiry, list all files within it
               if(is_dir($directory . "/" . $file)) {
                   $tmp2 = getFiles($directory . "/" . $file);
                   if(is_array($tmp2)) {
                       $tmp = array_merge($tmp, $tmp2);
                   }
               } else {
                   array_push($tmp, $directory . "/" . $file);
               }
           }
       }

       // Finish off the function
       closedir($dir);
       return $tmp;
   }
}

// Example of use
$directory = "/projects/Bolaji.net/Assets/music/video_processed";
//$directory = "/var/www/vhosts/bolaji.net/httpdocs/Assets/music/video";
//$artist = "/" . $_REQUEST['a'];
//$artist = "/d'banj";
//$directory = ".";

$files = getFiles($directory . $artist);

foreach($files as $file)
{

    $Properties = array();
	if (file_exists($file))
	{
		if(substr($file, strlen($file) - 4) != ".flv")
		{
			continue;
		}

		echo "<br/>-------------------------------------------------------------------------------";
		echo "<br/>$file";

			preg_match('!\/music\/.+\/((.+?)(-(.[^_]+))*_(.+))!', $file, $matches);
			//echo "<pre>"; print_r($matches); echo "</pre>";
			preg_match('!(.+)\.flv!', $matches[5], $tracks);
			//echo "<br/>----"; print_r($tracks);
			$track = preg_replace(array("/_/","/\./","/\+/"),array(" "," "," & "),$tracks[1]);
			if($matches[4])
			{
				$track .= " feat. ". preg_replace(array("/-/","/\./"), array(" & "," "), $matches[4]);
			}

			$Params->Name = preg_replace(array("/\./","/\+/"),array(" "," & "),$matches[2]);
			$Params->Nameid = strtolower(preg_replace(array("/\W/"),array(""),$matches[2]));
			//$Params->Album = str_replace("_"," ",$matches[4]);
			$Params->Title = $track;
			$Params->Url = "/" . $matches[2] . "/".$matches[1];
			$Params->Thumburl = "/Assets/music/video". substr($Params->Url, 0, strlen($Params->Url) - 4) . "_t.jpg";
			$Params->External = '0';

			echo "<br/>", $Params->Artist, " | ", $Params->Name, " | ", $Params->Album, " | ", $Params->Title, " | ", $Params->Url, " | ", $Params->Thumburl;

			//continue;

			//echo "<br/>", substr($Params->Url, 0, strlen($Params->Url) - 4);
			//if(file_exists("/var/www/vhosts/bolaji.net/httpdocs" . $Params->Thumburl))
			//{
			//	continue;
			//}
/**
			$mov = new ffmpeg_movie($file);
			$frame = $mov->getFrame($mov->getFrameCount() * .10);

			$wscale = 120;
			$hscale = 75;

			$width = $frame->getWidth();
			$height = $frame->getHeight();

			if($height > $hscale)
			{
				$newheight = $hscale;
				$newwidth = ($width/$height)*$hscale;
			}
			if($width > $wscale)
			{
				$newwidth=$wscale;
				$newheight=($height/$width)*$wscale;
			}
			else
			{
				$newwidth = $width;
				$newheight = $height;
			}

			echo "<br/> width: ", $frame->getWidth(), " height: ", $frame->getHeight(), " new width: ", $newwidth, " new height: ", $newheight;

			//$frame->resize(ceil($newwidth), ceil($newheight), 0,0,0,0);
			$image = $frame->toGDImage();
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height);
			imagejpeg($tmp, $directory . substr($Params->Url, 0, strlen($Params->Url) - 4) . "_t.jpg",100);
			imagedestroy($tmp);
			imagedestroy($image);

			//update artistvideo set thumburl = concat( left(url, length(url) - 4), "_t.jpg")

			continue;
**/
			$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MEDIA"]);
			$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsArtistInfo", $Params);
			if($Response->Success)
			{
				$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
				//echo "<br/>ArtistInfo: ", $ObjectID->ID;
				$Params->Artistid = $ObjectID->ID;
			}

			$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsArtistVideoInfo", $Params);
			if($Response->Success)
			{
				$ObjectID = $Response->Object;
				//echo "<br/>VideoInfo: ", $ObjectID->ID;
				$Params->Videoid = $ObjectID->ID;
			}

			if(isset($Params->Videoid) && !empty($Params->Videoid))
			{
				$Response = $Service->Execute(&$AppContext, "GetSongByName", $Params);
				if($Response->Success)
				{
					$ObjectID = $Response->Object;
					//echo "<br/>SongInfo: ", $ObjectID->ID;
					$Params->Songid = $ObjectID->ID;
	
					if(isset($Params->Songid) && !empty($Params->Songid))
					{
						$Response = $Service->Execute(&$AppContext, "UpdateSongVideoMapping", $Params);
					}
				}
			}


	}
}
?>