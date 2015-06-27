<?php
 if(isset($_REQUEST['vid']) && !empty($_REQUEST['vid']))
 {
	 $Counter = 1;
	 if(!is_array($VideoCollList))
	 {
	 	$VideosList = array($VideoCollList);
	 }
	 else
	 {
	 	$VideosList = $VideoCollList;
	 }
	 
	 if(count($VideosList) >= 1)
	 {
		 foreach($VideosList as $VideoInfo)
		 {
			if($Counter == 1)
			{
?>
		<div class="Divider"><big><big id="NowPlayn_Info" class="BlkTxt">&nbsp;&nbsp;<strong>Related Videos</strong></big></big></div>
		<div class="ContentDiv">
<?php
			}
			$VideoInfo->ThumbUrl = "/Assets/video" . $VideoInfo->ThumbUrl;
?>
	<div class="Playlist">
		<dl<?=(isset($VideoInfo->VideoID) && $_REQUEST['vid']==$VideoInfo->VideoID)?" class=\"Current\"":""?> id="<?=$VideoInfo->VideoCollID,$VideoInfo->VideoID?>">
			<dd class="Id" style="padding:.3em .3em 0 .3em;width:4%;height:40px;"><?=$Counter?></dd>
			<dd class="End" style="width:90%;"><img align="left" src="<?=$VideoInfo->ThumbUrl?>" border="0" width="35" height="26" /><img class="BtnPlay" style="position:relative;margin:1.6em 0 0 -3.6em;" width="15" height="10" border="0" src="/images/ico_play.gif" alt="Play" align="left" /><a href="/video/play/<?=!empty($VideoInfo->VideoCollID) ? "$VideoInfo->VideoCollID/" : ""?><?=$VideoInfo->VideoID?>" title="<?=ucwords($VideoInfo->Title)?>"><?=ucwords($VideoInfo->Title)?></a></dd>
		</dl>
		<div class="Spacer"></div>
	</div>
<?php
			$Counter++;
		 }
?>
		</div>
<?php
	 
		 echo "<p>&nbsp;</p>";
	 }
  }
?>