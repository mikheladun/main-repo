<link rel="stylesheet" href="/style/style.css" type="text/css" media="all" />
<?php
	$pagestyle= $this->getProperty('style');
	if (isset($pagestyle))
	{
		echo "\t\t<link rel=\"stylesheet\" href=\"$pagestyle\" type=\"text/css\" media=\"all\" />\n";
	} 
?>
		<style type="text/css">
		  html {
<?php
	echo "\t\t\t  ";
	if(preg_match('/solutionsfor*/i', $this->getPageId())) {
			echo "background:url('/images/1041770_64537003.jpg') 0% 20%;";
	}
	else if(preg_match('/whatwedo*/i', $this->getPageId())) {
			echo "background:url('/images/1134633_90541090.jpg') 30% 5%;";
	}
	else if(preg_match('/ourwork*/i', $this->getPageId())) {
			echo "background:url('/images/447216_75964208.jpg') 100% 6%;";
	}
	else if(preg_match('/whoweare*/i', $this->getPageId())) {
			//echo "background:url('/images/342948_7920.jpg') 100% 45%;";
			echo "background:url('/images/447216_75964208.jpg') 100% 15%;";
	}
	else{
			echo "background:url('/images/1088956_62367415.jpg') 90% -13%;";
	}
	
	echo "\n\t\t\t  background-repeat:no-repeat;";
	echo "\n\t\t\t  background-color:#313132;\n";
?>
		  }
		</style>