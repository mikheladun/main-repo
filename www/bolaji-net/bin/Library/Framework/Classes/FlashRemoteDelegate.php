<?php
 $filePath = dirname(__FILE__);
 require_once("$filePath/../../Framework/Core/Framework.Class.ApplicationContext.php");

 class FlashRemoteDelegate
 {
	var $MusicStreamUrl = "rtmp://localhost.bolaji.net/music";
	var $VideoStreamUrl = "rtmp://localhost.bolaji.net/video";
	//var $MusicStreamUrl = "rtmp://72.47.204.132/music";
	//var $VideoStreamUrl = "rtmp://72.47.204.132/video";

    function FlashRemoteDelegate()
    {
        $this->methodTable = array
        (
            "execute" => array
            (
                "access" => "remote",
                "description" => "Pings back a message",
				"arguments" => array($sMessage)
            )
        );
    }

	function execute($Request, $Data)
	{
		switch(strtolower($Request))
		{
			case "numofplay" : 
				$Response = $this->updateNumOfPlay($Data);
				break;
			case 'music.artist' : 
				$Response = $this->getArtistSong($Data);
				break;
			case 'music.video' : 
				$Response = $this->getMusicVideoInfo($Data); 
				break;
			case 'music.artistvideo' : 
				$Response = $this->getArtistVideo($Data); 
				break;
			case 'music.top10' : 
				$Response = $this->getSongList($Request,"GetTopSongsList", 1);
				break;
			case 'music.rec' : 
				$Response = $this->getSongList($Request,"GetTopSongsList", 2);
				break;
			case 'video.video' : 
				$Response = $this->getVideoList($Data, "video");
				break;
			case 'video.videoid' : 
				$Response = $this->getVideoList($Data, "videoid");
				break;
			case 'video.top10' : 
				$Response = $this->getVideoList($Request,"GetTopVideosList", 1);
				break;
			case 'video.rec' : 
				$Response = $this->getVideoList($Request,"GetTopVideosList", 2);
				break;
		}

		return $Response;
	}

	function getArtistSong($ArtistID)
	{
		$SongList = array();
		$AppContext = new ApplicationContext();
		$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
		$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

		$Params->Artistid=$ArtistID;
		$Response = $Service->Execute(&$AppContext, "GetArtistSongs", $Params);
		if($Response->Success)
		{
			foreach($Response->Object as $items)
			{
				$ArtistID = $items->ArtistID;
				$SongID = $items->SongID;
				$Url = $items->Url;
				//$Url = $this->MusicStreamUrl."!audio".substr($Url,0,strlen($Url)-4);
				$Url = $this->MusicStreamUrl."!/audio".$Url;
				$Metadata = "$items->ArtistName,$items->Title,&nbsp;";
				$SongList[] = $ArtistID."|".$SongID."|".$Url."|".$Metadata;
			}
		}

		$Response = array("ccID" => "music.artist|".$ArtistID, "items" => $SongList);

		return $Response;
	}

	function getArtistVideo($ArtistID)
	{
		$SongList = array();
		$AppContext = new ApplicationContext();
		$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
		$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

		$Params->Artistid=$ArtistID;
		$Response = $Service->Execute(&$AppContext, "GetArtistVideos", $Params);
		if($Response->Success)
		{
			foreach($Response->Object as $items)
			{
				$ArtistID = $items->ArtistID;
				$VideoID = $items->VideoID;
				$Url = $items->Url;
				$Url = $this->MusicStreamUrl . "/video" . $Url;
				//$Url = $this->MusicStreamUrl."/video".substr($Url,0,strlen($Url)-4);
				$Metadata = "$items->ArtistName,$items->Title,$items->ThumbUrl";
				$SongList[] = $ArtistID."|".$VideoID."|".$Url."|".$Metadata;
			}
		}

		$Response = array("ccID" => "music.artistvideo:".$ArtistID, "items" => $SongList);

		return $Response;
	}

	function getMusicVideoInfo($VideoID)
	{
		$SongList = array();
		$AppContext = new ApplicationContext();
		$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
		$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

		$Params->Videoid=$VideoID;
		$Response = $Service->Execute(&$AppContext, "GetVideoInfo", $Params);
		if($Response->Success)
		{
			foreach($Response->Object as $items)
			{
				$ArtistID = $items->ArtistID;
				$VideoID = $items->VideoID;
				$Url = $items->Url;
				$Url = $this->MusicStreamUrl."/video".$Url;
				//$Url = $this->MusicStreamUrl."/video".substr($Url,0,strlen($Url)-4);
				$Metadata = "$items->ArtistName,$items->Title,$items->ThumbUrl";
				$SongList[] = $ArtistID."|".$VideoID."|".$Url."|".$Metadata;
			}
		}

		$Response = array("ccID" => "music.video:".$VideoID, "items" => $SongList);

		return $Response;
	}

	function getSongList($Request,$Provider,$Data)
	{
		$SongList = array();
		$AppContext = new ApplicationContext();
		$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
		$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

		$Params->Rank = $Data;
		$Params->Offset = 10;
		$Response = $Service->Execute(&$AppContext, $Provider, $Params);
		if($Response->Success)
		{
			foreach($Response->Object as $items)
			{
				$ArtistID = $items->ArtistID;
				$SongID = $items->SongID;
				$Url = $items->Url;
				//$Url = $this->MusicStreamUrl."!/audio".substr($Url,0,strlen($Url)-4);
				$Url = $this->MusicStreamUrl."!/audio".$Url;
				$Metadata = "$items->ArtistName,$items->Title,$items->ArtistNameID";
				$SongList[] = $ArtistID."|".$SongID."|".$Url."|".$Metadata;
			}
		}

		$Response = array("ccID" => $Request, "items" => $SongList);

		return $Response;
	}

	function getVideoList($VideoID, $Type)
	{
		$SongList = array();
		$AppContext = new ApplicationContext();
		$ServiceName = $AppContext->Configuration["SERVICE.NAME.VIDEO"];
		$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);

		$Params->Videoid = $VideoID;
		$Params->Groupid = $VideoID;
		switch($Type)
		{
			case "video" : 	$Provider = "GetVideosCollList"; break;
			case "videoid"	: $Provider = "GetVideoInfo"; break;
		}

		$Response = $Service->Execute(&$AppContext, $Provider, $Params);

		if($Response->Success)
		{
			foreach($Response->Object as $items)
			{
				$Url = $items->Url;
				//$Url = "/" . $items->VideoID . $Url;
				//$Url = $this->VideoStreamUrl.substr($Url,0,strlen($Url)-4);
				$Url = $this->VideoStreamUrl.$Url;
				$Metadata = "$items->Title,$items->Description,$items->ThumbUrl";
				$VideoList[] = $items->VideoCollID."|".$items->VideoID."|".$Url."|".$Metadata;
			}
		}

		$Response = array("ccID" => "video.$Type:".$VideoID, "items" => $VideoList);

		return $Response;
	}

	function updateNumOfPlay($Id)
	{
		$AppContext = new ApplicationContext();
		$ServiceName = $AppContext->Configuration["SERVICE.NAME.MEDIA"];
		$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
		list($Type, $Params->Id) = explode(":", $Id);
		switch($Type)
		{
			case 'music.song' : $Provider = "UpdateSongNumOfPlay"; break;
			case 'music.video' : $Provider = "UpdateArtistVideoNumOfPlay"; break;
			case 'video.video' : $Provider = "UpdateVideoNumOfPlay"; break;
		}

		$Response = $Service->Execute(&$AppContext, $Provider, $Params);

		return $Response->Success;
	}

}
?>