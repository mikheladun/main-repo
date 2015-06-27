<?php
class MarketplaceInfo {
	var $ItemID;
	var $CategoryID;
	var $CategoryName;
	var $CategoryNameID;
	var $ParentCategoryID;
	var $ParentCategoryName;
	var $ParentCategoryNameID;
	var $OwnerID;
	var $Title;
	var $Description;
	var $Images;
	var $ImageID;
	var $ImageUrl;
	var $DateCreated;
	var $LastUpdateDate;

	function MarketplaceInfo() {
		$this->Clear();
	}

	// Clears all properties
	function Clear() {
		$this->ItemID = 0;
		$this->CategoryID = 0;
		$this->CategoryName = '';
		$this->CategoryNameID = '';
		$this->ParentCategoryID = 0;
		$this->ParentCategoryName = '';
		$this->ParentCategoryNameID = '';
		$this->OwnerID = 0;
		$this->Title = '';
		$this->Description = '';
		$this->Images = array();
		$this->ImageID = 0;
		$this->ImageUrl = '';
		$this->DateCreated = '';
		$this->DateLastUpdated = '';
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
		$this->ItemID = @$DataSet['itemid'];
		$this->CategoryID = @$DataSet['categoryid'];
		$this->CategoryName = @$DataSet['categoryname'];
		$this->CategoryNameID = @$DataSet['categorynameid'];
		$this->ParentCategoryID = @$DataSet['pcategoryid'];
		$this->ParentCategoryName = @$DataSet['pcategoryname'];
		$this->ParentCategoryNameID = @$DataSet['pcategorynameid'];
		$this->OwnerID = @$DataSet['ownerid'];
		$this->Title = @$DataSet['title'];
		$this->Description = @$DataSet['description'];
		$this->ImageUrl = @$DataSet['imageurl'];
		$this->ImageID = @$DataSet['imageid'];
		$this->DateCreated = UnixTimestamp(@$DataSet['dateadded']);
		$this->DateLastUpdated = UnixTimestamp(@$DataSet['lastupdatedate']);
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