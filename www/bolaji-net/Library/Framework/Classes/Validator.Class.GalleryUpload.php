<?php

require_once(dirname(__FILE__)."/../Core/Framework.Class.Validation.php");
require_once(dirname(__FILE__)."/../Core/Framework.ValidationUtils.php");
require_once(dirname(__FILE__)."/../Core/Framework.Utils.php");

class GalleryUpload
{
 function &Validate(&$AppContext, &$Params)
 {
 	switch($Params->Step)
	{
		case 1 :
			Validate($AppContext, 'Name', true, $Params->Name, 0, 100, '');
			Validate($AppContext, 'Email', true, $Params->Email, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');

			if(!$Params->AcceptTerms)
			{
				$AppContext->AddErrorMessage('Terms','Agreement is required.');
			}
			if(!isset($Params->Photos) || empty($Params->Photos))
			{
				$AppContext->AddErrorMessage('Photos', 'Select photos to upload and try again.<br/><br/>');
			}

			break;

		case 2	:
			Validate($AppContext, 'STitle', false, $Params->SetTitle, -1, -1, '');
			Validate($AppContext, 'SDescription', false, $Params->SetDescription, -1, -1, '');

			if(isset($Params->SetDescription) && !empty($Params->SetDescription))
			{
				Validate($AppContext, 'STitle', true, $Params->SetTitle, -1, -1, '');
			}

			$Index = 1;
			foreach($Params->Images as $Image)
			{
				Validate($AppContext, 'Title'.$Index, true, $Params->Title[$Index - 1], -1, -1, '');
				Validate($AppContext, 'Description'.$Index, true, $Params->Description[$Index - 1], -1, -1, '');

				$Index++;
			}

			break;

		default	:
			$AppContext->AddErrorMessage('Form_Err','');
	}
 }
}
?>