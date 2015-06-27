<div class="ContentDiv">
<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");

 $ServiceName = $AppContext->Configuration["SERVICE.NAME.VIDEO"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

 $Response = $Service->Execute($AppContext, "GetVideosListCount", $Params);
 $itemsTotalCount = $Response->Object->Count;
 $AppContext->Configuration["PAGING_OFFSET"] = 16;

 $Params = new stdClass();
 $Params->Category = isset($_REQUEST['cn']) && !empty($_REQUEST['cn']) ? $_REQUEST['cn'] : $_REQUEST['cc'];
 $Params->Page = !isset($_REQUEST['pp']) || empty($_REQUEST['pp']) ? 1 : $_REQUEST['pp'];
 $Params->Offset = 16;
 $Response = $Service->Execute($AppContext, "GetVideosList", $Params);
?>
<div class="Divider"><p>&nbsp;<big><big class="GrnTxt">Browse Videos</big></big></p></div>
	<div class="PaddedBox Spacer">
<?php $ContextPath = "/video/browse/"; include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
	<div class="Spacer"></div>
	</div
><?php
 if(!$Bpage)
 { 
 	$Bpage = $Params->Page;
 }
?>
	<div class="Playlist">
<?php
	if($Response->Success)
	{
			$Counter = 0;
			foreach($Response->Object as $VideoInfo)
			{
				//$VideoInfo->ThumbUrl = "/Assets/video/" . (isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? $VideoInfo->VideoCollID : $VideoInfo->VideoID) . "/" . $VideoInfo->ThumbUrl;
				$VideoInfo->ThumbUrl = "/Assets/video" . $VideoInfo->ThumbUrl;
				$Description = $VideoInfo->Description;
				$Title = $VideoInfo->Title;
				$VideoInfo->Description = substr($Description, 0, 40) . (strlen($Description) > 40 ? " ..." : "");
				$VideoInfo->Title = substr($Title, 0, 50) . (strlen($Title) > 50 ? " ..." : "");
				$Link = "/video/play".(isset($VideoInfo->VideoCollID) && !empty($VideoInfo->VideoCollID) ? "/$VideoInfo->VideoCollID" : "")."/$VideoInfo->VideoID";

				$Counter++;

	?>
				<div class="<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?"Current FloatLeft":"FloatLeft"?>" style="border:2px solid #f1f1f1;border-right:1px solid #f1f1f1;margin:0;padding:0;height:150px;width:24%;overflow:hidden;" id="<?=$VideoInfo->VideoID?>">
					<div style="margin-top:.5em;margin-left:.7em;">
					<div style="width:110px;"><a href="<?=$Link?>"><img src="<?=$VideoInfo->ThumbUrl?>" border="0" vspace="3" hspace="0" /><img class="BtnPlay" border="0" src="/images/ico_play.gif" alt="" align="left" vspace="2" /></a></div>
					<p style="width:95%;font-weight:normal;"><a href="<?=$Link?>"><?=ucwords($VideoInfo->Title)?></a></p>
					</div>
				</div>
	<?php
			}
		}
?>
		<div class="Spacer"></div>
		</div>
	<div class="PaddedBox">
<?php $ContextPath = "/video/browse/"; include(dirname(__FILE__)."/../includes/breadcrumbs.php"); ?>
		<div class="Spacer"></div>
	</div>
<p>&nbsp;</p>
</div>
