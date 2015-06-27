<div id="MusicPlayer">
	<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
</div>
<div class="Divider"></div>


<!--   div id="MPlayer" style="width:460px;">
	<div class="MPlayerCntrl">
		<div class="Cntrl"><a href="#" id="MPlayer_PP" onclick="soundManager.o._pause()"><img src="/music/player/images/btn_mplayer_pl.jpg" border="0" /></a><a href="#" id="MPlayer_RR" onclick="soundManager.o._playPrev();$('MPlayer_Id').setHTML('<br/><br/>LOADING...');$('MPlayer_Info').setHTML('&nbsp;');"><img src="/music/player/images/btn_mplayer_rew.jpg" border="0" /></a><a href="#" id="MPlayer_FF" onclick="soundManager.o._playNext();$('MPlayer_Id').setHTML('<br/><br/>LOADING...');$('MPlayer_Info').setHTML('<br/>&nbsp;');"><img src="/music/player/images/btn_mplayer_ff.jpg" border="0" /></a></div>
		<div id="area2" style="width:70%;"><img src="/music/player/images/img_mplayer_prog_l.jpg" alt="" align="left" /><div id="knob2"></div><div id="knob" style="margin-left:-.8em;margin-top:.2em;width:0px;height:10px;background:#555;"></div></div>
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
			$('knob').setStyle('width', k-l + 2);
			//console.log($('knob2').getLeft() + ' - ' + $('knob').getLeft() + ' - ' + (w + (k-l)));
		}	
	}
	).set(0);
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
</div  -->