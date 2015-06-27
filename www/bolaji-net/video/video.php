<?php
	if(isset($_REQUEST['cc']) && !empty($_REQUEST['cc']))
	{
		if(strtolower($_REQUEST['cc']) == "view")
		{
			$Page = "ads/topbanner";
		}
		else
		{
			$Page = "browse";
		}
	}
	else
	{
		$Page = "playlist";
	}

	require_once("$Page.php");
?>