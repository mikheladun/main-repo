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

    $Params = new stdClass();
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
   <div align="center">
	<p><big id="NowPlayn_Info" class="GrnTxt"><?=strtoupper($MediaInfo->ArtistName)?></p>
	<p class="GrnTxt" style="text-transform:capitalize;"><?=$MediaInfo->Title?></p>
	<p><strong><small id="NowPlayn_Url"><a id="NowPlayn_Url" class="BluTxt" href="/music/artist/<?=$MediaInfo->ArtistNameID?>">Go to artist's page</a>&nbsp;&raquo;</small></strong></p>

	<p style="display:none;"><?=$MediaInfo->Url?></p>
	<audio controls autoplay="true">
  	 <source src="/Assets/music/audio<?=$MediaInfo->Url?>" type="audio/mpeg">
  	 Your browser does not support the audio tag.
	</audio>
	</div>
<?php 
	}
?>
</div>
<?php } ?>
