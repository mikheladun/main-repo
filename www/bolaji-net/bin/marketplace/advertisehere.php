<div class="ContentDiv">
	<div class="Spacer"><p class="SectionHeader PaddedBox1">Marketplace</p></div>
<?php
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Class.ApplicationContext.php");
 require_once(dirname(__FILE__)."/../Library/Framework/Core/Framework.Utils.php");
 $Service = $AppContext->ServiceRegistry->Lookup($AppContext->Configuration["SERVICE.NAME.MKTPLC"]);
 $Response = $Service->Execute(&$AppContext, "GetTopCategoryList", $Params);
 if($Response->Success)
 {
?>
	<div class="FloatLeft" style="width:50%;">
	<ul class="Mktplc">
<?php
 	 $Categories = array_splice($Response->Object, 0, (count($Response->Object) / 2) - 1);
	 foreach ($Categories as $CategoryInfo)
	 {
?>
		<li><a href="/marketplace/<?=$CategoryInfo->NameID?>/"><?=$CategoryInfo->Name?></a>&nbsp;</li>
<?php
	}
?>
	</ul>
	</div>
	<div class="FloatLeft" style="width:50%;">
	<ul class="Mktplc">
<?php
 	 $Categories = array_splice($Response->Object, count($Response->Object) / 2, count($Response->Object));
	 foreach ($Categories as $CategoryInfo)
	 {
?>
		<li><a href="/marketplace/<?=$CategoryInfo->NameID?>/"><?=$CategoryInfo->Name?></a>&nbsp;</li>
<?php
	}
?>
	</ul>
	</div>
<?php
 }
?>
	<div class="Spacer"></div>
</div>