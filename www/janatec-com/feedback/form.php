<?php require_once(dirname(__FILE__)."/../parlance/framework/core/Framework.Class.Utils.php"); ?>
<p>Please complete the request form below.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small class="GryTxt">** all fields are required</small></p>
<div id="ReqResDiv"></div>
<form action="/feedback/" onsubmit="Req(this,'/feedback/feedback.php');return false;" method="post">
	<p><?=FormLabel($AppContext, 'Name')?>&nbsp;&nbsp;<span id="NameError" class="GrnTxt"></span><br/><input class="Input" type="text" name="name" size="20" style="width:400px;" value="" tabindex="1" maxlength="100"/>
	</p>
	<p><?=FormLabel($AppContext, 'Email')?>&nbsp;&nbsp;<span id="EmailError" class="GrnTxt"></span><br/><input class="Input" type="text" name="email" size="20" style="width:400px;" value="" tabindex="2" maxlength="100"/>
	</p>
	<p><?=FormLabel($AppContext, 'Feedback')?>&nbsp;&nbsp;<span id="RequestError" class="GrnTxt"></span><br/><textarea class="Input" name="request" rows="10" cols="15" wrap="soft" style="width:400px;" tabindex="3"></textarea></p>
	<p align="right"><input type="submit" class="Button" name="submit" value="Submit" /></p>
</form>