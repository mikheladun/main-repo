<?php 
	require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Utils.php");
	if($_REQUEST['submit'])
	{
		$Submit = isset($_REQUEST['submit']) && !empty($_REQUEST['submit']) ? strtolower($_REQUEST['submit']) : '';

		require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
		$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.VIDEO"]);
		if($Submit == 'send')
		{
			$Params->Name = $_REQUEST['name'];
			$Params->Email = $_REQUEST['email'];
			$Params->Comment = $_REQUEST['comment'];
			$Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.USER"]);
			list($Params->Firstname, $Params->Lastname) = explode(" ",$Params->Name);

			$Response = $Service->Execute(&$AppContext, "ValidateUserFeedback", $Params);
			if($Response->Success)
			{
				$Response = $Service->Execute(&$AppContext, "SaveIfNotExistsUserInfo", $Params);
				if($Response->Success)
				{
					$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
					$Params->Userid = $ObjectID->ID;

					$Response = $Service->Execute(&$AppContext, "SaveUserFeedback", $Params);
					if($Response->Success)
					{
						$ObjectID = !isset($Response->Object[0]) ? $Response->Object : $Response->Object[0];
	
						$AppContext->Message['FeedbackForm_Msg'] = "Feedback sent.";

						$Params->Name = '';
						$Params->Email = '';
						$Params->Comment = '';
						$_REQUEST['name'] = NULL;
						$_REQUEST['email'] = NULL;
						$_REQUEST['comment'] = NULL;
					}
				}
			}
		}
	}

	require_once("form.php");
?>