<?php
	//ini_set('include_path', '/Projects/janatec/www/2009website');
	//ini_set('include_path', '/homepages/21/d184998836/htdocs/_janatec');
	ini_set('include_path', '/home/134209/domains/janatec.com/html');
	//ini_set('include_path', '/home/134209/corp/ost/apps/web');

	require_once("parlance/core/Framework.Core.ApplicationContext.php");
	require_once("parlance/core/Framework.Core.PagesController.php");
	$pageid = ForceString($_REQUEST['pid'], 'home');

	//echo "pid: ", $_REQUEST['pid'], "<br/>";
	//echo "pageid: ", $pageid, "<br/>";

	$pagecontroller = new PagesController();
	$pagecontroller->dispatch($AppContext, $pageid);
?>