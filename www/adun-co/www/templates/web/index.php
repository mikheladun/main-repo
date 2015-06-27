<?php include("../includes/page.php") ?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"
	prefix="og: http://ogp.me/ns#">
<head>
<?php include("../title.php") ?>
<?php include("../meta.php") ?>
<?php include("../style.php") ?>
<?php include("../script.php") ?>
<script type="text/javascript" language="javascript">
		 window.addEvent('domready', function() {
		 	var myCookie = Cookie.read('imageload');
			if(myCookie != 'imageload') {
				var myImages = new Asset.images(
					[
						'/img/adunflux-bg-01.jpg'
					 ], 
					 {
						onComplete: function() {
							var myCookie  = Cookie.write('imageload', 'imageload', {duration: 1});
						}
				});
			}
		});
		</script>
</head>
<body>
	<div id="wrapper">
		<div id="masthead">
			<?php include("../masthead.php") ?>
		</div>
		<div id="container">
			<?php include("../content.php") ?>
		</div>
		<div id="footer">
			<?php include("../footer.php") ?>
		</div>
	</div>
</body>
</html>
