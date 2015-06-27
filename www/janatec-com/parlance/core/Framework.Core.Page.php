<?php
	require_once("Framework.Core.FormsProcessor.php");

	class Page 
	{
		 var $pageid;
		 var $pagetitle;
		 var $pagedata;
		 var $pageurl;
		 var $baseurl;
		 var $layout;
		 var $properties;
		 var $pagehandler;
		 var $redirecturl;
	
		 function Page()
		 {
			$this->_constructor();
		 }
		 function _constructor()
		 {
			$this->pageid = '';
			$this->pagetitle = '';
			$this->pagedata = array();
			$this->pageurl = '';
			$this->baseurl = '';
			$this->layout = '';
			$this->styledefinition = '';
			$this->scriptfile = '';
			$this->properties = array();
			$this->pagehandler = '';
			$this->redirecturl = '';
		 }
		 function form(&$appcontext, $formid)
		 {
			$formsprocessor = new FormsProcessor();
			$formsprocessor->process($appcontext, $formid, $this->getPageData());
		 }
		 function load(&$appcontext)
		 {
			$pagelayout = $this->getPageLayout();
			//TODO: $pagetemplate = $AppContext->PageTemplates->GetTemplate($pagelayout);
			$pagetemplate = "templates/layout/" . $pagelayout . "/template.php";
	
			$pagedata = $this->getPageData(); 
	
			include($pagetemplate);
		 }
		 function setPageId($pageid)
		 {
			$this->pageid = $pageid;
		 }
		 function getPageId()
		 {
			return $this->pageid;
		 }
		 function setPageTitle($pagetitle)
		 {
		  $this->pagetitle = $pagetitle;
		 }
		 function getPageTitle()
		 {
		  return $this->pagetitle;
		 }
		 function setPageData($pagedata)
		 {
		  $this->pagedata = $pagedata;
		 }
		 function getPageData()
		 {
		  return $this->pagedata;
		 }
		 function setPageUrl($pageurl)
		 {
		  $this->pageurl = $pageurl;
		 }
		 function getPageUrl()
		 {
		  return $this->pageurl;
		 }
		 function setBaseUrl($baseurl)
		 {
		  $this->baseurl = $baseurl;
		 }
		 function getBaseUrl()
		 {
		  return $this->baseurl;
		 }
		 function setPageLayout($pagelayout)
		 {
		  $this->pagelayout = $pagelayout;
		 }
		 function getPageLayout()
		 {
		  return $this->pagelayout;
		 }
		function setProperty($key, $value)
		{
			$this->properties[$key] = $value;
		}
		function getProperty($key)
		{
			return $this->properties[$key];
		}
		function setPageHandler($pagehandler)
		{
			$this->pagehandler = $pagehandler;
		}
		function getPageHandler()
		{
			return $this->pagehandler;
		}
		function setRedirectUrl($redirecturl)
		{
			$this->redirecturl = $redirecturl;
		}
		function getRedirectUrl()
		{
			return $this->redirecturl;
		}
	}
?>