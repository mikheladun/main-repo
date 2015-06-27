<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once("../../skeleton/layout/title.php") ?>
<?php require_once("../../skeleton/layout/meta.php") ?>
<?php require_once("../../skeleton/layout/script.php") ?>
<?php require_once("../../skeleton/layout/style.php") ?>
<style type="text/css">
#MainContent{width:770px;}
.SectionHeader{background:none;color:#121212;padding:0;}
</style>
</head>
<body>
<div id="Wrapper">
  <?php require_once("../../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
      <div class="ContentDiv" style="margin-right:1em;">
	  	<?php  require_once("../subheader.php") ?>
		<div class="PaddedBox">
			<big><big>Contact us</big></big>
			<p>We offer a wide range of flexible services to meet your marketing needs. Contact one of our friendly sales people to find out more today!</p>
		</div>
		<div class="ContentDiv">
			<div class="FloatLeft" style="width:22%;">
				<?php require_once("../nav.php") ?>
			</div>
			<div class="FloatLeft" style="margin-top:1em;margin-left:.7em;width:35%;">
				<div class="PaddedBox">
					<p><strong>Standard Advertisements</strong></p>
					<p>These ad units are named after IAB standard units where possible and match the ones you'll find on our Insertion Orders.</p>
					<div style="height:100px;"></div>
				</div>
				<div class="Divider"></div>
				<div class="PaddedBox">
					<p><strong>Text Promo Modules</strong></p>
					<p>These are the same ad units as above, but with more detail about the text requirements depending on their location on the site.</p>
					<div style="height:100px;"></div>
				</div>
			</div>
			<div class="FloatLeft" style="margin-top:1em;margin-left:.7em;width:38%">
				<div class="PaddedBox">
					<p><strong>Rich Media Advertisements</strong></p>
					<p>Rich Media ads must be priced and scheduled with sales representative at time of Insertion Order creation.</p>
					<div style="height:100px;"></div>
				</div>
				<div class="Divider"></div>
				<div class="PaddedBox">
					<p><strong>Home Page Advertisements</strong></p>
					<p>These are the ad formats available on the Bolaji.net Front Page, including Rich Media formats</p>
					<div style="height:200px;"></div>
				</div>
				<div class="Divider"></div>
				<div class="PaddedBox">
					<p><strong>Sponsorships</strong></p>
					<p>These are the sponsorships and property-specific ad units.</p>
					<div style="height:100px;"></div>
				</div>
			</div>
			<div class="Spacer"></div>
		</div>
	   </div>
    </div>
  </div>
    <div id="BaseContent">
	  <div class="BaseContentDiv"></div>
    </div>
		<?php require_once("../../skeleton/layout/footer.php") ?>
  <div id="Skyscraper">
	<div class="AdContentDiv">
		<?php include(dirname(__FILE__)."/../../includes/ads/img_160x600.php") ?>
	</div>
  </div>
  <div class="Spacer" />
</div>
</body>
</html>