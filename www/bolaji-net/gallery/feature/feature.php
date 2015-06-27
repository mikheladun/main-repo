<?php
 	require_once(dirname(__FILE__)."/../../Library/Framework/Core/Framework.Class.ApplicationContext.php");
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.GALLERY"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Rank = 1;
	$Params->Offset = 1;
	$Response = $Service->Execute(&$AppContext, "GetTopPhotosList", $Params);
	if($Response->Success)
	{
		$Counter = 0;
		foreach($Response->Object as $MediaInfo)
		{
			$Counter++;
?>
		<div class="Divider"><big><big class="GrnTxt">&nbsp;<?=$MediaInfo->Title?></big></big></div>
		<div><img class="PaddedBox BorderBox1" style="margin-right:1em;" src="/Assets/photos/<?=$MediaInfo->Url?>" border="0" width="300" height="200" hspace="5" vspace="5" align="left"/>
			<p class="PaddedBox"><?=$MediaInfo->Description?></p>
		</div>
<?php
		}
	}
?>
<div class="Divider">&nbsp;</div>