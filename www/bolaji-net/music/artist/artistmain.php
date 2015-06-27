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
	<div class="Divder"><p>&nbsp;<big><big class="GrnTxt"><?=strtoupper($Artist->Name)?><small class="GryTxt" style="font-size:80%;">&nbsp;&nbsp;&nbsp;MAIN PAGE</small></big></big></p></div>
	<p>&nbsp;</p>
<?php
	if(isset($_REQUEST['sid']) || isset($_REQUEST['vid']))
	{
		require_once(dirname(__FILE__)."/../mediaplayer.php");
	}

?>
