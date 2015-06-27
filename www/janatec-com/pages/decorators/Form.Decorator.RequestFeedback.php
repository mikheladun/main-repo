<?
	require_once("parlance/extlibs/phpdomxml-0.9/lib.xml.inc.php");

	class RequestFeedbackDecorator
	{
		 function _constructor()
		 {
		 }
		 function RequestFeedbackDecorator()
		 {
			$this->_constructor();
		 }
		 function executeCommand(&$appcontext, &$form, $data, $content)
		 {
		 	$xml = new XML();
			$xml->parseXML($content);

			//getElementsByTagName, getElementById, createElement, createTextNode
			//$xml->getElementsByTagName("input");

		 	$formstate = $form->getFormState();
			//echo "formstate: $formstate";
			$postdata = $data["form"];

			//form is already submitted
			$this->decorateName($appcontext, $form, $data, $xml);
			$this->decorateEmail($appcontext, $form, $data, $xml);
			$this->decorateMessage($appcontext, $form, $data, $xml);

			$html = $xml->toString(1);
			//echo $html;
			$form->setContent($html);
			unset($xml);
		 }
 
		//name
		 function decorateName(&$appcontext, &$form, &$data, &$xml)
		 {
		 	$formstate = $form->getFormState();
		 	if($formstate == 1)
			{
				$name = $xml->firstChild->childNodes[0];
				$name->firstChild->nextSibling->setAttribute("value", FormatStringForDisplay($data["form"]->Name));
				//show error
				if(array_key_exists("Name", $appcontext->ErrorMessage))
				{
					$xml->firstChild->childNodes[0]->setAttribute("class", "error");
					$error = $xml->createElement('span');
					$error->setAttribute('class', 'error');
					$error->appendChild($xml->createTextNode("&nbsp;&nbsp;"  . $appcontext->ErrorMessage["Name"]));
					//echo $error->childNodes[0]->data;
					$xml->firstChild->childNodes[0]->insertBefore($error, $name->firstChild->nextSibling);
				}
			}
		}

		//email
		function decorateEmail(&$appcontext, &$form, &$data, &$xml)
		{
			//email
		 	$formstate = $form->getFormState();
		 	if($formstate == 1)
			{
				$email = $xml->firstChild->childNodes[1];
				$email->firstChild->nextSibling->setAttribute("value", FormatStringForDisplay($data["form"]->Email));
				//show error
				if(array_key_exists("Email", $appcontext->ErrorMessage))
				{
					$xml->firstChild->childNodes[1]->setAttribute("class", $email->getAttribute("class") . "error");
					$error = $xml->createElement('span');
					$error->setAttribute('class', 'error');
					$error->appendChild($xml->createTextNode("&nbsp;&nbsp;" . $appcontext->ErrorMessage["Email"]));
					//echo $error->childNodes[0]->data;
					$xml->firstChild->childNodes[1]->insertBefore($error, $email->firstChild->nextSibling);
				}
			}
		}

		//message
		function decorateMessage(&$appcontext, &$form, &$data, &$xml)
		{
		 	$formstate = $form->getFormState();
		 	if($formstate == 1)
			{
				$message = $xml->firstChild->childNodes[2];
				$textnode = $xml->createTextNode(FormatStringForDisplay($data["form"]->Message));
				$message->firstChild->nextSibling->appendChild($textnode);
				//show error
				if(array_key_exists("Message", $appcontext->ErrorMessage))
				{
					$xml->firstChild->childNodes[2]->setAttribute("class", $message->getAttribute("class") . "error");
					$error = $xml->createElement('span');
					$error->setAttribute('class', 'error');
					$error->appendChild($xml->createTextNode("&nbsp;&nbsp;"  . $appcontext->ErrorMessage["Message"]));
					//echo $error->childNodes[0]->data;
					$xml->firstChild->childNodes[2]->insertBefore($error, $message->firstChild->nextSibling);
				}
			}
		}
	}
?>