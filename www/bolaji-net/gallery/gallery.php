<?php
	if(isset($_REQUEST['cc']) && !empty($_REQUEST['cc']))
	{
		if(strtolower($_REQUEST['cc']) == "browse")
		{
			require_once("browse.php");
		}
		elseif(strtolower($_REQUEST['cc']) == "view")
		{
			require_once("view.php");
			require_once("ads/topbanner.php");
		}
		else
		{
			require_once("browse.php");
		}
	}
	elseif(!isset($_REQUEST['cc']) || empty($_REQUEST['cc']))
	{
		require_once("feature/feature.php");
		require_once("browse.php");
	}
	else
	{
		require_once("view.php");
	}
?>