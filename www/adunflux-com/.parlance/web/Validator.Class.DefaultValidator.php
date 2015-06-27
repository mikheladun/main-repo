<?php

require_once("parlance/core/Framework.Core.Validation.php");
require_once("parlance/core/Framework.Utils.ValidationUtils.php");
require_once("parlance/core/Framework.Utils.php");

class DefaultValidator
{
	function &Validate(&$AppContext, &$Params)
	{
		Validate($AppContext, 'Directory', true, $Params->Directory, 0, 100, '','Enter a directory');
		Validate($AppContext, 'Artist', false, $Params->ArtistName, -1, -1, '','Enter artist name');
	}
}
?>