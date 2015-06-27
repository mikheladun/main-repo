<?php
if(isset($Params->Artistid) && !empty($Params->Artistid))
{
	$Response = $Service->Execute(&$AppContext, "GetArtistVideos", $Params);
	$Counter = 0;
	if($Response->Success)
	{
		if($Response->Object != NULL)
		{
?>
	<div class="Divider">&nbsp;&nbsp;<big><big><strong>Related Videos</strong></big></big></div>
<div class="PaddedBox" style="height:400px;overflow:auto;">
<?php
			foreach($Response->Object as $VideoInfo)
			{
				$Counter++;
				$ArtistInfo->NameID = $VideoInfo->ArtistNameID;
?>
	<div class="Playlist" style="width:95%;">
		<dl<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->ArtistID?><?=$VideoInfo->VideoID?>">
			<dd class="Id" style="padding:.3em .3em 0 .3em;width:4%;height:40px;"><?=$Counter?></dd>
			<dd class="End" style="width:91%;"><img align="left" src="<?=$VideoInfo->ThumbUrl?>" border="0" width="35" height="26" /><a href="/music/play/videos/<?=$VideoInfo->ArtistID?>/<?=$VideoInfo->VideoID?>" title="<?=$Artist->Name?> - <?=ucwords($VideoInfo->Title)?>"><strong><?=$VideoInfo->ArtistName?></strong><br/><?=ucwords($VideoInfo->Title)?></a></dd>
		</dl>
		<div class="Spacer"></div>
	</div>
<?php	} 
		}
?>
		</div>
<?php
	}
}
?>