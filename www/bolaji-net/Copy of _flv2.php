<?php
  $filePath = dirname(__FILE__);
 require_once("$filePath/Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once("$filePath/Library/Framework/Core/Framework.Utils.php");

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
<thead><td>File</td><td>Artist</td><td>Title</td></thead>
<tbody>
<?php
// Example of use
$files = getFiles("/projects/Bolaji.net/v4/www/media/video/nigeria.international"); //"/media/music/naija"
//print_r(getFiles('.')); // This will find all files in the current directory and all subdirectories
foreach($files as $file)
{
    $Properties = array();
	if (file_exists($file))
	{
		if(substr($file, strlen($file) - 4) != ".flv")
		{
			continue;
		}
		$arr = spliti("/", $file);
		$file = $arr[count($arr)-2] . "/" . $arr[count($arr)-1];
		$Properties["artist"] = str_replace("."," ",$arr[count($arr) - 2]);
		$title = $arr[count($arr) - 1];
		$title = substr($title, 0, strlen($title) - 4); //strip out .flv
		$title = str_replace(".", " ", $title);
		$Properties["title"] = $title; //strip out artist
		echo "<tr><td>$file</td><td>", trim($Properties["artist"]), " </td><td> ", trim($Properties["title"]), " </td></tr>";	

		$Params->Title = $Properties["title"];
		$Params->Url = $file;
		$Params->External = '0';
		$Params->Sourceid = NULL;
		$Params->Categoryid = NULL;
		$Params->Sourceid = 16;
		$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MEDIA"]);
		$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsVideoInfo", $Params);
		if($Response->Success)
		{
			$ObjectID = $Response->Object;
			echo "<br/>VideoInfo: ", $ObjectID->ID;
			$Params->Videoid = $ObjectID->ID;
		}
	}
}
?>
</tbody>
</table>