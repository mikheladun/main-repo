<?php

require_once(dirname(__FILE__)."/../core/Framework.Class.Validation.php");
require_once(dirname(__FILE__)."/../core/Framework.ValidationUtils.php");
require_once(dirname(__FILE__)."/../core/Framework.Utils.php");

class DefaultValidator
{
 function &Validate(&$AppContext, &$Params)
 {
	Validate($AppContext, 'Name', true, $Params->Name, 0, 100, '');
	Validate($AppContext, 'Email', true, $Params->Email, -1, -1, '^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$');
	Validate($AppContext, 'Comment', true, $Params->Comment, -1, -1, '');
 }
}
?>