		<table class="Subheader" border="0" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<th>
					<dl>
<?php if($_SERVER['REQUEST_URI'] == "/news/") { ?>
						<dt>Videos</dt>
<?php } else { ?>
						<dt><a href="/video/">Videos</a></dt>
<?php } if( isset($_REQUEST['cc']) && !empty($_REQUEST['cc']) && strtolower($_REQUEST['cc']) == "browse" ) { ?>
						<dt class="End"><?=strtoupper($_REQUEST['cc'])?></dt>
<?php } ?>
					</dl>
				</th>
			</thead>
		</table>