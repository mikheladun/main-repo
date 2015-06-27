<?php

require_once(dirname(__FILE__)."/../Core/Framework.Class.Validation.php");
require_once(dirname(__FILE__)."/../Core/Framework.ValidationUtils.php");
require_once(dirname(__FILE__)."/../Core/Framework.Utils.php");

class MarketplaceListing
{
 function &Validate(&$AppContext, &$Params)
 {
 	switch($Params->Step)
	{
		case 1 :
			Validate($AppContext, 'Name', true, $Params->Name, 0, 100, '');
			Validate($AppContext, 'Email', true, $Params->Email, 0, 100, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');///^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
			//Validate($AppContext, 'Verification', true, $Params->VerificationKey, 0, 5, '');

			//if(!isset($AppContext->Session->Captcha) || strtoupper($Params->VerificationKey) != strtoupper($AppContext->Session->Captcha))
			//{
			//	$AppContext->AddErrorMessage('Verification','You entered the wrong security code.');
			//}
			if(!$Params->AcceptTerms)
			{
				$AppContext->AddErrorMessage('Terms','Agreement is required.');
			}
			Validate($AppContext, 'Title', true, $Params->Title, 0, 100, '');
			Validate($AppContext, 'Category', true, $Params->Category, -1, -1, '');
			Validate($AppContext, 'Description', true, $Params->Description, -1, -1, '');

			//valiate pictures
			break;

		case 2	:
			break;

		default	:
			$AppContext->AddErrorMessage('Form_Err','');
	}
 }
}
?>