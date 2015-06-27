<?php

	if($_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'],0,6) == '/main/')
	{
		require_once(dirname(__FILE__)."/browsemktplc.php");
	}
	else if(substr($_SERVER['REQUEST_URI'],0,7) == '/music/')
	{
		require_once(dirname(__FILE__)."/../music/basecontent.php");
	}
	else if(substr($_SERVER['REQUEST_URI'],0,7) == '/video/')
	{
		require_once(dirname(__FILE__)."/../video/browse.php");
	}
	else if(substr($_SERVER['REQUEST_URI'],0,8) == '/photos/')
	{
		require_once(dirname(__FILE__)."/../photos/browse.php");
	}
	else if(substr($_SERVER['REQUEST_URI'],0,6) == '/news/')
	{
		require_once(dirname(__FILE__)."/../news/browse.php");
	}
	else if(substr($_SERVER['REQUEST_URI'],0,8) == '/wazobi/')
	{
		require_once(dirname(__FILE__)."/browsemktplc.php");
	}
?>