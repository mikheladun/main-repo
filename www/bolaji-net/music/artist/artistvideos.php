<div class="ContentDiv">
<?php 
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Artistid = $Artist->ArtistID;
	$Response = $Service->Execute(&$AppContext, "GetArtistVideos", $Params);
	$Counter = 0;
	if($Response->Success)
	{
		if($Response->Object != NULL)
		{
			foreach($Response->Object as $VideoInfo)
			{
				$Counter++;
				$VideoInfo->ArtistName = $Artist->Name;
?>
	<div class="Playlist">
		<dl<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->ArtistID?><?=$VideoInfo->VideoID?>">
			<dd class="Id" style="width:4%;height:40px;"><?=$Counter?></dd>
			<dd class="End" style="width:92%;"><img align="left" src="<?=$VideoInfo->ThumbUrl?>" border="0" width="35" height="26" /><img class="BtnPlay" style="position:relative;margin:1.6em 0 0 -3.6em;" width="15" height="10" border="0" src="/images/ico_play.gif" alt="Play" align="left" /><a href="/music/play/videos/<?=$VideoInfo->ArtistID?>/<?=$VideoInfo->VideoID?>" title="<?=$Artist->Name?> - <?=ucwords($VideoInfo->Title)?>"><?=ucwords($VideoInfo->Title)?></a></dd>
		</dl>
		<div class="Spacer"></div>
	</div>
<?php
			}
		}
		else
		{
?>
		<div class="Playlist">
			<dl><dd style="width:98%;">No videos</dd><div class="Spacer"></div></dl>
		</div>
<?php
		}
	}
?>
</div>