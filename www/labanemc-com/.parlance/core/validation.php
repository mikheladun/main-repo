<?php
 function &Validate(&$AppContext, $InputName, $IsRequired, $Value, $MinLength, $MaxLength, $ValidationExpression, $ErrorMessage=false)
 {
 	$isValid = 1;
	// If a regexp was supplied, attempt to validate on it (empty strings allowed)
	if($ValidationExpression != '' && $Value != '') {
		if(!eregi($ValidationExpression, $Value)) {
			$isValid = 0;
			$AppContext->AddErrorMessage($InputName, $ErrorMessage === false ? str_replace('//1', $InputName, "//1 is not valid") : $ErrorMessage);
		}
	}
	// If the value is required, ensure it's not empty
	if($IsRequired) {
		$ForcedValue = ForceString($Value, '');
		if ($ForcedValue == '') {
			$isValid = 0;
			$AppContext->AddErrorMessage($InputName, $ErrorMessage === false ? str_replace('//1', $InputName, "//1 is a required field") : $ErrorMessage);/*$this->Context->GetDefinition('ErrRequiredInput')*/
		}
	}
	// Ensure the value is not too long if maxlength is specified
	if (($MaxLength > 0) && (strlen($Value) > $MaxLength)) {
		$CharsToLong = (strlen($Value) - $MaxLength);
		$isValid = 0;
		$AppContext->AddErrorMessage($InputName, $ErrorMessage === false ? str_replace(array('//1', '//2'), array($InputName, $CharsToLong), "//1 exceeds $MaxLength characters") : $ErrorMessage);/*$this->Context->GetDefinition('ErrInputLength')*/
	}
	// Ensure the value is not too short if minlength is specified
	if (($MinLength > 0) && (strlen($Value) < $MinLength)) {
		$CharsToShort = (strlen($Value) - $MaxLength);
		$isValid = 0;
		$AppContext->AddErrorMessage($InputName, $ErrorMessage === false ? str_replace(array('//1', '//2'), array($InputName, $CharsToShort), "//1 less than $MinLength characters") : $ErrorMessage);/*$this->Context->GetDefinition('ErrInputLength')*/
	}

	return $isValid;
 }
?>