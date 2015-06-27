<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../skeleton/layout/style.php") ?>
<style type="text/css">
A.BluTxt{font-weight:normal;}
Td.j{margin:0;padding:0 0 .5em 0;}
Table Td Img{margin-top:1em;padding-top:1em;}
.Playlist Td{padding-top:1.5em;padding-left:.5em;}
.Playlist Td H3 A{font-size:100%;font-weight:bolder;}
</style>
<script type="text/javascript" language="javascript">
window.addEvent('domready', function(){
	//Enable tab browsing function
	$$('#TabDiv2 .MPlayerTabs Li').each(
		function(elem) {
			elem.addEvent('click',
			  function(){
				$$('#TabDiv2 .MPlayerTabs Li.Current').each(function(elem){elem.removeClass('Current')});
				$$('#TabDiv2 .PortalDivContent .Current').each(function(elem){Css(elem.getProperty('id'),'ContentDiv')});
				elem.addClass("Current");
				Css(elem.getProperty('id') + 'Div','PaddedBox Current');
			 }
		)}
	);

	//Make Google news links open in new window
	$$('Td.j A').each(
		function(elem) {
			elem.setProperty('target','_blank');
		}
	);
});
</script>
</head>
<body>
<div id="Wrapper">
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="MainContent">
    </div>
    <div id="BaseContent">
      <div class="MainContentDiv">
        <?php require("allnews.php") ?>
        <?php include(dirname(__FILE__)."/../includes/ads/txtimg_468x60.php") ?>
      </div>
      <div class="RightContentDiv">
        <?php require("resources.php") ?>
		<div class="Divider"></div>
        <?php include("ads/topright.php") ?>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
      </div>
      <div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>
