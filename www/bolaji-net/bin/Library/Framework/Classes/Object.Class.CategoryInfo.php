<?php
class CategoryInfo {
	var $CategoryID;
	var $Name;
	var $MameID;
	var $Description;
	var $ParentID; 
	var $ParentName;
	var $ParentNameID; 
	
	function CategoryInfo() {
		$this->Clear();
	}
	
	// Clears all properties
	function Clear() {
		$this->CategoryID = 0;
		$this->Name = '';
		$this->NameID = '';
		$this->Description = '';
		$this->ParentID = 0;
		$this->ParentName = '';
		$this->ParentNameID = '';
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
		$this->CategoryID = @$DataSet['categoryid'];
		$this->Name = @$DataSet['name'];
		$this->NameID = @$DataSet['nameid'];
		$this->Description = @$DataSet['description'];
		$this->ParentID = @$DataSet['parentid'];
		$this->ParentName = @$DataSet['parent'];
		$this->ParentNameID = @$DataSet['parentnameid'];
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