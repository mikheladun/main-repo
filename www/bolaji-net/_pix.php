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
<thead><td>File</td><td>Category</td><td>Title</td><td>Thumb</td></thead>
<tbody>
<?php
// Example of use
$files = getFiles("/projects/Bolaji.net/v4/www/gallery"); //"/media/music/naija"
//print_r(getFiles('.')); // This will find all files in the current directory and all subdirectories
foreach($files as $file)
{
    $Properties = array();
	if (file_exists($file))
	{
		if(substr($file, strlen($file) - 4) != ".jpg")
		{
			continue;
		}
		$arr = spliti("/", $file);
		$file = $arr[count($arr)-2] . "/" . $arr[count($arr)-1];
		$Properties["category"] = str_replace("."," ",$arr[count($arr) - 2]);
		$category = $Properties["category"];
		if($category === "thumbnails")
		{
			continue;
		}
		$title = $arr[count($arr) - 1];
		$title = substr($title, 0, strlen($title) - 4); //strip out .flv
		$title = str_replace(".", " ", $title);
		$Properties["title"] = $title; //strip out artist
		$thumb = "$category/thumbnails/$title.jpg";
		echo "<tr><td>$file</td><td>", $category, " </td><td> ", trim($Properties["title"]), " </td><td>$thumb</td></tr>";	

		$Params->Title = $category;
		$Params->Url = $file;
		$Params->Thumburl = $thumb;
		$Params->External = '0';
		$Params->Sourceid = NULL;
		$Params->Categoryid = NULL;
		$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.GALLERY"]);
		$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsPhotoColl", $Params);
		if($Response->Success)
		{
			$ObjectID = $Response->Object;
			echo "<br/>PhotoCollInfo: ", $ObjectID->ID;
			$Params->Collid = $ObjectID->ID;

			if(isset($Params->Collid) && !empty($Params->Collid))
			{
				$Params->Title = $Properties["title"];
				$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsPhoto", $Params);
				if($Response->Success)
				{
					$ObjectID = $Response->Object;
					echo "<br/>PhotoInfo: ", $ObjectID->ID;
				}
			}

		}
	}
}
?>
</tbody>
</table>