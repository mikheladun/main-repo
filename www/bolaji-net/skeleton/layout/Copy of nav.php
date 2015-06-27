			<div id="Nav">
				<ul>
					<li class="<?php echo $_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'],0,6) == '/main/' ? "Current" : "" ?>"><a href="/"><img src="/images/images/nav_main_<?php echo $_SERVER['REQUEST_URI'] == '/' || substr($_SERVER['REQUEST_URI'],0,6) == '/main/' ? "on" : "off" ?>.gif" border="0" /></a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,7) == '/music/' ? "Current" : "" ?>"><a href="/music/"><img src="/images/images/nav_music_<?php echo substr($_SERVER['REQUEST_URI'],0,7) == '/music/' ? "on" : "off" ?>.gif" border="0" /></a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,7) == '/video/' ? "Current" : "" ?>"><a href="/video/"><img src="/images/images/nav_video_<?php echo substr($_SERVER['REQUEST_URI'],0,7) == '/video/' ? "on" : "off" ?>.gif" border="0" /></a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,8) == '/photos/' ? "Current" : "" ?>"><a href="/photos/"><img src="/images/images/nav_photo_<?php echo substr($_SERVER['REQUEST_URI'],0,8) == '/photos/' ? "on" : "off" ?>.gif" border="0" /></a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,6) == '/news/' ? "Current" : "" ?>"><a href="/news/"><img src="/images/images/nav_news_<?php echo substr($_SERVER['REQUEST_URI'],0,6) == '/news/' ? "on" : "off" ?>.gif" border="0" /></a></li>
					<li class="<?php echo substr($_SERVER['REQUEST_URI'],0,13) == '/marketplace/' ? "Current" : "" ?>"><a href="/marketplace/"><img src="/images/images/nav_mktplc_<?php echo substr($_SERVER['REQUEST_URI'],0,13) == '/marketplace/' ? "on" : "off" ?>.gif" border="0" /></a></li>
				</ul>
			</div>
