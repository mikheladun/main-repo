<?php
class Validation
{
 var $Context;
 var $InputName;
 var $isValid;
 var $isRequired;
 var $ValidationExpression;
 var $ValidationExpressionErrorMessage;
 var $Value;
 var $MaxLength;
 var $Registry;

 function _constructor($xml)
 {
 	//USE $AppContext->ServiceRegistry->Lookup("ServiceName");
	//$this->Registry = array();
	$validators = $xml->GetNodeByPath("APP/VALIDATORS");
	//print_r($validators);
	if(!empty($validators))
	{
		foreach($validators['child'] as $validator)
		{
			//print($validator['attrs']['NAME']);
			$this->Registry[ucfirst($validator['attrs']['NAME'])] = $validator['attrs']['CLASS'];
			//print $this->Registry[ucfirst($validator['attrs']['NAME'])];
		}
	}
 }

 function Validation($xml)
 {
 	$this->_constructor($xml);
 }

 function &Invoke($Validator, $AppContext, $Provider, $Params)
 {
 	if($this->Registry[$Validator])
	{
		$Class = $this->Registry[$Validator];
		require_once(dirname(__FILE__)."/../Classes/$Class.php");
		$ValidatorClass = substr($Class, strrpos($Class,'.')+1, strlen($Class));
		$Validator = new $ValidatorClass;
		$Validator->Validate(&$AppContext, &$Params);
		//call_user_func(array(&$Validator, "Validate$Provider"), &$AppContext, &$Params);
	}
	else
	{
		echo "Validator [$name] not registered";
		$AppContext->AddErrorMessage('Form_Err','Validator [$name] not registered');
	}
 }

 function Clear() {
	$this->InputName = 'Input';
	$this->isRequired = 0;
	$this->isValid = 1;
	$this->ValidationExpression = '';
	$this->MaxLength = 0;
	$this->Value = '';
 }

 // Compare the value of this input to the value of another input
 // Operator: [Equal|NotEqual|GreaterThan|GreaterThanEqualTo|LessThan|LessThanEqualTo]
 function CompareTo($InputToCompare, $Operator, $ErrorMessage) {
	switch($Operator) {
		case 'GreaterThan':
			if($InputToCompare->Value <= $this->Value) {
				$this->isValid = 0;
				$this->Context->WarningCollector->Add($ErrorMessage);
			}
			break;
		case 'GreaterThanEqualTo':
			if($InputToCompare->Value < $this->Value) {
				$this->isValid = 0;
				$this->Context->WarningCollector->Add($ErrorMessage);				
			}
			break;
		case 'LessThan':
			if($InputToCompare->Value >= $this->Value) {
				$this->isValid = 0;
				$this->Context->WarningCollector->Add($ErrorMessage);				
			}
			break;
		case 'LessThanEqualTo':
			if($InputToCompare->Value > $this->Value) {
				$this->isValid = 0;
				$this->Context->WarningCollector->Add($ErrorMessage);				
			}
			break;
		case 'NotEqual':
			if($InputToCompare->Value == $this->Value) {
				$this->isValid = 0;
				$this->Context->WarningCollector->Add($ErrorMessage);				
			}
			break;
		default:
			if($InputToCompare->Value != $this->Value) {
				$this->isValid = 0;
				$this->Context->WarningCollector->Add($ErrorMessage);				
			}
			break;
	}
 }
}
?>