<?php
class ArtistInfo {
	var $ID;
	var $ArtistID;
	var $Name;
	var $NameID;
	var $Profile;
	var $Description;
	var $DateCreated;
	var $DateLastUpdated;
	var $Songs;
	var $Albums;

	// Clears all properties
	function Clear() {
		$this->ID = 0;
		$this->ArtistID = 0;
		$this->Name = '';
		$this->NameID = '';
		$this->Profile = '';
		$this->Description = '';
		$this->DateCreated = '';
		$this->DateLastUpdated= '';
		$this->Songs = array();
		$this->Albums = array();
	}

	function ArtistInfo() {
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->ArtistID = @$DataSet['artistid'];
		$this->ID = $this->ArtistID;
		$this->Name = @$DataSet['name'];
		$this->NameID = @$DataSet['nameid'];
		$this->Profile = @$DataSet['profile'];
		$this->Description = @$DataSet['description'];
		$this->DateCreated = TimeDiff(UnixTimestamp(@$DataSet['dateadded']));
		$this->DateLastUpdated = TimeDiff(UnixTimestamp(@$DataSet['lastupdatedate']));
	}

	function AddSongInfo($SongInfo)
	{
		$this->Songs[] = $SongInfo;
	}

	function AddAlbumInfo($AlbumInfo)
	{
		$this->Albums[] = $AlbumInfo;
	}

}

?>