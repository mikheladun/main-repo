<?php

require_once(dirname(__FILE__)."/../Core/Framework.Class.Validation.php");
require_once(dirname(__FILE__)."/../Core/Framework.ValidationUtils.php");
require_once(dirname(__FILE__)."/../Core/Framework.Utils.php");

class DefaultValidator
{
 function &Validate(&$AppContext, &$Params)
 {
	Validate($AppContext, 'Name', true, $Params->Name, 0, 100, '');
	Validate($AppContext, 'Email', true, $Params->Email, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');
	Validate($AppContext, 'Comment', true, $Params->Comment, -1, -1, '');
 }

 function &ValidateMarketplaceInfo(&$AppContext, &$Params)
 {
 	switch($Params->Step)
	{
		case 1 :
			Validate($AppContext, 'Name', true, $Params->Name, -1, -1, '');
			Validate($AppContext, 'Email', true, $Params->Email, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');///^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
			//Validate($AppContext, 'Verification', true, $Params->VerificationKey, -1, -1, '');
			//if(!PhpCaptcha::Validate($Params->VerificationKey))
			//{
			//	$AppContext->AddErrorMessage('Verification','You entered the wrong security code.');
			//}
			if(!$Params->AcceptTerms)
			{
				$AppContext->AddErrorMessage('Terms','Agreement is required.');
			}
			break;

		case 2 :
			break;

		case 3	:
			break;

		default	:
			$AppContext->AddErrorMessage('Form_Err','');
	}
 }
 function &ValidateCreateNewDiscussion(&$AppContext, &$Params)
 {
	//Validate($AppContext, 'RealName', true, $Params->RealName, -1, -1, '');
	//Validate($AppContext, 'EmailAddress', true, $Params->EmailAddress, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');
	Validate($AppContext, 'Topic', true, $Params->CategoryID, -1, -1, '');
	Validate($AppContext, 'Title', true, $Params->Title, -1, -1, '');
	Validate($AppContext, 'Description', true, $Params->Body, -1, -1, '');
 }
 function &ValidateUpdateProfile(&$AppContext, &$Params)
 {
 	Validate($AppContext, 'RealName', true, $Params->FullName, -1, -1, '');
 	Validate($AppContext, 'EmailAddress', true, $Params->Email, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');///^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
 	Validate($AppContext, 'Location', false, $Params->Location, -1, -1, '');
 	Validate($AppContext, 'BirthDay', false, $Params->BirthDay, -1, -1, '');
 	Validate($AppContext, 'BirthMonth', false, $Params->BirthMonth, -1, -1, '');
 	Validate($AppContext, 'BirthYear', false, $Params->BirthYear, -1, -1, '');
 	Validate($AppContext, 'InstantMessengerScreenName', false, $Params->InstantMessengerScreenName, -1, -1, '');
	if(isset($AppContext->ErrorMessage['BirthMonth']) || isset($AppContext->ErrorMessage['BirthDay']) || isset($AppContext->ErrorMessage['BirthYear']))
	{
		$AppContext->AddErrorMessage('BirthDate', 'Sorry - you have entered an invalid birth date');
	}
 	Validate($AppContext, 'Website', false, $Params->Website, -1, -1, '');
 	Validate($AppContext, 'AboutMe', false, $Params->AboutMe, -1, -1, '');
 }
 function &ValidateRegisterUser(&$AppContext, &$Params)
 {
 	Validate($AppContext, 'MemberName', true, $Params->Name, 4, 15, '');
 	Validate($AppContext, 'RealName', true, $Params->RealName, -1, -1, '');
 	Validate($AppContext, 'ShowRealName', false, $Params->ShowRealName, -1, -1, '');
 	Validate($AppContext, 'EmailAddress', true, $Params->EmailAddress, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');///^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
 	Validate($AppContext, 'Password', true, $Params->Password, 6, -1, '');
	if(isset($Params->Password) && isset($Params->RetypePassword) && ($Params->Password != $Params->RetypePassword))
	{
		$AppContext->AddErrorMessage('Password', 'Passwords not identical.');
		$AppContext->AddErrorMessage('RetypePassword', 'Passwords not identical.');
	}
 	//Validate($AppContext, 'Verification', true, $Params->VerificationKey, -1, -1, '');
	//if(!PhpCaptcha::Validate($Params->VerificationKey))
	//{
	//	$AppContext->AddErrorMessage('Verification','You entered the wrong security code.');
	//}
	if(!$Params->AcceptTerms)
	{
		$AppContext->AddErrorMessage('AcceptTerms','Accept terms of use to complete your registration.');
	}

	if(empty($AppContext->ErrorMessage))
	{
		$Service = $AppContext->ServiceRegistry->Lookup("UserProfile");
		$Response = $Service->Execute($AppContext, "UserID", $Params);
		if(isset($Response))
		{
			$AppContext->AddErrorMessage("MemberName", "MemberName is already in use.");
		}
	}
 }
}
?>