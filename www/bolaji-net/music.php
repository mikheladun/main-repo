<?php 
 require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");

 $MusicSection = isset($_REQUEST['cc']) && !empty($_REQUEST['cc']) ? $_REQUEST['cc'] : "index";
 
 if(strtolower($MusicSection) == "browse")
 {
 	if(strtolower($_REQUEST['cn']) == "videos")
	{
 		require_once("music/video/browse.php");
	}
	else
	{
 		require_once("music/browse.php");
	}
 }
 elseif(strtolower($MusicSection) == "artist")
 {
	require_once("music/artist/index.php");
 }
 else if(strtolower($MusicSection) == "videos")
 {
	if( (isset($_REQUEST['vid']) && !empty($_REQUEST['vid'])) && (isset($_REQUEST['aid']) && !empty($_REQUEST['aid'])) )
	{
		require_once("music/artist/index.php");
	}
	else
	{
		require_once("music/video/index.php");
	}
 }
 else
 {
 	require_once("music/index.php");
 }
?>