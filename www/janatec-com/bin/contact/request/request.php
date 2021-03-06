<?php 
	if($_REQUEST['submit'])
	{
		$Submit = isset($_REQUEST['submit']) && !empty($_REQUEST['submit']) ? strtolower($_REQUEST['submit']) : '';

		require_once(dirname(__FILE__)."/../../parlance/framework/core/Framework.Class.ApplicationContext.php");
		$Service = $AppContext->ServiceRegistry->Lookup("Services");
		$Params->Name = $_REQUEST['name'];
		$Params->Email = $_REQUEST['email'];
		$Params->Request = $_REQUEST['request'];

		$Params->From = "sales@janatec.com";
		$Params->To = "Bolaji.net@gmail.com";
		$Params->Subject = "Service Request: $Params->From, $Params->Email";
		$Params->Body = "Name: $Params->Name<br/>";
		$Params->Body .= "Email: $Params->Email";
		$Params->Body .= "<br/>$Params->Subject<br/></br/>$Params->Request";
		$Response = $Service->Execute(&$AppContext, "RequestServices", &$Params);

		if($Response->Success)
		{
			$Message = "Thank you for your request.";
		}
		else 
		{
			$Message = "Unable to deliver your request. Please try again.";
		}
	}
	else
	{
		$Message = "Unable to deliver your request. Please try again.";
	}

	echo $Message;
?>