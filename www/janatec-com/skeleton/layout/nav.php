<div id="Nav" align="center">
	<ul>
		<li class="<?php echo $_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'],0,6) == '/main/' ? "Current Main" : "" ?>"><a href="/"><img src="/images/nav_home_on.gif" border="0" alt="home" title="home" /></a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,10) == '/services/' ? "Current" : "" ?>"><a href="/services/"><img src="/images/nav_services_on.gif" border="0" alt="services" title="services" /></a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,11) == '/solutions/' ? "Current" : "" ?>"><a href="/solutions/"><img src="/images/nav_solutions_on.gif" border="0" alt="solutions" title="solutions" /></a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,9) == '/company/' ? "Current" : "" ?>"><a href="/company/"><img src="/images/nav_company_on.gif" border="0" alt="company" title="company" /></a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,9) == '/contact/' ? "Current" : "" ?>"><a href="/contact/"><img src="/images/nav_contact_on.gif" border="0" alt="contact" title="contact" /></a></li>
	</ul>
</div>