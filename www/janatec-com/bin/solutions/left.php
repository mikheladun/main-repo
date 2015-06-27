        <h2><a href="/solutions/">Solutions</a></h2>
		<?php 
			if(eregi('\/solutions\/lamp\/',$_SERVER['REQUEST_URI']))
			{
				$nav = 'tech';
			}
			else if(eregi('\/solutions\/[enterprise|asset|portals|information|mobile|integration|media]+\/',$_SERVER['REQUEST_URI']))
			{
				$nav = 'entp';
			}
			else if(eregi('\/solutions\/[government|outsourcing|sharedservices]+\/',$_SERVER['REQUEST_URI']))
			{
				$nav = 'govt';
			}
			else if(eregi('\/solutions\/[technology|java|lamp|opensource|parlance]+\/',$_SERVER['REQUEST_URI']))
			{
				$nav = 'tech';
			}
		?>	
        <dl>
          <dt class="<?= $nav == 'entp' ? "Current" : "Current" ?>"><a href="/solutions/enterprise/">Enterprise</a></dt>
		  <dd class="<?= $nav == 'entp' ? "Current" : "Current" ?>">
				<ul>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,17) == '/solutions/asset/' ? "Current" : "" ?>"><a href="/solutions/asset/">Enterprise Asset Management</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,19) == '/solutions/portals/' ? "Current" : "" ?>"><a href="/solutions/portals/">Enterprise Portals</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,23) == '/solutions/information/' ? "Current" : "" ?>"><a href="/solutions/information/">Information Management</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,18) == '/solutions/mobile/' ? "Current" : "" ?>"><a href="/solutions/mobile/">Mobile &amp; Wireless</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,23) == '/solutions/integration/' ? "Current" : "" ?>"><a href="/solutions/integration/">Enterprise Application Integration</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,17) == '/solutions/media/' ? "Current End" : "End" ?>"><a href="/solutions/media/">Media &amp; Entertainment</a></li>
				</ul>
		  </dd>
          <dt class="<?= $nav == 'govt' ? "Current" : "Current" ?>"><a href="/solutions/government/">Government</a></dt>
		  <dd class="<?= $nav == 'govt' ? "Current" : "Current" ?>">
				<ul>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,23) == '/solutions/outsourcing/' ? "Current" : "" ?>"><a href="/solutions/outsourcing/">Outsourcing</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,26) == '/solutions/sharedservices/' ? "Current End" : "End" ?>"><a href="/solutions/sharedservices/">Shared Services</a></li>
				</ul>
		  </dd>
          <dt class="<?= $nav == 'tech' ? "Current" : "Current" ?>"><a href="/solutions/technology/">Technology</a></dt>
		  <dd class="<?= $nav == 'tech' ? "Current" : "Current" ?>">
				<ul>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,16) == '/solutions/java/' ? "Current" : "" ?>"><a href="/solutions/java/">Java</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,17) == '/solutions/lamp/' ? "Current" : "" ?>"><a href="/solutions/lamp/">LAMP</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,22) == '/solutions/opensource/' ? "Current" : "" ?>"><a href="/solutions/opensource/">Open Source</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,20) == '/solutions/parlance/' ? "Current End" : "End" ?>"><a href="/solutions/parlance/">Parlance</a></li>
				</ul>
		  </dd>
        </dl>