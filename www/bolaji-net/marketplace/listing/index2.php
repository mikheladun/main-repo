<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<?php require_once(dirname(__FILE__)."/../../skeleton/layout/script.php") ?>
<script src="/script/Stickman.MultiUpload.js"></script>
<script type="text/javascript">
	window.addEvent('domready', function(){
		if($('MktplcForm'))
		{
			// Use defaults: no limit, use default element name suffix, don't remove path from file name
			//new MultiUpload( $( 'MktplcForm' ).defaults );
			// Max 3 files, use '[{id}]' as element name suffix, remove path from file name, remove extra elemen
			new MultiUpload( $( 'MktplcForm' ).uploadfile, 4, '[{id}]', true, true );
		}
	});
</script>
</head>

<body>
		 <form id="MktplcForm" name="MktplcForm" action="/marketplace/listing/" method="post" enctype="multipart/form-data">
				<input type="file" name="uploadfile" />
				<input type="submit" class="Button" name="submit" value="Next" />
		 </form>
</body>
</html>
