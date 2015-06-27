<?
	require_once("parlance/core/Framework.Core.FormsParser.php");
	require_once("parlance/extlibs/simplexml/simplexml.class.php");

	class FormsProcessor
	{
		var $parser;

		 function FormsProcessor()
		 {
			$this->_constructor();
		 }
		 function _constructor()
		 {
			//$this->parser = & new FormsParser();
		 }
		 function process(&$appcontext, $formid, $data)
		 {
			$form = $appcontext->PagesRegistry->GetForm($formid);
			$formurl = "pages/" . $formid . ".php";
			if(file_exists($formurl))
			{
				$filecontent = file_get_contents($formurl, true);
				$form->setContent($filecontent);

				$formdecorator = $form->getDecorator();

				if(isset($formdecorator) && !empty($formdecorator)) 
				{
					require_once("pages/decorators/" . $formdecorator . ".php");

					$explodestr = explode('.',$formdecorator);
					$formdecorator = $explodestr[count($explodestr) - 1];
					$formdecorator .= "Decorator";
					$formdecorator = new $formdecorator;
					$formdecorator->executeCommand($appcontext, $form, $data, $filecontent);

					unset($formdecorator);
				}

				$form->view();
/**
				$this->parser->Parse($formurl);
				$form  = $this->parser->GetNodeByPath("form");

				echo "<br/>form: ";
				print_r($form);

				echo "formid: ", $this->formid, "<br/>";
				echo $formurl;

				$sxml = new simplexml;
				$form = $sxml->xml_load_file($formurl);

				$formattr = $form->attributes();
				$formattr->action = '/request/send';
				print_r($formattr);

				//require($formurl);

				echo "<pre>";
				print_r($form); 
				echo "</pre>";
**/
			}
		 }
	}
?>