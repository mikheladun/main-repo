<?

	class RequestFeedbackHandler
	{
		 function _constructor()
		 {
		 }
		 function RequestFeedbackHandler()
		 {
			$this->_constructor();
		 }
		 function executeCommand(&$AppContext, &$Page)
		 {
			 //$Page->getParameter('submit')
			 $pagedata = array();
	
			 if($_REQUEST['submit'])
			 {
				$Submit = isset($_REQUEST['submit']) && !empty($_REQUEST['submit']) ? strtolower($_REQUEST['submit']) : '';

				$Service = $AppContext->ServiceRegistry->Lookup("Services");

				$Params->Name = $_REQUEST['name'];
				$Params->Email = $_REQUEST['email'];
				$Params->Message = $_REQUEST['message'];
				$pagedata['form'] = $Params;

				$Params->From = "sales@janatec.com";
				$Params->To = "Bolaji.net@gmail.com";
				$Params->Subject = "Message from janatec.com: $Params->Email";
				$Params->Body = "$Params->Name , ";
				$Params->Body .= "$Params->Email";
				$Params->Body .= "<br/></br/>$Params->Message";
				$Response = $Service->Execute(&$AppContext, "RequestFeedback", &$Params);

				if(!($Response->Success))
				{
					if(!empty($AppContext->ErrorMessage))
					{
						//$AppContext->AddErrorMessage('prompt','Fix the errors below and submit form again.');
					}
					else
					{
						$AppContext->AddErrorMessage('prompt', 'Message not sent. Please try again.');
					}
				}
				else
				{
					$Page->setRedirectUrl("/request/sent");
				}
			}

			$Page->setPageData($pagedata);
		  }
	}
?>