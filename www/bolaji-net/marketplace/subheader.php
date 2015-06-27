		<table class="Subheader" border="0" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<th>
					<dl>
<?php if($_SERVER['REQUEST_URI'] == "/marketplace/") { ?>
						<dt>Marketplace</dt>
<?php } else { ?>
						<dt><a href="/marketplace/">Marketplace</a></dt>
<?php } ?>
<?php if(isset($_REQUEST['cc']) && strtolower($_REQUEST['cc']) == "view") { ?>
<?php 		if(isset($_REQUEST['cid']) && !empty($_REQUEST['cid'])) { ?>
						<dt><a href="/marketplace/<?=$_REQUEST['cn']?>"><?=str_replace("-"," ",$_REQUEST['cn'])?></a></dt>
						<dt class="End"><?=str_replace("-"," ",$_REQUEST['cid'])?></dt>
<?php 		} elseif(isset($_REQUEST['cn']) && !empty($_REQUEST['cn'])) { ?>
						<dt class="End"><?=str_replace("-"," ",$_REQUEST['cn'])?></dt>
<?php 		} ?>
<?php } else{ 
		if(isset($_REQUEST['cn']) && !empty($_REQUEST['cn'])) { ?>
						<dt><a href="/marketplace/<?=$_REQUEST['cc']?>"><?=str_replace("-"," ",$_REQUEST['cc'])?></a></dt>
						<dt class="End"><?=str_replace("-"," ",$_REQUEST['cn'])?></dt>
<?php } elseif(isset($_REQUEST['cc']) && !empty($_REQUEST['cc'])) { ?>
						<dt class="End"><?=str_replace("-"," ",$_REQUEST['cc'])?></dt>
<?php } } ?>
					</dl>
				</th>
			</thead>
		</table>