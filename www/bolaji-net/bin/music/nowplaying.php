<?php
if(isset($_REQUEST['sid']) && !empty($_REQUEST['sid']) || isset($_REQUEST['vid']) && !empty($_REQUEST['vid']))
{
?>
<div class="NowPlaying">
<?php
	$ArtistID = $_REQUEST['aid'];
	$VideoID = $_REQUEST['vid'];
	$SongID = $_REQUEST['sid'];
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

	$Params->Videoid = $VideoID;
	$Params->Songid = $SongID;
	$Params->Artistid = $ArtistID;

	if(!isset($Params->Artistid) || empty($Params->Artistid))
	{
		$Response = $Service->Execute($AppContext, isset($Params->Videoid) && !empty($Params->Videoid) ? "GetArtistByVideoId" : "GetArtistBySongId", $Params);
		if($Response->Success)
		{
			$ArtistInfo = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
			$Params->Artistid = $ArtistInfo->ID;
		}
	}

	if(isset($Params->Videoid) && !empty($Params->Videoid))
	{
		$Response = $Service->Execute($AppContext, "GetVideoInfo", $Params);
	}
	elseif(isset($Params->Songid) && !empty($Params->Songid))
	{
		$Response = $Service->Execute($AppContext, "GetSongById", $Params);
	}

	if($Response->Success)
	{
		$MediaInfo = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
?>
	<p><big><big id="NowPlayn_Info" class="GrnTxt" align="left">
		<?=strtoupper($MediaInfo->ArtistName)?> - <span style="text-transform:capitalize;"><?=$MediaInfo->Title?></span>
	</big></big></p>
	<p><strong><small id="NowPlayn_Url"><a id="NowPlayn_Url" class="BluTxt" href="/music/artist/<?=$MediaInfo->ArtistNameID?>">Go to artist's page</a>&nbsp;&raquo;</small></strong></p>
<?php 
	}
?>
</div>
<?php } ?>
