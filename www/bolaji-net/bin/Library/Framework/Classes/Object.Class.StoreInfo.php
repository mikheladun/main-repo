<?php
class StoreInfo {
	var $StoreID;
	var $Name;
	var $Description;
	var $Url;
	var $Pic;
	var $Feature;
	
	function CategoryInfo() {
		$this->Clear();
	}

	// Clears all properties
	function Clear() {
		$this->StoreID = 0;
		$this->Name = '';
		$this->Description = '';
		$this->Url = '';
		$this->Pic = '';
		$this->Feature = 0;
	}

	function FormatPropertiesForDatabaseInput() {
		$this->Name = FormatStringForDatabaseInput($this->Name, 1);
		$this->Description = FormatStringForDatabaseInput($this->Description, 1);
	}
	
	function FormatPropertiesForDisplay() {
		$this->Name = FormatStringForDisplay($this->Name, 1);
		$this->Description = FormatStringForDisplay($this->Description, 1);
	}
	
	function GetPropertiesFromDataSet($DataSet) {
		$this->CategoryID = @$DataSet['storeid'];
		$this->Name = @$DataSet['name'];
		$this->Description = @$DataSet['description'];
		$this->Feature = @$DataSet['feature'];
		$this->Pic = @$DataSet['pic'];
		$this->Url = @$DataSet['url'];
	}	

	function GetPropertiesFromForm(&$Context) {
		$this->CategoryID = ForceIncomingInt('categoryid', 0);
		$this->Name = ForceIncomingString('name', '');
		$this->Description = ForceIncomingString('description', '');
		$this->ParentID = ForceIncomingInt('parentid', '');
		$this->ParentName = ForceIncomingString('parentname', '');
	}
}
?>