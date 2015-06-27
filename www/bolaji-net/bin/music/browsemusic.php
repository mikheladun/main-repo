<div class="ContentDiv">
<?php
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Page = 1;
	if($_REQUEST['cn'] === "0")
	{
		$Params->Name = "'^[[:digit:]]' or name regexp '^[[:punct:]]'";
	}
	else
	{
		$Params->Name = "'^".$_REQUEST['cn']."'";
		//$Params->Name = "^".$_REQUEST['cn'];
	}
	$Response = $Service->Execute(&$AppContext, "GetAllArtistsByName", $Params);

	if($Response->Success)
	{
		$Counter = 0;
		if($Response->Object == NULL)
		{
?>
		<div class="Playlist">
			<dl><dd class="End" style="width:99%;">No record found</dd></dl>
			<div class="Spacer"></div>
		</div>
<?php
		}
		else
		{
			foreach($Response->Object as $ArtistInfo)
			{
				$Counter++;
?>
		<div class="Playlist">
			<dl>
				<dd class="End" style="width:100%;"><strong><?=$Counter <= 9 ? "&nbsp;" : ""?><?=$Counter?>&nbsp;&nbsp;&nbsp;<a href="/music/artist/<?=$ArtistInfo->NameID?>"><?=ucwords($ArtistInfo->Name)?></a></strong></dd>
			</dl>
		</div>
<?php
		}
		}
	}
?>
</div>
<div class="Divider">&nbsp;</div>