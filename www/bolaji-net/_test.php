<html>
<body>
<?php
 require_once(dirname(__FILE__)."/Library/Framework/Core/Framework.Class.ApplicationContext.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.USER"]);
 $Params->Name = "bolaji aladejana";
 $Response = $Service->Execute(&$AppContext, "GetUserByName", $Params);
 
 require_once(dirname(__FILE__)."/Library/Framework/Classes/FlashRemoteDelegate.php");
 $frd = new FlashRemoteDelegate();
 $response = $frd->execute('Top10', null);
 print_r($response);
 
 $response = $frd->execute('music.artistvideo:5871',"5871");
 echo "<br/>execute artistvideo:1991 $response";
 
 $response = $frd->execute('video.video',"256");
 echo "<br/>execute video.video:256 $response";
 
 //$response = $frd->execute('NumOfPlay',"music.song:10191");
 //echo "<br/>execute NumOfPlay $response";

?>
<p></p>
<p></p>
<div style="padding:.5em 0;background:#000;width:490px;" align="center" onmouseover="Css('Time','Visible')" onmouseout="Css('Time','Invisible')">
 <div id="FLVPlayer" align="center" style="padding:0;padding:.5em 0;background:#000;width:480px;height:360px;"></div>
 <div style="background:#383838 url('/images/player/bg_vidplayer.gif') bottom no-repeat;height:32px;width:480px;">
	 <div id="PlayPause" style="margin:.7em 0 .5em .7em;float:left;width:14px;height:14px;background:url('/images/player/img_vidplayer_play.gif') no-repeat;cursor:pointer;" onclick="soundManager.o._pause();">&nbsp;</div>
	 <div id="Buffer" style="margin:.7em 1em .5em 1em;float:left;height:17px;width:290px;background:url('/images/player/img_vidplayer_buffer.gif') repeat-x;overflow:hidden;">
	  <div id="Seek" style="width:18px;height:17px;"><img style="margin-left:-555px;cursor:pointer;" src="/images/player/img_vidplayer_seek.gif" width="300" height="17" /></div>
	 </div>
	 <div style="margin:.7em .7em .5em 0;width:16px;float:right;cursor:pointer;"><img src="/images/player/img_vidplayer_vol.gif" width="16" height="13" /></div>
	 <div class="Spacer"></div>
	 <div id="Time" class="Invisible" style="position:relative;margin:-1.7em 0 0 4.2em;width:290px;font-size:9px;color:#ccc;float:left;"><span id="Position" style="float:left;">00:00</span><span id="Duration" style="float:right;">00:00</span></div>
 </div>
</div>
</body>
</html>
