<?php 
 	require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");

	if(isset($_REQUEST['cc']) && !empty($_REQUEST['cc']))
	{
		require_once("news/index.php");
	}
	else
	{
		require_once("news/allnews.php");
	}
?>