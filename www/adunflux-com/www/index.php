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
					var myImages = new Asset.images(['/www/img/adunflux-bg-01.jpg'], {
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
				<h1><a href="/"><img class="logo" src="/www/img/adunflux-logo-black.jpg" alt="adunflux" title="adunflux"></a></h1>
				<span><a href="/"><img src="/www/img/menu-icon.png" alt="menu" title="menu"></a></span>
			</div>
			<div id="container">
				<?php include($this->view) ?>
			</div>
			<div id="footer">
				<ul>
					<li><a target="_blank" href="http://twitter.com/share?count=horizontal&amp;original_referer=http%3a%2f%2fwww%2eadunflux%2ecom%2F&url%3dhttp%3a%2f%2fwww%2eadunflux%2ecom%2f"><img src="/www/img/footer-twitter.gif" alt="twitter" title="share on twitter"> </a></li>
					<li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.adunflux.com%2F"><img src="/www/img/footer-facebook.gif" alt="facebook" title="share on facebook"></a></li>
					<li><a target="_blank" href="https://plus.google.com/share?url=http://www.adunflux.com"><img src="/www/img/footer-google.gif" alt="google" title="share on google+"></a></li>
					<li>Share this site</li>
				</ul>
				<p>&copy; 2015 Adunflux Media Networks</p>
			</div>
		</div>
	</body>
</html>
