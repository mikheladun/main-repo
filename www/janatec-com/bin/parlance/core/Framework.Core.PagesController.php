<?php

	class PagesController
	{
		 function _constructor()
		 {
		 }
		 function PagesController()
		 {
			$this->_constructor();
		 }
		 function dispatch(&$appcontext, $pageid)
		 {
			$page = $appcontext->PagesRegistry->GetPage($pageid);
			if(isset($page))
			{
				$pagehandler = $page->getPageHandler();

				if(isset($pagehandler) && !empty($pagehandler)) 
				{
					require_once("pages/handlers/" . $pagehandler . ".php");

					$explodestr = explode('.',$pagehandler);
					$pagehandler = $explodestr[count($explodestr) - 1];
					$pagehandler .= "Handler";
					$pagehandler = new $pagehandler;
					$pagehandler->executeCommand($appcontext, $page);

					unset($pagehandler);
				}

				$redirecturl = $page->getRedirectUrl();
				if(isset($redirecturl) && !empty($redirecturl))
				{
					//echo "RedirectUrl: ", $page->getRedirectUrl();
					header("Location: " . $redirecturl);
					//$page->load($appcontext);
				}
				else
				{
					$page->load($appcontext);
				}
			}
			else
			{
				//TODO: load error page
			}
		 }
	}
?>