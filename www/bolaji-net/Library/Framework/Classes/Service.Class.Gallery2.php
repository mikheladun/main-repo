<?php
require_once(dirname(__FILE__)."/../Core/Framework.Utils.php");
require_once(dirname(__FILE__)."/../Core/Framework.Class.BaseService.php");
require_once(dirname(__FILE__)."/../Core/Framework.Class.Query.php");
require_once(dirname(__FILE__)."/../Classes/Object.Class.MusicItem.php");
require_once(dirname(__FILE__)."/../Classes/Object.Class.Category.php");

class DiscussionItem extends BaseService
{
 function DiscussionItem()
 {
  $this->_constructor();
 }
 function &HelloWorld(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT COUNT(*) AS COUNT FROM LUM_DISCUSSION", $Connection);
	$Result = $Query->Execute();
 	$this->Response->Object = $Result->Object['COUNT'];
	$AppContext->Datasource->Disconnect("Local");

	return $this->Response;
 }
 function &GetDiscussionItemCategory(&$AppContext, $Params)
 {
	switch(intval($Params->CategoryID))
	{
		case 21: $this->Response->Object = "";$this->Response->DisplayObject = "Top Stories"; break;
		case 22: $this->Response->Object = "National";$this->Response->DisplayObject = "National News"; break;
		case 23: $this->Response->Object = "Politics"; break;
		case 24: $this->Response->Object = "Business"; break;
		case 25: $this->Response->Object = "Technology"; break;
		case 26: $this->Response->Object = "Sports"; break;
		case 27: $this->Response->Object = "Education"; break;
		case 28: $this->Response->Object = "Health"; break;
		case 29: $this->Response->Object = "Environment"; break;

		case 40: $this->Response->Object = ""; break;
		case 41: $this->Response->Object = "East"; break;
		case 42: $this->Response->Object = "West"; break;
		case 43: $this->Response->Object = "North"; break;
		case 44: $this->Response->Object = "Central"; break;
		case 45: $this->Response->Object = "Pan Africa"; break;

		case 1: $this->Response->Object = "General"; break;
		case 2: $this->Response->Object = "Announcements"; break;
		case 3: $this->Response->Object = "artsscience";$this->Response->DisplayObject = "Arts &amp; Science"; break;
		case 4: $this->Response->Object = "Business"; break;
		case 5: $this->Response->Object = "Education"; break;
		case 6: $this->Response->Object = "Entertainment"; break;	
		case 7: $this->Response->Object = "Politics"; break;	
		case 8: $this->Response->Object = "healthenvironment";$this->Response->DisplayObject = "Health &amp; Environment"; break;	
		case 9: $this->Response->Object = "nigerdelta";$this->Response->DisplayObject = "Niger-Delta"; break;
		case 10: $this->Response->Object = "Sports"; break;	
		case 11; $this->Response->Object = "stylefashion";$this->Response->DisplayObject = "Style &amp; Fashion"; break;	
		case 12: $this->Response->Object = "Technology"; break;	
		case 13: $this->Response->Object = "wazobi";$this->Response->DisplayObject = "Wazobi Website"; break;	
	}

	return $this->Response;
 }
 function &GetOnNigeriaDiscussionCategory(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_CATEGORY.CATEGORYID, LUM_CATEGORY.NAME, COUNT(LUM_COMMENT.DISCUSSIONID) AS DISCUSSIONCOUNT, LUM_CATEGORY.DESCRIPTION, LUM_DISCUSSION.LASTUSERID, LUM_DISCUSSION.DATELASTACTIVE, LUM_USER.USERID AS LASTUSERID, LUM_USER.NAME AS LASTUSERNAME FROM LUM_CATEGORY LEFT JOIN LUM_DISCUSSION ON LUM_DISCUSSION.CATEGORYID = LUM_CATEGORY.CATEGORYID LEFT JOIN LUM_USER ON LUM_USER.USERID = LUM_DISCUSSION.LASTUSERID LEFT JOIN LUM_COMMENT ON LUM_COMMENT.DISCUSSIONID = LUM_DISCUSSION.DISCUSSIONID WHERE LUM_CATEGORY.CATEGORYID < 21 AND LUM_CATEGORY.CATEGORYID > 1 GROUP BY LUM_CATEGORY.NAME ORDER BY CATEGORYID", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->DiscussionID);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$Items = array();
		$count = 0;
		while($Object = $Query->LoopResult())
		{
			$Category = new Category();
			$Category->GetPropertiesFromDataSet(&$Object);
			$Items[] = $Category;
		}
		$this->Response->Object = $Items;
	}

