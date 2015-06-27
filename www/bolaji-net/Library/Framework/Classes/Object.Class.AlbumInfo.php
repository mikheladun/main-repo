<?php
class AlbumInfo {
	var $ID;
	var $AlbumID;
	var $ArtistID;
	var $Title;
	var $Description;
	var $AlbumArt;
	var $ThumbUrl;
	var $AlbumYear;
	var $DateCreated;
	var $DateLastUpdated;


	// Clears all properties
	function Clear() {
		$this->ID = 0;
		$this->AlbumID = 0;
		$this->ArtistID = 0;
		$this->Title = '';
		$this->Description = '';
		$this->AlbumArt = '';
		$this->ThumbUrl = '';
		$this->AlbumYear = 0;
		$this->DateCreated = '';
		$this->DateLastUpdated = '';
	}

	function AlbumInfo() {
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->AlbumID = @$DataSet['albumid'];
		$this->ID = $this->AlbumID;
		$this->ArtistID = @$DataSet['artistid'];
		$this->Title = @$DataSet['title'];
		$this->Description= @$DataSet['description'];
		$this->AlbumArt = @$DataSet['albumart'];
		$this->ThumbUrl = $this->AlbumArt;
		$this->AlbumYear = @$DataSet['albumyear'];
		$this->DateCreated = TimeDiff(UnixTimestamp(@$DataSet['dateadded']));
		$this->DateLastUpdate = TimeDiff(UnixTimestamp(@$DataSet['lastupdatedate']));
	}

}

?>