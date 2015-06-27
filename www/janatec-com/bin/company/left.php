        <h2><a href="/company/">Company</a></h2>
		<?php 
			if(eregi('\/company\/[partners]+\/',$_SERVER['REQUEST_URI']))
			{
				$nav = 'part';
			}
			elseif(eregi('\/company\/[about|vision|focus|commitment]+\/',$_SERVER['REQUEST_URI']))
			{
				$nav = 'comp';
			}
			else 
			{
				$nav = 'comp';
			}
		?>	
        <dl>
          <dt class="<?= $nav == 'comp' ? "Current" : "Current" ?>"><a href="/company/">Company Information</a></dt>
		  <dd class="<?= $nav == 'comp' ? "Current" : "Current" ?>">
				<ul>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,15) == '/company/about/' ? "Current" : "" ?>"><a href="/company/about/">About Us</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,16) == '/company/vision/' ? "Current" : "" ?>"><a href="/company/vision/">Vision and Mission</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,16) == '/company/values/' ? "Current" : "" ?>"><a href="/company/values/">Our Values</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,15) == '/company/focus/' ? "Current" : "" ?>"><a href="/company/focus/">Our Focus</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,20) == '/company/commitment/' ? "Current End" : "End" ?>"><a href="/company/commitment/">Commitment to Quality</a></li>
				</ul>
		  </dd>
          <dt class="<?= $nav == 'part' ? "Current" : "" ?>"><a href="/company/partners/">Partnerships &amp; Alliances</a></dt>
        </dl>