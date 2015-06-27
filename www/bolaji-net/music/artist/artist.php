<?php
	$Page = "artistmusic";
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	if(is_numeric($_REQUEST['aid']))
	{
		$Provider = "GetArtistById";
		$Params->Artistid = $_REQUEST['aid'];
	}
	else
	{
		$Params->Nameid = $_REQUEST['aid'];
		$Provider = "GetArtistByName";
	}

	$Response = $Service->Execute(&$AppContext, $Provider, $Params);
	if($Response->Success)
	{
		if($Response->Object != NULL)
		{
			$Artist = $Response->Object[0];
		}

		if(strtolower($_REQUEST['cc']) === "videos")
		{
			$Page = "artistvideos";
		}
		else
		{
			switch(strtolower($_REQUEST['cc']))
			{
				case 'bio' : $Page = "artistbio"; break;
				case 'photos' : $Page = "artistphotos"; break;
				case 'videos' : $Page = "artistvideos"; break;
				case 'albums' : $Page = "artistalbums"; break;
				case 'downloads' : $Page = "artistdownloads"; break;
				case 'music' : $Page = "artistmusic"; break;
				default: $Page = "artistmusic";
			}
		}
	}
?>