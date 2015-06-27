<?php 
if(isset($_REQUEST['cn']) && !empty($_REQUEST['cn']))
{
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Artistid = $Artist->ArtistID;
	$Params->Albumid = $_REQUEST['cn'];
	$Response = $Service->Execute(&$AppContext, "GetAlbumInfo", $Params);
	if($Response->Success)
	{
		if($Response->Object != NULL)
		{
?>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
			foreach($Response->Object as $AlbumInfo)
			{
?>
		<tr><td><img align="left" src="<?=$AlbumInfo->ThumbUrl?>" border="0"/>&nbsp;&nbsp;<?=ucwords($AlbumInfo->Title)?></td></tr>
<?php
			}
?>
		</tbody>
	</table>
<?php
		}
	}
} 
else
{
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Artistid = $Artist->ArtistID;
	$Response = $Service->Execute(&$AppContext, "GetArtistAlbums", $Params);
	if($Response->Success)
	{
		if($Response->Object != NULL)
		{
			$HasMusic = true;
			$Counter = 0;
?>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
			$ShowScroller = count($Response->Object) > 9 ? true : false;
			foreach($Response->Object as $AlbumInfo)
			{
				$Counter++;
?>
		<tr<?=(isset($AlbumInfo->AlbumID) && $_REQUEST['vid']==$AlbumInfo->AlbumID)?" class=\"Current\"":""?> id="<?=$AlbumInfo->ArtistID,$AlbumInfo->AlbumID?>"><td class="Id" valign="top"><?=$Counter?></td><td class="Track" style="width:93%;"><img align="left" src="/images/img_main2_vid1.gif" border="0"/>&nbsp;&nbsp;<a href="/music/artist/<?=$Artist->NameID?>/albums/<?=$AlbumInfo->AlbumID?>" title="<?=$Artist->Name?> - <?=ucwords($AlbumInfo->Title)?>"><?=ucwords($AlbumInfo->Title)?></a></td></tr>
<?php
			}
?>
		</tbody>
	</table>
<?php
		}
		else
		{
?>
<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr><td colspan="3">No albums</td></tr> 
	</tbody>
</table>
<?php
		}
	}
}
?>
