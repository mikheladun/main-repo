<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 $ServiceName = $AppContext->Configuration["SERVICE.NAME.VIDEO"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
 $Params->VideoCollid = $_REQUEST['cid'];
 $Params->Videoid = $_REQUEST['vid'];
 $VideoCollList;

 if(isset($Params->VideoCollid) && !empty($Params->VideoCollid) && $Params->VideoCollid != "feature")
 {
 		$Params->Groupid = $Params->VideoCollid;
		$Response = $Service->Execute(&$AppContext, "GetVideosCollList", $Params);
 }
 else
 {
	$Response = $Service->Execute(&$AppContext, "GetVideoInfo", $Params);
 }
 if($Response->Success && $Response->Object != NULL)
 {
	$VideoCollList = $Response->Object;
 }
 if(isset($_REQUEST['vid']) && !empty($_REQUEST['vid']))
 {
	 if(!is_array($VideoCollList))
	 {
	 	$VideosList = array($VideoCollList);
	 }
	 else
	 {
	 	$VideosList = $VideoCollList;
	 }

	 foreach($VideosList as $VideoInfo)
	 {
	 	if($VideoInfo->VideoID == $Params->Videoid)
		{
?>
	<div class="NowPlaying">
		<p><big><big id="NowPlayn_Info" class="GrnTxt" align="left"><?=strtoupper($VideoInfo->Title)?></big></big></p>
		<div class="Divider"></div>
		<?php require_once("mediaplayer.php"); ?>
		<p class="PaddedBox BorderBox1" align="left"><?=$VideoInfo->Description?></p>
	</div>
<?php
			break;
		}
	 }
  }
?>