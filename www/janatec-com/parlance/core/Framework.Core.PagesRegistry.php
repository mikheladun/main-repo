<?php
	require_once("Framework.Core.Page.php");
	require_once("Framework.Core.Page.Form.php");

	class PagesRegistry
	{
	 var $registry;
	 var $handlers;
	
	 function _constructor($xml)
	 {
		$pagehandlers = $xml->GetNodeByPath("APP/PAGEHANDLERS");
		if(isset($pagehandlers) && !empty($pagehandlers)) 
		{
			if(isset($pagehandlers['child']) && !empty($pagehandlers['child']))
			{
				$this->handlers = array();
				foreach($pagehandlers['child'] as $pagehandler)
				{
					$this->handlers[$pagehandler['attrs']['CLASS']] = $pagehandler['attrs']['PAGEID'];
				}
	
				//print_r($this->handlers);
			}
		}
	
		$pages = $xml->GetNodeByPath("APP/PAGES");
		if(isset($pages['child']))
		{
		 $this->registry = array();
		  foreach($pages['child'] as $page)
		  {
			$this->registry[$page['attrs']['ID']] = $page;
			//print_r($page['attrs']['ID']);
			//echo "<br/>";
		  }
		}
	 }
	 function PagesRegistry($xml)
	 {
		$this->_constructor($xml);
	 }
	 function &GetForm($formid)
	 {
	 	$form = new Form();
		$form->setFormId($formid);
		$form->setDecorator("Form.Decorator.RequestFeedback");

		return $form;
	 }
	 function &GetPage($pageid)
	 {
		$page = null;
		if($this->registry[$pageid])
		{
			$pagedef = $this->registry[$pageid];
			$baseurl = $pagedef['attrs']['BASEURL'];
			$url = $pagedef['attrs']['URL'];
			$pageurl = $baseurl . "/" . $url . ".php";
			$pageurl = ini_get("include_path") . $pageurl;
	
			if(file_exists($pageurl))
			{
				$page = new Page();
				$page->setPageId($pagedef['attrs']['ID']);
				$page->setBaseUrl($pagedef['attrs']['BASEURL']);
				$page->setPageUrl($pageurl);
	
				$pagelayout = $pagdef['attrs']['layout'];
				//TODO: ApplicationContext->PageTemplates->GetDefault
				$pagelayout = ForceString($layout, 'threecolumn');
				$page->setPageLayout($pagelayout);
	
				//page handler
				if(isset($this->handlers) && !empty($this->handlers))
				{
					foreach($this->handlers as $class => $pageid)
					{
						//echo $page->getPageId(), " => $pageid => $class<br/>";
	
						//escape special characters, '.' = '\..';
						$pageid = str_replace('.', '\..', $pageid);
						//echo "$pageid<br/>";
						if(eregi($pageid, $page->getPageId()))
						{
							//echo "MATCH FOUND<br/>";
							$page->setPageHandler($class);
						}
					}
				}
	
				//page properties
				//TODO: use GetNodeByPath
				$configs = $pagedef['child'];
				if(isset($configs))
				{
					foreach($configs as $cfg)
					{
						//echo $cfg['name'];
						//echo $cfg['child'];
						$property = $cfg['child'];
						if(isset($property))
						{
							foreach($property as $prop)
							{
								//echo "<br/>";print_r($prop['attrs']);
								$propname = $prop['attrs']['NAME'];
								$propvalue = $prop['attrs']['VALUE'];
								$page->setProperty($propname ,$propvalue);
			
								if($propname == 'title')
								{
									$page->setPageTitle($propvalue);
								}
							}
						}
					}
				}
			}
			else
			{
				echo("<br/><font color=\"red\">Page [$pageurl] not found</font>");
			}
		}
		else 
		{
			 echo("<br/><font color=\"red\">Page [$id] not registered</font>");
		}
	
		return $page;
	 }
	}
?>