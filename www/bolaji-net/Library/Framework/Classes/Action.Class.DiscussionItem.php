<?php
$filePath = dirname(__FILE__);
require_once("../../../lib/framework/BaseAction.inc");
require_once("Service.Class.DiscussionItem.php");

class DiscussionItemsAction extends BaseAction
{
 function &execute()
 {
  $dao = new DiscussionItemsDAO();
  switch($this->ActionType)
  {
   case "GetDiscussionItemsCount": 
		$res = $dao->getDiscussionItemsCount($this->ActionParams);
		break;
   case "GetDiscussionItems":
		$res = $dao->getDiscussionItems($this->ActionParams);
		break;
   case "GetDiscussionItemDetails":
		$res = $dao->getDiscussionItemDetails($this->ActionParams);
		break;
   case "GetDiscussionItemCategory":
   		$res = $dao->getDiscussionItemCategory($this->ActionParams);
		break;
   case "GetDiscussionComments": 
		$res = $dao->getDiscussionComments($this->ActionParams);
		break;
   case "GetDiscussionCommentsCount":
		$res = $dao->getDiscussionCommentsCount($this->ActionParams);
		break;
	case "SaveDiscussionItems":
		$res = $dao->saveDiscussionItems($this->ActionParams);
		break;
	case "SaveDiscussionComment":
		$res = $dao->saveDiscussionItemComment($this->ActionParams);
		break;
  }

  return $res;
 }
}
?>