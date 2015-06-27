		<table class="Subheader" border="0" cellpadding="0" cellspacing="0" width="100%">
			<thead>
				<th>
					<dl>
<?php if($_SERVER['REQUEST_URI'] == "/music/") { ?>
						<dt>Music</dt>
<?php } else { ?>
						<dt><a href="/music/">Music</a></dt>
<?php } ?>
<?php if($_REQUEST['cc'] == "videos" && !isset($_REQUEST['aid'])) { ?>
						<dt class="End">Music Videos</dt>
<?php } elseif($_REQUEST['cc'] == "browse" && !isset($_REQUEST['cn'])) { ?>
						<dt><a href="/music/browse/">Browse</a></dt>
						<dt class="End">Artists</dt>
<?php } elseif($_REQUEST['cc'] == "browse" && $_REQUEST['cn'] == "videos") { ?>
						<dt><a href="/music/browse/">Browse</a></dt>
						<dt class="End">Music Videos</dt>
<?php } elseif($_REQUEST['cc'] == "browse" && ($_REQUEST['cn'] != "videos")) { ?>
						<dt><a href="/music/browse/">Browse</a></dt>
						<dt><a href="/music/browse/">Artists</a></dt>
						<dt class="End"><?=$_REQUEST['cn']?></dt>
<?php } elseif($_REQUEST['cc'] != "browse" && isset($_REQUEST['aid'])) { ?>
						<dt><a href="/music/browse/">Artists</a></dt>
						<dt class="End"><?=substr(strtoupper($Artist->Name),0,30)?></dt>
<?php } elseif($_REQUEST['cc'] != "browse" && $_REQUEST['cn'] != "videos" && $_REQUEST['cn'] != "artist" && (isset($_REQUEST['sid']) || isset($_REQUEST['vid'])) ) { ?>
						<dt class="End"></dt>
<?php } ?>
					</dl>
				</th>
			</thead>
		</table>