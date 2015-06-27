<div class="ContentDiv">
<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Utils.php");
 require_once(dirname(__FILE__)."/../Library/rss/magpierss/rss_fetch.inc");

 $NewsFeed = array();
 $NewsFeed[] = "allafrica|http://allafrica.com/tools/headlines/rdf/nigeria/headlines.rdf";
 $NewsFeed[] = "yahoo|http://news.search.yahoo.com/news/rss;_ylt=A0WTTkqBeehGNTYBtwLQtDMD;_ylu=X3oDMTA3MTBsZGZsBHNlYwNhZG0-?ei=UTF-8&p=Nigeria&view=list&eo=UTF-8";
 $NewsFeed[] = "nigeriasun|http://www.nigeriasun.com/index.php//id/8db1f72cde37faf3/headlines.xml";
 //$NewsFeed[] = "mynaijanews|http://www.mynaijanews.com/index.php?option=com_rd_rss&id=2&feed=RSS2.0&Itemid=69";

 if(isset($_REQUEST['cc']))
 {
 	if($_REQUEST['cc']  == "google")
	{
 		require("googlenews.php");
	}
	else if(!empty($_REQUEST['cc']))
	{
		 foreach ($NewsFeed as $Feed)
		 {
			$src = explode("|", $Feed);
			$url = explode("|", $Feed);
			$rss = fetch_rss($url[1]);

			if($src[0] == $_REQUEST['cc'])
			{
				$Title = $src[0];
				$rss->items = array_splice($rss->items, 0, !empty($_REQUEST['cc']) ? count($rss->items) : 5);
				require("view.php");
			}
		}
	}
 }
 else
 {
?>
<?php require("topnews.php"); ?>
<div class="Divider"></div>
<div id="TabDiv2" class="ThreeTabPortalDiv">
	<ul class="MPlayerTabs">
		<li id="Tab2" class="Current">All Africa.com</li>
		<li id="Tab3">Yahoo News</li>
		<li id="Tab4">Nigerian Sun</li>
		<!--  li id="Tab5">My Naija News.com</li  -->
	</ul>
	<div class="Spacer"></div>
	<div class="PortalDivContent">
<?php
	 $Feeds = array_splice($NewsFeed, 0);
	 $count = 1;
	 foreach ($Feeds as $Feed)
	 {
		$src = explode("|", $Feed);
		$url = explode("|", $Feed);
		$rss = fetch_rss($url[1]);

		$rss->items = array_splice($rss->items, 0, 5);
?>
	<div id="Tab<?=++$count?>Div" class="PaddedBox <?= $count == 2 ? "Current" : "ContentDiv" ?>">
		<?php require("view.php"); ?>
	</div>
<?php
	}
?>
  </div>
 </div>
<?php 
 }
?>
<p>&nbsp;</p>
</div>