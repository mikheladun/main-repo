<?php if(isset($Title)) { ?>
	<big><big class="GrnTxt">&nbsp;<?=strtoupper($rss->channel['title'])?></big></big>
<?php } ?>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
<?php
  foreach ($rss->items as $item)
  {
	  $title = $item['title'];
	  $url = $item['link'];
	  $desc = $item['description'];
	  $pubDate = $item['pubDate'];
	  $source = "allafrica.com";

	  if(empty($_REQUEST['cc'])) 
	  {
	  	//$desc = substr($desc, 0, 165) . (strlen($desc) > 165 ? "..." : "");
	  }
	  $title = "<u>$title</u>";
?>
 	 <tr>
	 	<td valign="top" colspan="2">
			<h3><a class="BluTxt" href="<?=$url?>" target="_blank"><?=$title?></a></h3>
			<p class="Caption"><?=$desc?>&nbsp;<a class="BluTxt" style="text-decoration:none;" href="<?=$url?>" target="_blank">
			<?php if(empty($_REQUEST['cc'])) { ?>
	 		[ more ]</a>
			<?php } ?>
			</p>
		</td>
	 </tr>
<?php
  }
?>
</tbody>
</table>
<?php if(empty($_REQUEST['cc'])) { ?>
	<p class="PaddedBox"><a class="BluTxt" href="/news/<?=$src[0]?>/"><strong><u>More <?=$rss->channel['title']?></u></strong></a></p>
<?php } else { ?>
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
	<tr>
		<td align="center">&laquo;&nbsp;<a href="/news/"><strong><u>Back to News</u></strong></a></td>
		<td align="center"><a href="<?=$rss->channel['link']?>" target="_blank"><strong><u><?=$rss->channel['title']?></u></strong></a></td>
	</tr>
</tbody>
</table>
<?php } ?>
