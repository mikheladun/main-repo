<div class="ContentDiv">
	<table class="Playlist" border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<th colspan="2" class="SectionHeader">Top News</th>
		</thead>
		<tbody>
<?php
 require_once(dirname(__FILE__)."/../Library/rss/magpierss/rss_fetch.inc");
 $urlArr = array("http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q=Nigeria&output=atom");//array("http://allafrica.com/tools/headlines/rdf/nigeria/headlines.rdf"); //"http://allafrica.com/tools/headlines/rdf/latest/headlines.rdf"
 $count = 1;
 foreach($urlArr as $url)
 {
  $rss = fetch_rss($url);
  $rss->items = array_slice($rss->items, 0, 4);
  foreach ($rss->items as $item)
  {
  	 if($count % 2 == 1)
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
	 $description = strip_tags($item['description'], "<img>");
	 $img = "";
	 if(ereg(".+img src=(.+) width=([0-9]+) height=([0-9]+) .*", $description, $regs))
	 {
		$width = intval($regs[2]);
		$height = intval($regs[3]);
	 	$img = "<span class=\"FloatLeft\" style=\"text-align:center;\"><img border=\"0\" src=\"".$regs[1]."\" width=\"$width\" height=\"$height\" align=\"left\" /></span>";
	 }
?>
 	 <td valign="top"><?=$img?><p class="PaddedBox"><a href="<?=$url?>" target="_blank"><?=$title?></a><br/><small class="BluTxt"><?= strtoupper($source) ?></small></p></td>

<?php
  	 if($count % 2 == 0)
	 {
	 	echo "</tr>";
	 }

	 $count++;
  }
 }
?>
			<tr><td colspan="2" class="Footer" align="right"><a class="BluTxt" href="/news/">Go to news&nbsp;&raquo;</a>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
		</tbody>
	</table>
</div>