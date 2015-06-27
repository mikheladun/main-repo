<?php
 $page = !isset($_REQUEST['pp']) ? 1 : intval($_REQUEST['pp']);

 $pageTotalCount = $itemsTotalCount;
 $pagingMax = $AppContext->Configuration["PAGING_DISPLAY_MAX"];
 $pageMax = ceil($pageTotalCount / $AppContext->Configuration["PAGING_OFFSET"]);
 $pageCount = 1;
 $page = min(max($page, 1), $pageMax);
 if($page >= $AppContext->Configuration["PAGING_DISPLAY_MAX"])
 {
	//$pageCount = max($page - $PAGING_DISPLAY_MAX + 5, 1);
	//$pagingMax = $pageCount + $PAGING_DISPLAY_MAX + 1;
	$pagingMax = max($pageCount, min($pageMax, $page + 4));
	$pageCount = min($pagingMax, $pagingMax - 9);
	//echo "pageCount: $pageCount min(pageMax,pagingMax): ",min($pageMax, $pagingMax);
 }

 $pageNumLink = $ContextPath."";
 $pageLink = $ContextPath."$page";

 //echo "<p>pagingMax=",$pagingMax," pageCount=",$pageCount," page=",$page," pageTotalCount=",$pageTotalCount," pageMax=",$pageMax,"<p>";
 if($pageMax > 1)
 {
?>
<div class="Paging" align="center">
<?php //print "page[$page] pageMax[$pageMax] pagingMax[$pagingMax] pageRm[$pageRm] pageCount[$pageCount]";?>
<?php if($page > 1) { ?><a href="<?=("$pageNumLink".max($page-1, 1)) ?>">&lt;&nbsp;PREV</a>
<?php } else {?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>

<?php 	if ($pagingMax > $AppContext->Configuration["PAGING_DISPLAY_MAX"]) { ?><a href="<?="$pageNumLink"."1"?>">1</a><a href="<?="$pageNumLink"."2"?>">2</a>...&nbsp;&nbsp;<?php } ?>

<?php while($pageCount < min($pageMax, $pagingMax)) { ?>
<?php 	if ($pageCount == $page) { ?><a class="Current" href="<?=("$pageNumLink$pageCount")?>"><?=$pageCount?></a>
<?php 	} else { ?><a href="<?=("$pageNumLink$pageCount")?>"><?=$pageCount?></a><?php } ?>
<?php 	$pageCount++; } ?>

<?php 	if ($pageCount == $page) { ?><a class="Current" href="<?=("$pageNumLink$pageCount")?>"><?=$pageCount?></a>
<?php 	} else { ?><a href="<?=("$pageNumLink$pageCount")?>"><?=$pageCount?></a><?php } ?>

<?php 	if ($page < $pageMax && $pageMax > $AppContext->Configuration["PAGING_DISPLAY_MAX"] ) { ?>
<?php		if($pagingMax <= $pageMax - 2) { ?>...&nbsp;&nbsp;<a href="<?=("$pageNumLink".($pageMax-1))?>"><?=$pageMax-1?></a><a href="<?=("$pageNumLink$pageMax")?>"><?=$pageMax?></a>
<?php		} else if($pagingMax < $pageMax) { ?>...&nbsp;&nbsp;<a href="<?=("$pageNumLink$pageMax")?>"><?=$pageMax?></a><?php } } ?>

<?php if($page < $pageMax) { ?><a href="<?=("$pageNumLink".min($page + 1, $pageMax))?>">NEXT&nbsp;&gt;</a>
<?php } else {?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
</div>
<?php } ?>