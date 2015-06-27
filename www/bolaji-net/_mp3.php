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
?>
<table border="1" cellpadding="2" cellspacing="0">
<thead><td>File</td><td>Artist</td><td>Title</td><td>Genre</td><td>Track</td><td>Album</td><td>Year</td></thead>
<tbody>
<?php

//echo dirname(__FILE__);
// Example of use
//$directory = "/var/www/vhosts/bolaji.net/httpdocs/Assets/music/audio"; //"/media/music/naija"
$directory = "/projects/Bolaji.net/Assets/music/audio"; //"/media/music/naija"
$artist = "/".$_REQUEST['a'];
//$artist = "/d'banj";
$files = getFiles($directory . $artist);
foreach($files as $file)
{
    $Properties = array();
	if (file_exists($file))
	{
		if(substr($file, strlen($file) - 4) != ".mp3")
		{
			continue;
		}

		$fd = fopen($file, "rb");
		fseek($fd, -128, SEEK_END);
		$id3_tag = fread ($fd, 3);
		//if ($id3_tag == "TAG") 
		//{
			$Properties["title"] = trim(fread($fd, 30));
			$Properties["artist"] = trim(fread($fd, 30));
			$Properties["album"] = trim(fread($fd, 30));
			$Properties["year"] = trim(fread($fd, 4));
			$Properties["comment"] = trim(fread($fd, 30));
			$Properties["track"] = trim(ord(fread($fd, 31)));
			$Properties["genreid"] = trim(ord(fread($fd, 1)));

			//echo "<tr><td>$file</td></tr>";

			preg_match('!\/audio\/((.*?)\/((.*?)\/)?(.*))!', $file, $matches);

			preg_match('!(-((.*?).*?))?_(.*)\.mp3!', $matches[5], $tracks);
			$track = preg_replace(array("/_/","/\./","/\+/"),array(" "," "," & "),$tracks[4]);
			if($tracks[2])
			{
				$track .= " feat. ". preg_replace(array("/-/","/\./"), array(" & "," "), $tracks[2]);
			}
			
			$Params->Name = preg_replace(array("/\./","/\+/"),array(" "," & "),$matches[2]);
			$Params->Nameid = strtolower(preg_replace(array("/\W/"),array(""),$matches[2]));
			$Params->Album = str_replace("_"," ",$matches[4]);
			$Params->Albumid = 0;
			$Params->Title = $track;
			$Params->Url = "/".$matches[2].(!empty($matches[4])?"/".$matches[4]:"")."/".$matches[5];

			//if($Params->Name != "apexx")
			//{
			//	continue;
			//}

			echo "<br/>", $Params->Name, " | ", $Params->Album, " | ", $Params->Title, " | ", $Params->Url;
			
			

			$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MEDIA"]);
			$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsArtistInfo", $Params);
			if($Response->Success)
			{
				$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
				//echo "ArtistInfo: ", $ObjectID->ID;
				$Params->Artistid = $ObjectID->ID;
			}
			if(isset($Params->Album) && !empty($Params->Album))
			{
				$Params->Albumyear =  isset($Properties["year"]) && !empty($Properties["year"]) ? $Properties["year"] : 9999;
				$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsAlbumInfo", $Params);
				if($Response->Success)
				{
					$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
					//echo "AlbumInfo: ", $ObjectID->ID;
					$Params->Albumid = $ObjectID->ID;
				}
			}

			$Params->Tracknum = $Properties["track"];
			$Params->Songyear = $Params->Albumyear;
			$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsSongInfo", $Params);
			if($Response->Success)
			{
				$ObjectID = $Response->Object;
				//echo "SongInfo: ", $ObjectID->ID;
				$Params->Songid = $ObjectID->ID;
			}
			
			

			echo "<br/>";
		//}

		//break;
	} else{
		echo "<br/><font color='#900000'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The file you selected <B>".$file."</B> does not exist or is not accessable</font><BR>";
	}
}

?>
</tbody>
</table>