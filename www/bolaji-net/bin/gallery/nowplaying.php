<?php
	if($Viewable)
	{
		$Response = $Service->Execute(&$AppContext, "GetPhotoGalleryInfo", $Params);
		if($Response->Success)
		{
			$Counter = 0;
			if($Response->Object != NULL)
			{
?>
<?php
				$Counter = 0;
				foreach($Response->Object as $GalleryInfo)
				{
					if($Counter == 0)
					{
?>
		<h3><?=$GalleryInfo->SetTitle?></h3>
		<p>
<?php
					}				
?>
		<a href="/photos/view/<?=$GalleryInfo->GalleryID?>/<?=$GalleryInfo->PhotoID?>"><img style="padding:.2em;" class="<?= ($GalleryInfo->PhotoID == $Params->Photoid) ? "PaddedBox2" : "PaddedBox"?>" src="/Assets/photos/<?=$GalleryInfo->ThumbURL?>" alt="<?=$GalleryInfo->Title?>" title="<?=$GalleryInfo->Title?>" border="0" vspace="0" hspace="0" /></a>
<?php
				$Counter ++;
				}
			}
?>
		</p>
		<p class="PaddedBox4" align="center">&laquo;&nbsp;<a class="BluTxt" href="/photos/browse/"><strong>Back to Photos</strong></a></p>
<?php
		}
	}
?>