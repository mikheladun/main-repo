		<table class="Subheader" border="0" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<th>
					<dl>
<?php if($_SERVER['REQUEST_URI'] == "/news/") { ?>
						<dt>News</dt>
<?php } else { ?>
						<dt><a href="/news/">News</a></dt>
<?php } if( isset($_REQUEST['cc']) && isset($rss) && isset($rss->channel['title']) ) { ?>
						<dt class="End"><?=strtoupper($rss->channel['title'])?></dt>
<?php } ?>
					</dl>
				</th>
			</thead>
		</table>