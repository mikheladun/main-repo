<?php 
	if(isset($_POST['submit']) || strtolower($_REQUEST['cc']) == "listing")
	{
		require_once(dirname(__FILE__)."/includes/session.php"); 
		session_start();
 		require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
		require_once(dirname(__FILE__)."/marketplace/listing/index.php");
	}
	elseif(strtolower($_REQUEST['cc']) == "events")
	{
		require_once(dirname(__FILE__)."/marketplace/events/index.php");
	}
	else
	{
 		require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
		require_once(dirname(__FILE__)."/marketplace/index.php");
	}
?>