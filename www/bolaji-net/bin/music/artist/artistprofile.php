<ul class="MPlayerTabs">
	<li<?php echo strtolower($_REQUEST['cc']) === "main" || strtolower($_REQUEST['cc']) === "music" || strtolower($_REQUEST['cc']) === "artist" ? " class=\"Current\"" : "" ?>><a href="/music/artist/<?=$Artist->NameID?>/music/">Music</a></li>
	<li<?php echo strtolower($_REQUEST['cc']) === "videos" ? " class=\"Current\"" : "" ?>><a href="/music/artist/<?=$Artist->NameID?>/videos/">Videos</a></li>
	<li<?php echo strtolower($_REQUEST['cc']) === "albums" ? " class=\"Current\"" : "" ?>><a href="/music/artist/<?=$Artist->NameID?>/albums/">Albums</a></li>
	<li<?php echo strtolower($_REQUEST['cc']) === "photos" ? " class=\"Current\"" : "" ?>><a href="/music/artist/<?=$Artist->NameID?>/photos/">Photos</a></li>
	<li<?php echo strtolower($_REQUEST['cc']) === "bio" ? " class=\"Current\"" : "" ?>><a href="/music/artist/<?=$Artist->NameID?>/bio/">Bio</a></li>
	<li<?php echo strtolower($_REQUEST['cc']) === "downloads" ? " class=\"Current\"" : "" ?>><a href="/music/artist/<?=$Artist->NameID?>/downloads/">Downloads</a></li>
</ul>
<div class="Spacer"></div>
<div class="PortalContentDiv">
	<div class="PaddedBox1" style="background:#f3f3f3;">
<?php  require_once("$Page.php"); ?>
	</div>
</div>
<p>&nbsp;</p>
<?php require_once(dirname(__FILE__)."/../../music/browselinks.php"); ?>
<p>&nbsp;</p>