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
//$directory = "/projects/Bolaji.net/v6/www/02/Assets/video";
$directory = "/var/www/vhosts/bolaji.net/httpdocs/Assets/video";
$artist = "/jimmy's.jump.off";
//$artist .= "d'banj";
$files = getFiles($directory . $artist);
$videocoll;
$counter = 1;
foreach($files as $file)
{
    $Properties = array();
	if (file_exists($file))
	{
		if(substr($file, strlen($file) - 4) != ".flv")
		{
			continue;
		}

			preg_match('!\/video\/((.*?)\/((.*?)\/)?(.*))!', $file, $matches);
			preg_match('!(-((.*?).*?))?_(.*)\.flv!', $matches[5], $tracks);
			$track = preg_replace(array("/_/","/\./","/\+/"),array(" "," "," & "),$tracks[4]);
			//if($tracks[2])
			//{
			//	$track .= " feat. ". preg_replace(array("/-/","/\./"), array(" & "," "), $tracks[2]);
			//}

			$Params->Name = preg_replace(array("/\./","/\+/"),array(" "," & "),$matches[2]);
			$Params->Nameid = strtolower(preg_replace(array("/\W/"),array(""),$matches[2]));
			$Params->Album = str_replace(array("_","."),array(" "),$matches[4]);
			$Params->Title = $Params->Name;
			$Params->Title .= !empty($Params->Album) ? " - " . $Params->Album : "";
			$Params->Title .= !empty($track) ? ": " . $track : "";
			$Params->Url = "/".$matches[2]. (!empty($Params->Album) ? "/".$matches[4] : "") . "/".$matches[5];
			$Params->Thumburl = substr($Params->Url, 0, strlen($Params->Url) - 4) . "_t.jpg";
			$Params->Description = $Params->Title;
			$Params->External = '0';
			$Params->Categoryid = '0';
			$Params->Ownerid = '0';
			$Params->Typeid = '0';
			$Params->Sourceid = '0';

			echo "<br/>", $Params->Name, " | ", $Params->Title, " | ", $track, " | ", $Params->Url;

			//echo "<br/>", substr($Params->Url, 0, strlen($Params->Url) - 4);
			//if(file_exists("/var/www/vhosts/bolaji.net/httpdocs" . $Params->Thumburl))
			//{
			//	continue;
			//}

			$mov = new ffmpeg_movie($directory . $Params->Url);
			$frame = $mov->getFrame($mov->getFrameCount() * .10);

			$wscale = 100;
			$hscale = 75;

			$width = $frame->getWidth();
			$height = $frame->getHeight();

			if($width > $wscale)
			{
				$newwidth=$wscale;
				$newheight=($height/$width)*$wscale;
			}
			if($height > $hscale)
			{
				$newheight = $hscale;
				$newwidth = ($width/$height)*$hscale;
			}
			else
			{
				$newwidth = $width;
				$newheight = $height;
			}
			//echo "<br/> width: ", $frame->getWidth(), " height: ", $frame->getHeight(), " new width: ", $newwidth, " new height: ", $newheight;

			//$frame->resize(ceil($newwidth), ceil($newheight), 0,0,0,0);
			$image = $frame->toGDImage();
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight,$width,$height);
			imagejpeg($tmp, $directory . substr($Params->Url, 0, strlen($Params->Url) - 4) . "_t.jpg",100);
			imagedestroy($tmp);
			imagedestroy($image);

			//update artistvideo set thumburl = concat( left(url, length(url) - 4), "_t.jpg")

			$Title = $Params->Title;
			$Params->Title = $Params->Name;
			$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.VIDEO"]);
			if(empty($videocoll) || $videocoll->Name != $Params->Name)
			{
				$Params->Numofvids = 1;
				$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsVideoCollInfo", $Params);

				if($Response->Success)
				{
					$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
					echo "<br/>VideoCollid: ", $ObjectID->ID;
					$videocoll = $Params;

					echo "<br/> Group id: ", $videocoll->Groupid, " | ", $ObjectID->ID;
					if(isset($videocoll->Groupid) && $videocoll->Groupid != $ObjectID->ID)
					{
						$Params->Id = $videocoll->Groupid;
						$Params->Numofvids = $counter - 1;
						$Response = $Service->Execute(&$AppContext, "UpdateVideoCollNumOfVids", $Params);

						$counter = 0;
					}

					$Params->Groupid = $ObjectID->ID;
				}

			}

			$Params->Title = $Title;
			$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsVideoInfo", $Params);
			if($Response->Success)
			{
				$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
				//echo "<br/>ArtistInfo: ", $ObjectID->ID;
				$Params->Artistid = $ObjectID->ID;
			}

		}

		$counter++;
}

	echo "<br/> Group id: ", $videocoll->Groupid, " | ", $ObjectID->ID, " | counter: ", $counter;
	$Params->Id = $ObjectID->ID;
	$Params->Numofvids = $counter;
	$Response = $Service->Execute(&$AppContext, "UpdateVideoCollNumOfVids", $Params);

?>