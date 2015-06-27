<div id="Nav">
	<ul>
		<li class="<?php echo $_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'],0,6) == '/main/' ? "Current Main" : "" ?>"><a href="/">Home</a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,7) == '/music/' ? "Current" : "" ?>"><a href="/music/">Music</a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,7) == '/video/' ? "Current" : "" ?>"><a href="/video/">Videos</a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,8) == '/photos/' ? "Current" : "" ?>"><a href="/photos/">Photos</a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,6) == '/news/' ? "Current" : "" ?>"><a href="/news/">News</a></li>
		<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,13) == '/marketplace/' ? "Current End" : "End" ?>"><a href="/marketplace/">Store</a></li>
	</ul>
</div>
