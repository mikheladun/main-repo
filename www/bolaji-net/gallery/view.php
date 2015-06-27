<?php
if(isset($_REQUEST['cc']) && strtolower($_REQUEST['cc']) != "browse")
{
	require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
	$ServiceName = $AppContext->Configuration["SERVICE.NAME.GALLERY"];
	$Service = $AppContext->ServiceRegistry->Lookup($ServiceName);
	$Params->Collid = $_REQUEST['gid'];
	$Params->Photoid = $_REQUEST['pid'];

	if(isset($Params->Collid) && !empty($Params->Collid))
	{
		$Response = $Service->Execute(&$AppContext, "GetPhotoInfo", $Params);
		if($Response->Success)
		{
			if($Response->Object != NULL)
			{
				$Viewable = true;
				$GalleryInfo = $Response->Object[0];
?>
			<big><big class="GrnTxt">&nbsp;<?=$GalleryInfo->Title?></big></big>
			<div class="PaddedBox" style="padding:0;">
				<div class="Paging" style="background:none;margin-right:4em;">
				<? if(isset($GalleryInfo->PrevPhotoID) && !empty($GalleryInfo->PrevPhotoID)) { ?>
					<span class="SmallBold"><a class="PaddedBox BluTxt" href="/photos/view/<?=$GalleryInfo->GalleryID?>/<?=$GalleryInfo->PrevPhotoID?>"><strong>&lt;&nbsp;Prev</strong></a></span>
				<?php } else { ?>
				<span class="SmallBold GryTxt">&lt;&nbsp;Prev</span>
				<?php } if(isset($GalleryInfo->NextPhotoID) && !empty($GalleryInfo->NextPhotoID)) { ?>
					<span class="SmallBold"><a class="PaddedBox BluTxt" href="/photos/view/<?=$GalleryInfo->GalleryID?>/<?=$GalleryInfo->NextPhotoID?>"><strong>Next&nbsp;&gt;</strong></a></span>
				<?php } else { ?>
				<span class="SmallBold GryTxt">Next&nbsp;&gt;</span>
				<?php } ?>
				</div>
				<div class="Divider"></div>
				<div align="center" style="overflow:hidden;">
					<img src="/Assets/photos/<?=$GalleryInfo->Url?>" border="1" hspace="5" vspace="5" /><br/>
					<?=$GalleryInfo->Description?>
				</div>
				<p>&nbsp;</p>
			</div>
<?php
			}
			else
			{
				require_once("browse.php");
			}
		}
	}
	else
	{
		require_once("browse.php");
	}
}
?>