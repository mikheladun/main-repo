<?php

// check captcha post form field, return 1 if OK
// it is case-insensitive.
  if (isset($_POST['verification']))
  {
	  $userletters = strtoupper($_POST['verification']);
	  session_start();
	  if (!isset($_SESSION['captcha_string']))
		return 0;
	  if ($userletters === strtoupper($_SESSION['captcha_string'])) {
		// make sure that the code is only used once
		unset($_SESSION['captcha_string']);
		echo "PASSED";
	  }
  }

?>


<html>
<body>
captcha-string: <?php echo $_SESSION['captcha-string'] ?>
</body>
<html>