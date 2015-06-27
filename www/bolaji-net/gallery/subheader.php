		<table class="Subheader" border="0" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<th>
					<dl>
<?php if($_SERVER['REQUEST_URI'] == "/photos/") { ?>
						<dt>Photos</dt>
<?php } else { ?>
						<dt><a href="/photos/">Photos</a></dt>
<?php } if( isset($_REQUEST['cc']) && !empty($_REQUEST['cc']) ) { ?>
						<dt class="End"><?=strtoupper($_REQUEST['cc'])?></dt>
<?php } ?>
					</dl>
				</th>
			</thead>
		</table>