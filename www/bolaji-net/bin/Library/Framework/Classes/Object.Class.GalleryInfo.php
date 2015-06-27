<?php
class GalleryInfo {
	var $ID;
	var $GalleryID;
	var $PhotoID;
	var $CategoryID;
	var $OwnerID;
	var $Title;
	var $Url;
	var $ThumbURL;
	var $DateCreated;
	var $DateLastUpdated;
	var $Description;
	var $NumOfViews;
	var $NumOfPhotos;
	var $Photos;
	var $External;

	// Clears all properties
	function Clear() {
		$this->ID = 0;
		$this->GalleryID = 0;
		$this->PhotoID = 0;
		$this->CategoryID = 0;
		$this->OwnerID = 0;
		$this->Title = '';
		$this->Url = '';
		$this->ThumbURL = '';
		$this->Description = '';
		$this->DateCreated = '';
		$this->DateLastUpdated= '';
		$this->NumOfViews = 0;
		$this->NumOfPhotos = 0;
		$this->External = '0';
		$this->Photos = array();
	}

	function GalleryInfo() {
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->GalleryID = @$DataSet['collid'];
		$this->ID = $this->GalleryID;
		$this->PhotoID = @$DataSet['photoid'];
		$this->CategoryID = @$DataSet['categoryid'];
		$this->OwnerID = @$DataSet['ownerid'];	
		$this->Title = @$DataSet['title'];
		$this->Url = @$DataSet['url'];
		$this->ThumbURL = @$DataSet['thumburl'];
		$this->Description = @$DataSet['description'];
		$this->DateCreated = TimeDiff(UnixTimestamp(@$DataSet['dateadded']));
		$this->DateLastUpdated = TimeDiff(UnixTimestamp(@$DataSet['lastupdatedate']));
		$this->NumOfViews = @$DataSet['numofviews'];
		$this->NumOfPhotos = @$DataSet['numofphotos'];
	}

}

?>