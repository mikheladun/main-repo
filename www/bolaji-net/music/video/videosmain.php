<?php
 $ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
 $Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
 $Referer = $_SERVER['HTTP_REFERER'];
?>
<div class="ContentDiv">
	<div>
		<div class="Divider"><p>&nbsp;<big><big class="GrnTxt">Music Videos</big></big></p></div>
		<div class="ThreeTabPortalDiv">
			<ul class="MPlayerTabs">
				<li id="PopT" class="Current"><a href="javascript:;" onclick="Css('PopT','Current');Css('RecT','');Css('GhvT','');Css('PopC','Current');Css('RecC','ContentDiv');Css('GhvC','ContentDiv');">Top Videos</a></li>
				<li id="RecT"><a href="javascript:;" onclick="Css('PopT','');Css('RecT','Current');Css('GhvT','');Css('PopC','ContentDiv');Css('RecC','Current');Css('GhvC','ContentDiv');">Recommended</a></li>
				<li id="GhvT"><a href="javascript:;" onclick="Css('PopT','');Css('RecT','');Css('GhvT','Current');Css('PopC','ContentDiv');Css('RecC','ContentDiv');Css('GhvC','Current');">African Videos</a></li>
			</ul>
			<div class="Spacer"></div>
			<div class="PortalDivContent">
				<div id="PopC" class="Current">
					<?php require_once("popular.php"); ?>
				</div>
				<div id="RecC" class="ContentDiv">
					<?php require("recommended.php"); ?>
				</div>
				<div id="GhvC" class="ContentDiv">
					<?php require("ghanavideos.php"); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="Divider"></div>
    <?php include(dirname(__FILE__)."/../../includes/ads/txtimg_468x60.php") ?>
	<div>
 		<?php include("browsevideo.php"); ?>
	</div>
</div>