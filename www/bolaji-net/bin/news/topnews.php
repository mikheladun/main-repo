<?php
 $urlArr = array("http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q=nigeria+nigerian&output=atom&imv=1");
 $rss = fetch_rss($urlArr[0]);
?>
<big><big class="GrnTxt">&nbsp;TOP NEWS HEADLINES</big></big>
<div class="Playlist">
<?php
  foreach ($rss->items as $item)
  {
	 $description = $item['content']['encoded'];
	 echo $description;

	 break;
  }
?>
<p>&nbsp;&nbsp;<a class="BluTxt" href="/news/google/"><strong><u>More Google News</u></strong></a></p>
<div class="Divider"></div>
</div>
