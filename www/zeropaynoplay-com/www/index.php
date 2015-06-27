<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" prefix="og: http://ogp.me/ns#">
	<head>
		<title><?=$this->title?></title>
		<meta http-equiv="content-type" content="<?= $this->meta['content-type'] ?>" />
		<meta http-equiv="cache-control" content="<?= $this->meta['cache-control'] ?>" />
		<meta http-equiv="pragma" content="<?= $this->meta['pragma'] ?>" />
		<meta http-equiv="expires" content="<?= $this->meta['expires'] ?>" />

		<meta name="description" content="<?= $this->meta['description'] ?>" />
		<meta name="keywords" content="<?= $this->meta['keywords'] ?>" />
		<meta name="viewport" content="<?= $this->meta['viewport'] ?>">

		<!-- begin extra meta tag -->
		<meta property="og:title" content="<?= $this->meta['ogp:title'] ?>">
		<meta property="og:type" content="<?= $this->meta['ogp:type'] ?>">
		<meta property="og:url" content="<?= $this->meta['ogp:url'] ?>">
		<meta property="og:image" content="<?= $this->meta['ogp:image'] ?>">
		<meta property="og:site_name" content="<?= $this->meta['ogp:site'] ?>">
		<meta property="og:description" content="<?= $this->meta['ogp:description'] ?>">
		<!-- end extra meta tag -->

		<link rel="shortcut icon" href="/favicon.ico" />

		<link rel="stylesheet" href="/www/css/style.css" type="text/css" media="all" />
		<?php if(isset($this->props['css'])) : ?>
		<link rel="stylesheet" href="/www<?=$this->props['css'] ?>" type="text/css" media="all" />
		<?php endif; ?>

		<script src="/www/js/mootools-1.2-core-nc.js" language="JavaScript" type="text/javascript"></script>
		<script src="/www/js/mootools-1.2-more.js" language="JavaScript" type="text/javascript"></script>
		<script src="/www/js/main.js" language="JavaScript" type="text/javascript"></script>
		<?php if(isset($this->props['js'])) : ?>
		<script src="/www<?=$this->props['js'] ?>" language="JavaScript" type="text/javascript"></script>
		<?php endif; ?>

		<script type="text/javascript" language="javascript">
			 window.addEvent('domready', function() {
			 	var myCookie = Cookie.read('imageload');
				if(myCookie != 'imageload') {
					var myImages = new Asset.images(['/www/img/khelcorp-bg-01.jpg'], {
							onComplete: function() {
								var myCookie  = Cookie.write('imageload', 'imageload', {duration: 1});
							}
					});
				}
			});
		</script>
		<style type="text/css">
		    #masthead{height:75px !important;}
			#masthead span{display:none;visibility:hidden;}
			#masthead h1{margin:.75em 0 0 0 !important;color:#fff !important;float:none !important;text-align:center;font-weight:800;font-size:200%;}
			#container{position:relative;height:100%;margin-top:-5em;}
			#container .container:first-child{background-image:none;background-color:#fff;color:#333;}
			.container .contentdiv{background-color:#fff !important;margin-bottom:5em;}
			.container .contentdiv p{color:#333;font-size:16px;font-weight:100;margin:0em 1.5em 1.5em 1.5em !important;padding:0;letter-spacing:0.08em;text-align:center;}
			.container .contentdiv p:last-child{padding:0 2em;}
			.container .contentdiv h2{clear:both;float:none;width:100% !important;font-size:18px;text-align:center !important;font-weight:600;padding:0;margin:0;}
			.container .contentdiv h2:first-child{margin-top:2em;}
			#footer{position:absolute;padding:0;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="masthead">
				<h1>ZEROPAY NOPLAY</h1>
			</div>
			<div id="container">
				<?php include($this->view) ?>
			</div>
			<div id="footer">
				<ul>
					<li>&nbsp;</li>
				</ul>
				<p>&copy; 2015 ZeroPayNoPlay.com</p>
			</div>
		</div>
	</body>
</html>
