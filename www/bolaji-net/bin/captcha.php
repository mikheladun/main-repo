<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
	<form action="/Library/captcha/hkcaptcha-20070620/verify.php" method="post">
				<div class="InputRow">
				<img src="/marketplace/captcha2.jpg" alt="" id="Captcha" /><br/><span class="Label">Enter the code shown above</span>
				<span class="Label">&nbsp;&nbsp;</span><br/>
				<input type="text" name="captcha" size="5" maxlength="5" />
				&nbsp;&nbsp;&nbsp;<a href="#" onclick="captcha_refresh()">Generate new code</a><br>
				<script type="text/javascript">
					  function captcha_refresh() {
					  e=document.getElementById('Captcha');
					  dv=new Date();
					  e.src="/marketplace/captcha2.jpg?dummy=" + dv.getTime();
					  return false;
					}
				</script>				
				<input type="submit" />
				</div>
	</form>
</body>
</html>
