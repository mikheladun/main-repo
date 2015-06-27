	<p class="PaddedBox4" align="center">
<?php if(isset($_REQUEST['cn']) && !empty($_REQUEST['cn'])) { ?>
			Items found in <strong><?=ucwords(str_replace("-"," ",$_REQUEST['cc']))?>&nbsp;&gt;&nbsp;<?=ucwords(str_replace("-"," ",$_REQUEST['cn']))?></strong>
<?php } else { ?>
			Items found in <strong><?=ucwords(str_replace("-"," ",$_REQUEST['cc']))?></strong>
<?php } ?>
	</p>