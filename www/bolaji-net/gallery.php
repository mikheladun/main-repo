<?php 
	if(isset($_POST['submit']) || strtolower($_REQUEST['cc']) == "upload")
	{
		require_once(dirname(__FILE__)."/includes/session.php"); 
		session_start();
 		require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
		require_once(dirname(__FILE__)."/gallery/upload/index.php");
	}
	else
	{
 		require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
		if(!isset($_REQUEST['cc']) || empty($_REQUEST['cc']))
		{
			$_REQUEST['cc'] = "featured";
			$_REQUEST['vid'] = 1000;
		}
		require_once(dirname(__FILE__)."/gallery/index.php");
	}
?>