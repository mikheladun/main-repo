<?php
class VideoInfo {
	var $ID;
	var $VideoID;
	var $ArtistID;
	var $ArtistName;
	var $ArtistNameID;
	var $AlbumID;
	var $AlbumName;
	var $VideoCollID;
	var $VideoCollName;
	var $Title;
	var $Url;
	var $ThumbUrl;
	var $Source;
	var $Description;
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
		$this->Video = 0;
		$this->ArtistID = 0;
		$this->ArtistName = '';
		$this->ArtistNameID = '';
		$this->AlbumID = 0;
		$this->AlbumName = '';
		$this->VideoCollID = 0;
		$this->VideoCollName = '';
		$this->Title = '';
		$this->Url = '';
		$this->ThumbUrl = '';
		$this->Source = '';
		$this->Description = '';
		$this->DateCreated = '';
		$this->DateLastUpdated = '';
		$this->Content = '';
		$this->External = '';
		$this->Stream = '';
		$this->NumOfPlays = 0;
		$this->Length = 0;
	}

	function VideoInfo() {
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->VideoID = @$DataSet['videoid'];
		$this->ID = $this->VideoID;
		$this->ArtistID = @$DataSet['artistid'];
		$this->ArtistName = @$DataSet['artistname'];
		$this->ArtistNameID = @$DataSet['artistnameid'];
		$this->AlbumID = @$DataSet['albumid'];
		$this->AlbumName = @$DataSet['albumname'];
		$this->VideoCollID = @$DataSet['collid'];
		$this->VideoCollName = @$DataSet['collname'];
		$this->Title = @$DataSet['title'];
		$this->Source = @$DataSet['sourceid'];
		$this->Url = @$DataSet['url'];
		$this->ThumbUrl = @$DataSet['thumburl'];
		$this->Description = @$DataSet['description'];
		$this->VideoYear = @$DataSet['songyear'];
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