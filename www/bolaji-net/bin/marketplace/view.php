	<p>&nbsp;</p>
	<?php require_once("viewmain.php") ?>
	<p>&nbsp;</p>
	<?php
	 if(!isset($Count) || $Count <= 10) 
	 { 
		echo "<div class=\"ContentDiv\"><p class=\"SectionHeader\">Marketplace</p>";
		$Category = true; 
		require_once("category.php");
		echo "</div>";
	 }
	?>