<?php
 require_once(dirname(__FILE__)."/../Library/rss/magpierss/rss_fetch.inc");

 $urlArr = array("http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q=nigeria+nigerian&output=atom&imv=1");
 $count = 1;
 $rss = fetch_rss($urlArr[0]);

 if(isset($_REQUEST['cc']) && $_REQUEST['cc'] == "google")
 {
 	require_once("subheader.php");
 }
 elseif(!isset($_REQUEST['cc']) || empty($_REQUEST['cc']))
 {
 	require_once("subheader.php");
	$Subheader = true;
 }
?>
<big><big class="GrnTxt">&nbsp;<?=strtoupper($rss->channel['title'])?></big></big>
<div class="">
<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
<?php
  foreach ($rss->items as $item)
  {
	 $description = $item['content']['encoded'];
	 echo "<tr><td colspan=\"2\" style=\"padding:0;\">", $description, "</td></tr>";
  }
?>
	</tbody>
</table>
<?php if(empty($_REQUEST['cc'])) { ?>
	<p align="left"><br/><a class="BluTxt" href="/news/<?=$src[0]?>/"><strong><u>More <?=$rss->channel['title']?></u></strong></a></p>
<?php } else { ?>
	<div>
		<div class="PaddedBox FloatLeft" style="width:38%;" align="center">&laquo;&nbsp;<a href="/news/"><strong>Back to News</strong></a></div>
		<div class="PaddedBox FloatLeft" style="width:55%;" align="center"><a href="<?=$rss->channel['link']?>" target="_blank"><strong><?=$rss->channel['title']?></strong></a>&nbsp;&raquo;&nbsp;&nbsp;&nbsp;&nbsp;</div>
		<div class="Spacer"></div>
	</div>
<?php } ?>
</div>
