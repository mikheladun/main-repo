<?php
class PhotoInfo {
	var $ID;
	var $PhotoID;
	var $PhotoNum;
	var $PrevPhotoNum;
	var $PrevPhotoID;
	var $NextPhotoNum;
	var $NextPhotoID;
	var $GalleryID;
	var $CategoryID;
	var $OwnerID;
	var $Title;
	var $SetTitle;
	var $SetDescription;
	var $SetID;
	var $Url;
	var $ThumbURL;
	var $DateCreated;
	var $DateLastUpdated;
	var $Description;
	var $NumOfViews;

	// Clears all properties
	function Clear() {
		$this->ID = 0;
		$this->PhotoID = 0;
		$this->PhotoNum = 0;
		$this->PrevPhotoNum = 0;
		$this->PrevPhotoID = 0;
		$this->NextPhotoNum = 0;
		$this->NextPhotoID = 0;
		$this->GalleryID= 0;
		$this->CategoryID = 0;
		$this->OwnerID = 0;
		$this->Title = '';
		$this->SetID = 0;
		$this->SetTitle = '';
		$this->SetDescrition = '';
		$this->Description = '';
		$this->Url = '';
		$this->ThumbURL = '';
		$this->DateCreated = '';
		$this->DateLastUpdated= '';
		$this->NumOfViews = 0;
	}

	function PhotoInfo() {
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->GalleryID = @$DataSet['collid'];
		$this->PhotoID = @$DataSet['photoid'];
		$this->ID = $this->PhotoID;
		$this->PhotoNum = @$DataSet['photonum'];
		$this->PrevPhotoNum = @$DataSet['prevphotonum'];
		$this->PrevPhotoID = @$DataSet['prevphotoid'];
		$this->NextPhotoNum = @$DataSet['nextphotonum'];
		$this->NextPhotoID = @$DataSet['nextphotoid'];
		$this->CategoryID = @$DataSet['categoryid'];
		$this->OwnerID = @$DataSet['ownerid'];	
		$this->Title = @$DataSet['title'];
		$this->Description = @$DataSet['description'];
		$this->SetID = @$DataSet['setid'];
		$this->SetTitle = @$DataSet['settitle'];
		$this->SetDescription = @$DataSet['setdescription'];
		$this->Url = @$DataSet['url'];
		$this->ThumbURL = @$DataSet['thumburl'];
		$this->DateCreated = TimeDiff(UnixTimestamp(@$DataSet['dateadded']));
		$this->DateLastUpdated = TimeDiff(UnixTimestamp(@$DataSet['lastupdatedate']));
		$this->NumOfViews = @$DataSet['numofviews'];
	}

}

?>