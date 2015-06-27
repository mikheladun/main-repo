<?php if(eregi("^contact", $page->id)) : include("contact-form.php"); ?>
<?php else :?>
 <ul class="float left">
    <li><a href="#"><img src="/images/img00061_80x60.jpg" title="" alt="" border="0" /></a></li>
    <li><a href="#"><img src="/images/img00062_80x60.jpg" title="" alt="" border="0" /></a></li>
    <li><a href="#"><img src="/images/img00065_80x60.jpg" title="" alt="" border="0" /></a></li>
    <li>
        <a href="#">
<?php if(eregi("^about", $page->id)) : ?>
            <img src="/images/img00064_80x60.jpg" title="" alt="" border="0" />
<?php else :?>
            <img src="/images/img00060_80x60.jpg" title="" alt="" border="0" />
<?php endif; ?>
        </a>
    </li>
 </ul>
 <div class="float left">
    <a href="#" class="block">
<?php if(eregi("^about", $page->id)) : ?>
        <img src="/images/img00060_320x240.jpg" title="" alt="" border="0" />
<?php else :?>
        <img src="/images/img00064_320x240.jpg" title="" alt="" border="0" />
<?php endif; ?>
    </a>
 </div>
 <div class="clear"></div>
 <div class="showcase"><strong>PROJECTS / GALLERY<br/>SHOWCASE</strong></div>
<?php endif; ?>