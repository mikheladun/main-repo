<div class="ContentDiv">
	<div class="FloatLeft" style="width:50%;">
<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
 $Response = $Service->Execute($AppContext, "GetCategoryList", $Params);
 if($Response->Success)
 {
 	$Categories = $Response->Object;
	 $Mktplc = '';
	 $Count = 1;
	 $Count2 = 1;
	 foreach ($Categories as $Category)
	 {
	 	$Count2++;
		if(!isset($SubCategory))
		{
			$SubCategory = "<a class=\"BluTxt\" href=\"/marketplace/$Category->ParentNameID/$Category->NameID/\">$Category->Name</a>,&nbsp;";
			$Parent = $Category->ParentID;
		}
		elseif($Category->ParentID == $Parent)
		{
			$SubCategory .= "<a class=\"BluTxt\" href=\"/marketplace/$Category->ParentNameID/$Category->NameID/\">$Category->Name</a>,&nbsp;";
		}
		else
		{
			$Mktplc .= "<li><a href=\"/marketplace/$PreviousCategory->ParentNameID/\">$PreviousCategory->ParentName</a><br/><small>".(substr($SubCategory,0,strlen($SubCategory)-7))."</small></li>";
			$Parent = $Category->ParentID;
			$SubCategory = "<a class=\"BluTxt\" href=\"/marketplace/$Category->ParentNameID/$Category->NameID/\">$Category->Name</a>,&nbsp;";
			$Count++;
		}
	
		if(count($Categories) == $Count)
		{
			$Mktplc .= "<li><a href=\"/marketplace/$PreviousCategory->ParentNameID/\">$PreviousCategory->ParentName</a><br/><small>".(substr($SubCategory,0,strlen($SubCategory)-7))."</small></li>";
			break;
		}

		$PreviousCategory = $Category;

		if($Count == 7)
		{
			break;
		}
	}
?>
	<ul class="Mktplc">
		<?=$Mktplc?>
	</ul>
<?php } ?>
	</div>
	<div class="FloatLeft" style="width:49%;">
<?php
 if($Response->Success)
 {
	 $Mktplc = '';
	 $Count = 1;
	 $Categories = array_splice($Categories, $Count2-2,count($Categories));
	 $SubCategory = '';
	 foreach ($Categories as $Category)
	 {
		if(empty($SubCategory))
		{
			$SubCategory = "<a class=\"BluTxt\" href=\"/marketplace/$Category->ParentNameID/$Category->NameID/\">$Category->Name</a>,&nbsp;";
			$Parent = $Category->ParentID;
		}
		elseif($Category->ParentID == $Parent)
		{
			$SubCategory .= "<a class=\"BluTxt\" href=\"/marketplace/$Category->ParentNameID/$Category->NameID/\">$Category->Name</a>,&nbsp;";
		}
		else
		{
			$Mktplc .= "<li><a href=\"/marketplace/$PreviousCategory->ParentNameID/\">$PreviousCategory->ParentName</a><br/><small>".(substr($SubCategory,0,strlen($SubCategory)-7))."</small></li>";
			$Parent = $Category->ParentID;
			$SubCategory = "<a class=\"BluTxt\" href=\"/marketplace/$Category->ParentNameID/$Category->NameID/\">$Category->Name</a>,&nbsp;";
		}

		if(count($Categories) == $Count)
		{
			$Mktplc .= "<li><a href=\"/marketplace/$PreviousCategory->ParentNameID/\">$PreviousCategory->ParentName</a><br/><small>".(substr($SubCategory,0,strlen($SubCategory)-7))."</small></li>";
		}

		$PreviousCategory = $Category;
		$Count++;
	}
?>
	<ul class="Mktplc">
		<?=$Mktplc?>
	</ul>
	<p class="PaddedBox3"><strong>&nbsp;<a href="/marketplace/events/"><u>FLYERS:</u></a>&nbsp;&nbsp;<a href="/marketplace/events/">Events, Parties, etc</a></strong></p>
<?php } ?>
	</div>
	<div class="Spacer"></div>
</div>
