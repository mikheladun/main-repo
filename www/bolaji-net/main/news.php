<div class="SectionHeader" style="padding:0 .5em .2em .5em;background:none;">
	<span class="FloatRight" style="text-transform:lowercase;"><a class="GrnTxt" href="/news/">more &raquo;&nbsp;&nbsp;</a></span>
	<span class="GrnTxt"><a class="GrnTxt" href="/news/">News Headlines</a></span>
</div>
<div class="ContentDiv">
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0">
		<tbody>
	<?php
	 require_once(dirname(__FILE__)."/../Library/rss/magpierss/rss_fetch.inc");
	 $urlArr = array("http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q=nigeria+nigerian&output=atom&imv=1");//array("http://allafrica.com/tools/headlines/rdf/nigeria/headlines.rdf"); //"http://allafrica.com/tools/headlines/rdf/latest/headlines.rdf"
	 $count = 1;
	 foreach($urlArr as $url)
	 {
	  $rss = fetch_rss($url);
	  $rss->items = array_slice($rss->items, 0, 7);
	  foreach ($rss->items as $item)
	  {
		 if($count % 1 == 0)
		 {
			echo "<tr>";
		 }
		 $title = $item['title'];
		 $title = (substr($title,0,8) == 'Nigeria:') ? substr($title,9,strlen($title)) : $title;
		 $title2 = $title;
		 //echo $title, strpos($title,'-'), strrpos($title,'-');
		 $title = strpos($title, '-') != -1 ? ( (strpos($title,'-') == strrpos($title,'-')) ? substr($title,0,strpos($title,'-')) : substr($title, 0, strrpos($title, '-')) ) : $title;
		 $source = strpos($title2, '-') != -1 ? ( substr($title2, strrpos($title2,'-')+2, strlen($title2)) ) : 'Google News';
		 $url = $item['link'];
		 $description = $item['content']['encoded'];
		 $img = "";
		 if(ereg(".?img src=(.+) width=([0-9]+) height=([0-9]+) .?", $description, $regs))
		 {
			$width = intval($regs[2]);
			$height = intval($regs[3]);
			$img = "<span class=\"FloatLeft\" style=\"text-align:center;\"><img border=\"0\" src=\"".$regs[1]."\" width=\"$width\" height=\"$height\" align=\"left\" hspace=\"5\" vspace=\"5\" /></span>";
		 }
	?>
		 <td valign="top" style="padding:0;"><?=$img?><p class="PaddedBox" style="padding:.3em .3em .2em .3em;"><a href="<?=$url?>" target="_blank"><?=$title?></a><br/><small class="BluTxt"><?= strtoupper($source) ?></small></p></td>
	
	<?php
		 if($count % 1 == 0)
		 {
			echo "</tr>";
		 }
	
		 $count++;
	  }
	 }
	?>
			<tr><td colspan="2" align="center"><a class="BluTxt" href="/news/"><strong>Go to News&nbsp;&raquo;</strong></a></td></tr>
		</tbody>
	</table>
</div>
