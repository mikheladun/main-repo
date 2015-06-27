        <h2><a href="/contact/">Contact</a></h2>
        <dl>
          <dt class="<?php echo substr($_SERVER['REQUEST_URI'],0,9) == '/contact/' || substr($_SERVER['REQUEST_URI'],0,9) == '/careers/' ? "Current" : "Current" ?>"><a href="/contact/">Contact Information</a></dt>
		  <dd class="<?php echo $_SERVER['REQUEST_URI'] != '/feedback/' ? "Current" : "Current" ?>">
				<ul>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,17) == '/contact/offices/' ? "Current" : "" ?>"><a href="/contact/offices/">Corporate Offices</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,17) == '/contact/request/' ? "Current" : "" ?>"><a href="/contact/request/">Request Services</a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,9) == '/careers/' ? "Current End" : "End" ?>"><a href="/careers/">Careers</a></li>
				</ul>
		  </dd>
          <dt class="<?php echo substr($_SERVER['REQUEST_URI'],0,10) == '/feedback/' ? "Current" : "" ?>"><a href="/feedback/">Site Feedback</a></dt>
        </dl>