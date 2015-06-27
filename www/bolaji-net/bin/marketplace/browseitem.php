	<dl class="Mktplc">
		<dd style="width:98%;">
		<?php if(!empty($MarketplaceInfo->ImageUrl)) { ?>
		<a href="/marketplace/view/<?=$Link?><?=$MarketplaceInfo->ItemID?>"><img style="margin-right:1em;" border="0" src="/Assets/marketplace/listing/<?=$MarketplaceInfo->ImageUrl?>" alt="" height="75" align="left" /></a>
		<?php 	} ?>	
			<h3><a href="/marketplace/view/<?=$Link?><?=$MarketplaceInfo->ItemID?>"><?=$MarketplaceInfo->Title?></a></h3>
			<p class="Caption"><?=nl2br(substr($MarketplaceInfo->Description,0,200))?><?=strlen($MarketplaceInfo->Description) > 200 ? "..." : ""?></p>
		</dd>
	</dl>
	<div class="Spacer"></div>