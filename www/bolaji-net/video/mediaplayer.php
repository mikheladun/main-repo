<?php
 if(isset($_REQUEST['vid']) && !empty($_REQUEST['vid']))
 {
	//require_once(dirname(__FILE__)."/../music/player/video.php");
?>
<div style="padding:.5em 0;background:#000;width:560px;" align="center">
	<div id="FLVPlayer" align="center" style="padding-top:.5em;background:#000;width:480px;height:360px;"></div>
</div>
<div id="MPlayer" style="width:560px;">
	<div class="MPlayerCntrl">
		<div class="Cntrl"><a href="#" id="MPlayer_PP" onclick="soundManager.o._pause()"><img src="/music/player/images/btn_mplayer_pl.jpg" border="0" /></a></div>
		<div id="area2" style="width:85%;"><img src="/music/player/images/img_mplayer_prog_l.jpg" alt="" align="left" /><div id="knob2"></div><div id="knob" style="margin-left:-.8em;margin-top:.2em;width:0px;height:10px;background:#555;"></div></div>
		<div align="right"><span class="area">&nbsp;<img src="/music/player/images/img_mplayer_prog_r.jpg" alt="" /></span><span id="MPlayer_Time" class="Time">00:00</span></div>
	</div>
<script type="text/javascript" language="javascript">
/* Slider 1 */
var pos = 0;
var mySlide = new Slider($('area2'), $('knob2'), {
	steps: 100,
	onChange: function(step){
		pos = step;
		//$('knob').setStyle('width', $('knob').getStyle('width').toInt() + 1);
		var k = $('knob2').getLeft();
		var l = $('knob').getLeft();
		var w = $('knob').getStyle('width').toInt();
		var v = $('knob2').getStyle('width').toInt();
		//console.log($('knob2').getLeft() + ' - ' + $('knob').getLeft() + ' - ' + w);
		$('knob').setStyle('width', k-l < 10 ? 10 : (k-l));
	}
}).set(0);
$('knob2').makeDraggable({
	container: 'area2',
	onDrag: function() {
		//$('knob').setStyle('width', $('knob').getStyle('width').toInt() + 1);
	}.bind($('knob2')),
	onComplete: function() {
		soundManager.o._setPosition(pos);
	}.bind($('knob2'))
});
</script>
	<div class="Spacer"></div>
</div>
<div class="Playlist">
	<dl class="NowPlaying">
		<dd style="padding:.5em 0;padding-top:2em;width:18%;font-size:80%;" id="MPlayer_Id">LOADING...</dd>
		<dd class="End" id="MPlayer_Info" style="padding-right:0;width:80%"><br/>&nbsp;</dd>
		<div class="Spacer"></div>
	</dl>
</div>
<div class="Spacer"></div>
<?php } ?>

