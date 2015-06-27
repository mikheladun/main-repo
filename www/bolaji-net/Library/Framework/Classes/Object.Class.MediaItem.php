<?php
class MediaItem {
	var $DiscussionID;
	var $FirstCommentID;
	var $CategoryID;
	var $Category;
	var $AuthUserID;
	var $AuthUsername;		// Display purposes only - The user's username
	var $LastUserID;		// The user that last added comments to the Discussion
	var $LastUsername;		// Display purposes only - The user's username
	var $Active;			// Boolean value indicating if the Discussion is visible to non-administrators
	var $Closed;			// Boolean value indicating if the Discussion will allow any further Comments to be added
	var $Sticky;			// Boolean value indicating if the Discussion should appear at the top of the list
	var $Bookmarked;		// Boolean value indicating if the Discussion has been bookmared by the current user
   var $Sink;				// Boolean value indicating if the discussion should sink (ie. allow comments to be added, but not stay at the top of the list).
	var $Name;
	var $DateCreated;
	var $DateLastActive;
	var $CountComments;		// Number of Comments currently in this Discussion
   var $CountReplies;		// Number of replies currently in this Discussion (one less than the Comment count)
	var $Comment;				// Only used when creating/editing a discussion
   var $LastViewed;
	var $LastViewCountComments;
	var $NewComments;
	var $Status;
	var $LastPage;				// The last page of the discussion
  	// Used to prevent double posts and "back button" posts
   var $UserDiscussionCount;
	var $WhisperUserID;	// If this discussion was whispered to a particular user
	var $WhisperUsername;		// Display purposes only - The user's username
	var $CountWhispersTo;
	var $CountWhispersFrom;
	var $Body;
	var $Url;

	// Clears all properties
	function Clear() {
		$this->DiscussionID = 0;
		$this->FirstCommentID = 0;
		$this->CategoryID = 0;
		$this->Category = '';
		$this->AuthUserID = 0;
		$this->AuthUsername = '';
		$this->LastUserID = 0;
		$this->LastUsername = '';
		$this->Active = 0;
		$this->Closed = 0;
		$this->Sticky = 0;
		$this->Bookmarked = 0;
		$this->Sink = 0;
		$this->Name = '';
		$this->DateCreated = '';
		$this->DateLastActive = '';
		$this->CountComments = 0;
		$this->CountReplies = 0;
		$this->Comment = 0;
		$this->LastViewed = '';
		$this->LastViewCountComments = 0;
		$this->NewComments = 0;
		$this->Status = 'Unread';
		$this->LastPage = 1;
		$this->UserDiscussionCount = 0;
		$this->WhisperUserID = 0;
		$this->WhisperUsername = '';
		$this->CountWhispersTo = 0;
		$this->CountWhispersFrom = 0;
		$this->Body = '';
		$this->Url = '';
	}

	function Discussion() {
		$this->Name = 'Discussion';
		$this->Clear();
	}

	// Retrieve properties from current DataRowSet
	function GetPropertiesFromDataSet($DataSet) {
		$this->DiscussionID = @$DataSet['DISCUSSIONID'];
		$this->FirstCommentID = @$DataSet['FIRSTCOMMENTID'];
		$this->CategoryID = @$DataSet['CATEGORYID'];
		$this->Category = @$DataSet['CATEGORY'];
		$this->AuthUserID = @$DataSet['AUTHUSERID'];
		$this->AuthUsername = @$DataSet['AUTHUSERNAME'];
		$this->LastUserID = @$DataSet['LASTUSERID'];
		$this->LastUsername = @$DataSet['LASTUSERNAME'];
		$this->Active = @$DataSet['ACTIVE'];
		$this->Closed = @$DataSet['CLOSED'];
		$this->Sticky = @$DataSet['STICKY'];
		$this->Bookmarked = @$DataSet['BOOKMARKED'];
		$this->Sink = @$DataSet['SINK'];
		$this->Name = @$DataSet['NAME'];
		$this->DateCreated = TimeDiff(UnixTimestamp(@$DataSet['DATECREATED']));
		$this->DateLastActive = TimeDiff(UnixTimestamp(@$DataSet['DATELASTACTIVE']));
		$this->CountComments = @$DataSet['COUNTCOMMENTS'];
		$this->Body = FormatStringForDisplay(@$DataSet['BODY'], true, true);
		$this->Url = @$DataSet['URL'];

		$this->CountReplies = $this->CountComments - 1;
		if ($this->CountReplies < 0) $this->CountReplies = 0;
		$this->LastViewed = UnixTimestamp(@$DataSet['LASTVIEWED']);
		$this->LastViewCountComments = @$DataSet['LASTVIEWCOUNTCOMMENTS'];
		if ($this->LastViewed != '') {
			$this->NewComments = $this->CountComments - $this->LastViewCountComments;
			if ($this->NewComments < 0) $this->NewComments = 0;
		} else {
			$this->NewComments = $this->CountComments;
		}
		$this->Status = $this->GetStatus();
		
		// Define the last page
      $TmpCount = ($this->CountComments / 20/*$Configuration['COMMENTS_PER_PAGE']*/);
		$RoundedCount = intval($TmpCount);
		if ($TmpCount > 1) {
			if ($TmpCount > $RoundedCount) {
				$this->LastPage = $RoundedCount + 1;
			} else {
				$this->LastPage = $RoundedCount;
			}
		} else {
			$this->LastPage = 1;
		}
	}	
	
	function GetStatus() {
		$sReturn = '';
		if (!$this->Active) $sReturn = ' Hidden';
      if ($this->WhisperUserID > 0) $sReturn .= ' Whispered';
		if ($this->Closed) $sReturn .= ' Closed';
		if ($this->Sticky) $sReturn .= ' Sticky';
		if ($this->Bookmarked) $sReturn .= ' Bookmarked';
		if ($this->Sink) $sReturn .= ' Sink';
		if ($this->LastViewed != '') {
			$sReturn .= ' Read';
		} else {
			$sReturn .= ' Unread';
		}
		if ($this->NewComments > 0) {
			$sReturn .= ' NewComments';
		} else {
			$sReturn .= ' NoNewComments';
		}
		//$this->DelegateParameters['StatusString'] = &$sReturn;
		//$this->CallDelegate('GetStatus');
		return $sReturn;
	}
}

?>