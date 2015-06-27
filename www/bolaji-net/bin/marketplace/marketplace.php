<?php
	if(isset($_REQUEST['cc']) && strtolower($_REQUEST['cc']) == "view")
	{
		$Page = "view";
	}
	elseif(isset($_REQUEST['cc']) && !empty($_REQUEST['cc']))
	{
		if(strtolower($_REQUEST['cc']) == "events")
		{
			$Page = "events/events";
		}
		else
		{
			$Page = "browse";
		}
	}
	else
	{
		$Page = "category";
	}

	require_once("$Page.php");

	if(!isset($_REQUEST['cc']) || empty($_REQUEST['cc']))
	{
		require("stores/feature.php");
		require(dirname(__FILE__)."/ads.php");
	}
?>