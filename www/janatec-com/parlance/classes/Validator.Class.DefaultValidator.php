<?php

	require_once("parlance/core/Framework.Core.Validation.php");
	require_once("parlance/core/Framework.Utils.ValidationUtils.php");
	require_once("parlance/core/Framework.Utils.php");
	
	class DefaultValidator
	{
		 function &Validate(&$AppContext, &$Params)
		 {
				Validate($AppContext, 'Name', true, $Params->Name, 0, 100, '','Enter a name');
				Validate($AppContext, 'Email', true, $Params->Email, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$','Enter a valid email address');
				Validate($AppContext, 'Message', true, $Params->Message, -1, -1, '','Enter a message');
		 }
	}
?>