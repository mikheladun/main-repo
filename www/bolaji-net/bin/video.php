<?php 
	if($_POST['submit'] || strtolower($_REQUEST['cc']) == "upload")
	{
		//Set .INI params to support uploading
		//ini_set('post_max_size', '105M');    // Set upload limit (5MB)
		//ini_set('upload_max_filesize', '105M');    // Enforce upload limit
		//ini_set('max_execution_time', 3600);    // Increase 'timeout' time 

//php_value post_max_size 10485760
//php_value upload_max_filesize 10485760
//php_value max_execution_time 3600

		require_once(dirname(__FILE__)."/includes/session.php"); 
		session_start();
 		require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
		require_once(dirname(__FILE__)."/video/upload/index.php");
	}
	else
	{
 		require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
		//if(!isset($_REQUEST['cc']) || empty($_REQUEST['cc']))
		//{
		//	$_REQUEST['cc'] = "feature";
		//	$_REQUEST['vid'] = 1000;
		//}
		require_once(dirname(__FILE__)."/video/index.php");
	}
?>