	$AppContext->Datasource->Disconnect("Local");

  	return $this->Response;
 }
 function &GetDiscussionCommentsCount(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT COUNT(*) AS COUNT FROM LUM_COMMENT WHERE DISCUSSIONID = ?", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->DiscussionID);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$this->Response->Object = $Result->Object['COUNT'];
	}

	$AppContext->Datasource->Disconnect("Local");

	return $this->Response;
 }
 function &GetOnNigeriaDiscussionItemsCount(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT COUNT(LUM_DISCUSSION.DISCUSSIONID) AS COUNT FROM LUM_DISCUSSION WHERE LUM_DISCUSSION.CATEGORYID < 21", $Connection);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$this->Response->Object = $Result->Object['COUNT'];
	}

	$AppContext->Datasource->Disconnect("Local");

	return $this->Response;
 }
 function &GetDiscussionItemsCount(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT COUNT(LUM_DISCUSSION.DISCUSSIONID) AS COUNT FROM LUM_DISCUSSION WHERE LUM_DISCUSSION.CATEGORYID = ?", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->CategoryID);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$this->Response->Object = $Result->Object['COUNT'];
	}

	$AppContext->Datasource->Disconnect("Local");

	return $this->Response;
 }
 function &GetDiscussionItemDetails(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_DISCUSSION.DISCUSSIONID, LUM_DISCUSSION.CATEGORYID, LUM_DISCUSSION.AUTHUSERID, LUM_DISCUSSION.FIRSTCOMMENTID, LUM_DISCUSSION.LASTUSERID, LUM_DISCUSSION.NAME, LUM_DISCUSSION.DATECREATED, LUM_DISCUSSION.DATELASTACTIVE, LUM_DISCUSSION.COUNTCOMMENTS, LUM_COMMENT.BODY, LUM_COMMENT.URL, LUM_USER.NAME AS AUTHUSERNAME FROM LUM_DISCUSSION JOIN LUM_COMMENT ON LUM_DISCUSSION.DISCUSSIONID = LUM_COMMENT.DISCUSSIONID JOIN LUM_USER ON LUM_USER.USERID = LUM_DISCUSSION.AUTHUSERID WHERE LUM_DISCUSSION.DISCUSSIONID = ? AND LUM_COMMENT.URL <> ''", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->DiscussionID);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$Discussion = new Discussion();
		$Discussion->GetPropertiesFromDataSet(&$Result->Object);
		$this->Response->Object = $Discussion;
	}

	$AppContext->Datasource->Disconnect("Local");

  	return $this->Response;
 }
 function &GetDiscussionComments(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_DISCUSSION.DISCUSSIONID, LUM_DISCUSSION.CATEGORYID, LUM_DISCUSSION.AUTHUSERID, LUM_DISCUSSION.FIRSTCOMMENTID, LUM_DISCUSSION.LASTUSERID, LUM_DISCUSSION.NAME, LUM_DISCUSSION.COUNTCOMMENTS, LUM_COMMENT.DATECREATED, LUM_COMMENT.BODY, LUM_COMMENT.URL, LUM_USER.NAME AS AUTHUSERNAME FROM LUM_COMMENT JOIN LUM_USER ON LUM_USER.USERID = LUM_COMMENT.AUTHUSERID JOIN LUM_DISCUSSION ON LUM_COMMENT.DISCUSSIONID = LUM_DISCUSSION.DISCUSSIONID WHERE LUM_COMMENT.DISCUSSIONID = ? ORDER BY LUM_COMMENT.DATECREATED ASC LIMIT ?, ?", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->DiscussionID);
	$Query->Param($Query->NUMBER, 2, $Params->Page);
	$Query->Param($Query->NUMBER, 3, $Params->Offset);
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$Items = array();
		$count = 0;
		while($Object = $Query->LoopResult())
		{
			if(++$count == 1)
			{
				continue;
			}
			$Discussion = new Discussion();
			$Discussion->GetPropertiesFromDataSet(&$Object);
			$Items[] = $Discussion;
		}
		$this->Response->Object = $Items;
	}

	$AppContext->Datasource->Disconnect("Local");

  	return $this->Response;
 }
 function &GetOnNigeriaDiscussionItems(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_DISCUSSION.DISCUSSIONID, LUM_DISCUSSION.CATEGORYID, LUM_DISCUSSION.AUTHUSERID, LUM_DISCUSSION.FIRSTCOMMENTID, LUM_DISCUSSION.AUTHUSERID, LUM_DISCUSSION.NAME, LUM_DISCUSSION.DATECREATED, LUM_DISCUSSION.DATELASTACTIVE, LUM_DISCUSSION.COUNTCOMMENTS, LUM_CATEGORY.CATEGORYID, LUM_CATEGORY.NAME AS CATEGORY, LUM_COMMENT.BODY, LUM_COMMENT.URL, LUM_USER.NAME AS AUTHUSERNAME FROM LUM_DISCUSSION JOIN LUM_CATEGORY ON LUM_CATEGORY.CATEGORYID = LUM_DISCUSSION.CATEGORYID JOIN LUM_COMMENT ON LUM_DISCUSSION.DISCUSSIONID = LUM_COMMENT.DISCUSSIONID JOIN LUM_USER ON LUM_USER.USERID = LUM_DISCUSSION.AUTHUSERID WHERE LUM_DISCUSSION.CATEGORYID < 21 AND LUM_COMMENT.URL <> '' ORDER BY LUM_DISCUSSION.DATECREATED DESC LIMIT ?, ?", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->Page);
	$Query->Param($Query->NUMBER, 2, $AppContext->Configuration["PAGING_OFFSET"]);
	//echo $Query->BuildQuery();
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$Items = array();
		if($Result->CountRows == 1)
		{
			$Discussion = new Discussion();
			$Discussion->GetPropertiesFromDataSet($Result->Object);
			$Items[] = $Discussion;
		}
		else
		{
			while($Object = $Query->LoopResult())
			{
				$Discussion = new Discussion();
				$Discussion->GetPropertiesFromDataSet(&$Object);
				$Items[] = $Discussion;
			}
		}
		$this->Response->Object = $Items;
	}

	$AppContext->Datasource->Disconnect("Local");

  	return $this->Response;
 }

 function &GetDiscussionItems(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("SELECT LUM_DISCUSSION.DISCUSSIONID, LUM_DISCUSSION.CATEGORYID, LUM_DISCUSSION.AUTHUSERID, LUM_DISCUSSION.FIRSTCOMMENTID, LUM_DISCUSSION.AUTHUSERID, LUM_DISCUSSION.NAME, LUM_DISCUSSION.DATECREATED, LUM_DISCUSSION.DATELASTACTIVE, LUM_DISCUSSION.COUNTCOMMENTS, LUM_CATEGORY.CATEGORYID, LUM_CATEGORY.NAME AS CATEGORY, LUM_COMMENT.BODY, LUM_COMMENT.URL, LUM_USER.NAME AS AUTHUSERNAME FROM LUM_DISCUSSION JOIN LUM_CATEGORY ON LUM_CATEGORY.CATEGORYID = LUM_DISCUSSION.CATEGORYID JOIN LUM_COMMENT ON LUM_DISCUSSION.DISCUSSIONID = LUM_COMMENT.DISCUSSIONID JOIN LUM_USER ON LUM_USER.USERID = LUM_DISCUSSION.AUTHUSERID WHERE LUM_DISCUSSION.CATEGORYID = ? AND LUM_COMMENT.URL <> '' ORDER BY LUM_DISCUSSION.DATECREATED DESC LIMIT ?, ?", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->CategoryID);
	$Query->Param($Query->NUMBER, 2, $Params->Page);
	$Query->Param($Query->NUMBER, 3, $AppContext->Configuration["PAGING_OFFSET"]);
	//echo $Query->BuildQuery();
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$this->Response->Success = true;
		$Items = array();
		if($Result->CountRows == 1)
		{
			$Discussion = new Discussion();
			$Discussion->GetPropertiesFromDataSet($Result->Object);
			$Items[] = $Discussion;
		}
		else
		{
			while($Object = $Query->LoopResult())
			{
				$Discussion = new Discussion();
				$Discussion->GetPropertiesFromDataSet(&$Object);
				$Items[] = $Discussion;
			}
		}
		$this->Response->Object = $Items;
	}

	$AppContext->Datasource->Disconnect("Local");

  	return $this->Response;
 }
 function &CreateNewDiscussion(&$AppContext, &$Params)
 {
 	$Discussion = array();
	$Discussion['title'] = $Params->Title;
	$Discussion['description'] = $Params->Body;
	$Discussion['link'] = $Params->Url;
	$Params->RSSItems->items[] = $Discussion;
 	return $this->SaveDiscussionItems($AppContext, $Params);
 }
 function &SaveDiscussionItems(&$AppContext, &$Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$this->Response->Success = true;
	$Discussions = array_reverse($Params->RSSItems->items, true);
	foreach($Discussions as $Discussion)
	{
		$name = $Discussion['title'];
		//echo "<br/>$Params->CategoryID  ","<strong>FormatString: ", FormatStringForDatabaseInput($AppContext->FormatString($name, $this, "Text", "DATABASE"))," strpos: ",strpos($name, ":"),"</strong>";
		if((strpos($name, ":") && substr($name,0,8) != 'Nigeria:') && ($Params->CategoryID > 20 && $Params->CategoryID < 40 ))
		{
			continue;
		}
		$name = (substr($name,0,8) == 'Nigeria:') ? substr($name, 9, strlen($name)) : $name;
		$UserID = isset($Params->AuthUserID) ? $Params->AuthUserID : 1;

		$Query = new Query("SELECT LUM_DISCUSSION.DISCUSSIONID, LUM_DISCUSSION.CATEGORYID, LUM_DISCUSSION.NAME, LUM_COMMENT.URL FROM LUM_DISCUSSION JOIN LUM_COMMENT ON LUM_DISCUSSION.DISCUSSIONID = LUM_COMMENT.DISCUSSIONID WHERE LUM_DISCUSSION.CATEGORYID = ? AND LUM_DISCUSSION.NAME = ? AND LUM_COMMENT.URL = ?", $Connection);
		$Query->Param($Query->NUMBER, 1, $Params->CategoryID);
		$Query->Param($Query->STRING, 2, FormatStringForDatabaseInput($AppContext->FormatString($name, $this, "Text", "DATABASE")));
		$Query->Param($Query->STRING, 3, FormatStringForDatabaseInput($Discussion['link']));
		$Result = $Query->Execute();
		if($Result->Success && $Result->CountRows > 0)
		{
			continue;
		}
		$Query = new Query("INSERT INTO LUM_DISCUSSION (AUTHUSERID,WHISPERUSERID,FIRSTCOMMENTID,LASTUSERID,ACTIVE,CLOSED,STICKY,SINK,NAME,DATECREATED,DATELASTACTIVE,COUNTCOMMENTS,CATEGORYID,TOTALWHISPERCOUNT) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $Connection);
		$Query->Param($Query->NUMBER, 1, $UserID);
		$Query->Param($Query->NUMBER, 2, 0);
		$Query->Param($Query->NUMBER, 3, $UserID);
		$Query->Param($Query->NUMBER, 4, $UserID);
		$Query->Param($Query->NUMBER, 5, 1);
		$Query->Param($Query->NUMBER, 6, 0);
		$Query->Param($Query->NUMBER, 7, 0);
		$Query->Param($Query->NUMBER, 8, 0);
		$Query->Param($Query->STRING, 9, FormatStringForDatabaseInput($AppContext->FormatString($name, $this, "Text", "DATABASE")));
		$Query->Param($Query->DATE, 10, 'NOW()');
		$Query->Param($Query->DATE, 11, 'NOW()');
		$Query->Param($Query->NUMBER, 12, 1);
		$Query->Param($Query->NUMBER, 13, $Params->CategoryID);
		$Query->Param($Query->NUMBER, 14, 0);
		//echo "FormatString: ", $AppContext->FormatString($name, $this, "Text", "DATABASE");
		//echo "<br/>",$Query->BuildQuery();
		$Result = $Query->Execute();
		if($Result->Success)
		{
			$DiscussionID = $Query->LastInsertID(&$Connection);
			$Body = $Discussion['description'];
			$URL = $Discussion['link'];

			$Query = new Query("INSERT INTO LUM_COMMENT (DISCUSSIONID,AUTHUSERID,BODY,URL,DATECREATED,DELETED,DELETEUSERID,REMOTEIP) VALUES (?,?,?,?,?,?,?,?)", $Connection);
			$Query->Param($Query->NUMBER, 1, $DiscussionID);
			$Query->Param($Query->NUMBER, 2, $UserID);
			//echo "FormatString: ", $AppContext->FormatString($Body, $this, "Text", "DATABASE");
			$Query->Param($Query->STRING, 3, FormatStringForDatabaseInput($AppContext->FormatString($Body, $this, "Text", "DATABASE")));
			$Query->Param($Query->STRING, 4, FormatStringForDatabaseInput($URL));
			$Query->Param($Query->DATE, 5, 'NOW()');
			$Query->Param($Query->NUMBER, 6, 0);
			$Query->Param($Query->NUMBER, 7, 0);
			$Query->Param($Query->STRING, 8, GetRemoteIp());
			//echo "<br/>",$Query->BuildQuery();
			$Query->Execute();
		}
		else
		{
			$this->Response->Success = false;
		}
	}

	$AppContext->Datasource->Disconnect("Local");

  	return $this->Response;
 }
 function &SaveDiscussionComment(&$AppContext, $Params)
 {
	$Connection = $AppContext->Datasource->Connect("Local");
	$Query = new Query("INSERT INTO LUM_COMMENT (DISCUSSIONID,AUTHUSERID,BODY,URL,DATECREATED,DELETED,DELETEUSERID) VALUES (?,?,?,?,?,?,?)", $Connection);
	$Query->Param($Query->NUMBER, 1, $Params->DiscussionID);
	$Query->Param($Query->NUMBER, 2, isset($Params->LastUserID) && !empty($Params->LastUserID) ? $Params->LastUserID : 1);
	$Query->Param($Query->STRING, 3, $AppContext->FormatString($Params->Body, $this, "Text", "DATABASE"));
	$Query->Param($Query->STRING, 4, FormatStringForDatabaseInput($Params->URL));
	$Query->Param($Query->DATE, 5, 'NOW()');
	$Query->Param($Query->NUMBER, 6, 0);
	$Query->Param($Query->NUMBER, 7, 0);
	//echo $Query->BuildQuery();
	$Result = $Query->Execute();
	if($Result->Success)
	{
		$Query = new Query("UPDATE LUM_DISCUSSION SET LUM_DISCUSSION.LASTUSERID = ?, LUM_DISCUSSION.COUNTCOMMENTS = ?, LUM_DISCUSSION.DATELASTACTIVE = ? WHERE LUM_DISCUSSION.DISCUSSIONID = ?", $Connection);
		$Query->Param($Query->NUMBER, 1, isset($Params->LastUserID) && !empty($Params->LastUserID) ? $Params->LastUserID : 1);
		$Query->Param($Query->MYSQL, 2, 'LUM_DISCUSSION.COUNTCOMMENTS + 1');
		$Query->Param($Query->DATE, 3, 'NOW()');
		$Query->Param($Query->NUMBER, 4, $Params->DiscussionID);
		$Result = $Query->Execute();
		$this->Response->Success = true;
    }

	$AppContext->Datasource->Disconnect("Local");
  	return $this->Response;
 }
}
?>