<?php include("includes/page.php") ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<?php include("title.php") ?>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta http-equiv="Cache-Control" content="no-cache" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="-1" />
		<link rel="shortcut icon" href="/favicon.ico" />
		<?php include("style.php") ?>
		<?php include("script.php") ?>
		<script type="text/javascript" language="javascript">
		 window.addEvent('domready', function() {
		 	var myCookie = Cookie.read('imageload');
			if(myCookie != 'imageload') {
				var myImages = new Asset.images(
					[
						'/images/1041770_64537003.jpg',
						'/images/1134633_90541090.jpg',
						'/images/447216_75964208.jpg',
						'/images/1088956_62367415.jpg'
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
			<div id="container">
				<div id="content">
					<div id="sidebar">
						<?php include("sidebar.php") ?>
					</div>
					<div id="menu">
					<?php include("menu.php") ?>
					</div>
					<div id="maincontent">
					<?php include("content.php") ?>
					</div>
					<div class="spacer"></div>
				</div>
			</div>
			<div id="footer">
			<?php include("footer.php") ?>
			</div>
		</div>
	</body>
</html>