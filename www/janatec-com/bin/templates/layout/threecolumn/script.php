<script src="/script/mootools-1.2-core-nc.js" language="JavaScript" type="text/javascript"></script>
<script src="/script/mootools-1.2-more.js" language="JavaScript" type="text/javascript"></script>
<script src="/script/main.js" language="JavaScript" type="text/javascript"></script>
<?php
	$pagescript= $this->getProperty('script');
	if (isset($pagescript))
	{
		echo "<script src=\"$pagescript\" language=\"JavaScript\" type=\"text/javascript\"></script>";
	} 
?>