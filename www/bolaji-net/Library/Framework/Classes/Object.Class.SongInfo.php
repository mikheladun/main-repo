<?php
class SongInfo {
	var $ID;
	var $SongID;
	var $VideoID;
	var $ArtistID;
	var $ArtistName;
	var $ArtistNameID;
	var $AlbumID;
	var $AlbumName;
	var $Title;
	var $Tracknum;
	var $Url;
	var $Description;
	var $SongYear;
	var $DateCreated;
	var $DateLastUpdated;
	var $Content;
	var $External;
	var $Stream;
	var $NumOfPlays;
	var $Length;


	// Clears all properties
	function Clear() {
		$this->ID = 0;
		$this->SongID = 0;
		$this->VideoID = 0;
		$this->ArtistID = 0;
		$this->ArtistName = '';
		$this->ArtistNameID = '';
		$this->AlbumID = 0;
		$this->AlbumName = '';
		$this->Title = '';
		$this->Tracknum = 0;
		$this->Url = '';
		$this->Description = '';
		$this->SongYear = 0;
		$this->DateCreated = '';
		$this->DateLastUpdated = '';
		$this->Content = '';
		$this->External = '';
		$this->Stream = '';
		$this->NumOfPlays = 0;
		$this->Length = 0;
	}

	function SongInfo() {
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->SongID = @$DataSet['songid'];
		$this->ID = $this->SongID;
		$this->ArtistID = @$DataSet['artistid'];
		$this->ArtistName = @$DataSet['artistname'];
		$this->ArtistNameID = @$DataSet['artistnameid'];
		$this->VideoID = @$DataSet['videoid'];
		$this->AlbumID = @$DataSet['albumid'];
		$this->AlbumName = @$DataSet['albumname'];
		$this->Title = @$DataSet['title'];
		$this->Tracknum = @$DataSet['tracknum'];
		$this->Url = @$DataSet['url'];
		$this->Description = @$DataSet['description'];
		$this->SongYear = @$DataSet['songyear'];
		$this->Content= @$DataSet['content'];
		$this->External = @$DataSet['external'];
		$this->Stream = @$DataSet['stream'];
		$this->NumOfPlays = @$DataSet['numofplays'];
		$this->Length = @$DataSet['length'];
		$this->DateCreated = TimeDiff(UnixTimestamp(@$DataSet['dateadded']));
		$this->DateLastUpdate = TimeDiff(UnixTimestamp(@$DataSet['lastupdatedate']));

		if(strpos($this->Title, "feat. ")) {
			$this->ArtistName .= " " . substr($this->Title, strpos($this->Title, "feat. "));
			$this->ArtistName = str_replace(array("feat.","&"),array("/","/"), $this->ArtistName);
			$this->Title = substr($this->Title, 0, strpos($this->Title, "feat. "));
		}
	}

}

?>