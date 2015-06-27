<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/title.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/meta.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/script.php") ?>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/style.php") ?>
<link rel="stylesheet" type="text/css" media="screen" href="/style/Stickman.MultiUpload.css" />
<style type="text/css">
Form .Mktplc Ol,Form .Mktplc Ul{margin:0;padding:0;margin-left:1.5em;}
Form .Mktplc Li,Form .Mktplc Dd Li{padding:0;margin:0;background:none;font-size:95%;font-weight:normal;}
</style>
<script src="/script/Stickman.MultiUpload.js"></script>
<script type="text/javascript">
	window.addEvent('domready', function(){
		var PicViewer = new Fx.Scroll($('PicViewer'));
		if($('PicViewer') && $('PicViewL') && $('PicViewR'))
		{
			$('PicViewL').addEvent('click', function(){
				PicViewer.scrollTo($('PicViewer').getSize()['scroll'].x-415,0);
				$('PicViewerC').setText(Math.max(parseInt($('PicViewerC').getText())-1,1));
			});
			$('PicViewR').addEvent('click', function(){
				PicViewer.scrollTo($('PicViewer').getSize()['scroll'].x+415,0);
				$('PicViewerC').setText(Math.min(parseInt($('PicViewerC').getText())+1,parseInt($('PicViewerT').getValue())));
			});
		}
		if($('MktplcForm'))
		{
			// Use defaults: no limit, use default element name suffix, don't remove path from file name
			//new MultiUpload( $( 'MktplcForm' ).defaults );
			// Max 3 files, use '[{id}]' as element name suffix, remove path from file name, remove extra elemen
			new MultiUpload( $( 'MktplcForm' ).uploadfile, 4, '[{id}]', false, true );
		}
	});
</script>
</head>
<body>
<div id="Wrapper">
  <?php require(dirname(__FILE__)."/../../skeleton/layout/top.php") ?>
  <div id="Container">
    <div id="BaseContent">
		<div class="MainContentDiv">
			 <?php require(dirname(__FILE__)."/listing.php") ?>
			<div class="BaseContentDiv">
			 <?php require(dirname(__FILE__)."/../ads.php") ?>
			 </div>
		</div>
		<div class="RightContentDiv">
			<div style="height:800px;"></div>
		</div>
		<div class="Spacer"></div>
    </div>
  </div>
  <?php require_once(dirname(__FILE__)."/../../skeleton/layout/footer.php") ?>
  <div class="Spacer" />
</div>
</body>
</html>