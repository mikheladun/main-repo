<?php

class Utils
{
	function SplitQuote($s)
	{
		$r = Array();
		$p = 0;
		$l = strlen($s);
		while ($p < $l) {
			while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
			if ($s[$p] == '"') {
				$p++;
				$q = $p;
				while (($p < $l) && ($s[$p] != '"')) {
					if ($s[$p] == '\\') {
						$p+=2; continue;
					}
					$p++;
				}
				$r[] = stripslashes(substr($s, $q, $p-$q));
				$p++;
				while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
				$p++;
			} else if ($s[$p] == "'") {
				$p++;
				$q = $p;
				while (($p < $l) && ($s[$p] != "'")) {
					if ($s[$p] == '\\') {
						$p+=2; continue;
					}
					$p++;
				}
				$r[] = stripslashes(substr($s, $q, $p-$q));
				$p++;
				while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
				$p++;
			} else {
				$q = $p;
				while (($p < $l) && (strpos(",;",$s[$p]) === false)) {
					$p++;
				}
				$r[] = stripslashes(trim(substr($s, $q, $p-$q)));
				while (($p < $l) && (strpos(" \r\t\n",$s[$p]) !== false)) $p++;
				$p++;
			}
		}
		return $r;
	}
	function isEmpty($value)
	{
		return ( !isset($value) || empty($value) ) ? true : false;
	}
	function IfNullPrintEmpty($val)
	{
		return !isset($val) || empty($val) ? "" : $val;
	}
	function FormError(&$AppContext, $elem)
	{
		//isset($AppContext->ErrorMessage['MemberName'])?Error(0,AppContext->ErrorMessage['MemberName'],"span"):""
		return Message($AppContext, $elem);
	}
	function FormLabel(&$AppContext, $elem, $label=false, $style=false)
	{
		$class = isset($AppContext->ErrorMessage[$elem]) && !empty($AppContext->ErrorMessage[$elem]) ? "error" : "label";
		return "<span class=\"$class\" style=\"$style\">".(!$label ? $elem : $label)."</span>";
	}
	function Message(&$AppContext, $elem, $tag = true)
	{
		$msg = "";
		if(isset($AppContext->ErrorMessage[$elem]) && !empty($AppContext->ErrorMessage[$elem]))
		{
			$msg = $AppContext->ErrorMessage[$elem];
			if($tag)
			{
				$msg = "<span class=\"error\">$msg</span>";
			}
		}
		return $msg;
	}

	function TruncateString($str, $max=15, $ellip='&hellip;')
	{
		$pattern3 = "/.{".($max+3)."}/i";
		$pattern = "/.{".($max)."}/i";
		if(strpos($str, '/'))
		{
			if(preg_match($pattern3, $str, $matches))
			{
				$str = substr($matches[0], 0, strpos($matches[0], '/')-1);
				return Utils::TruncateString($str, $max, $ellip);
			}
			else
			{
				return $str;
			}
		}
		else
		{
			if(preg_match($pattern3, $str, $matches))
			{
				preg_match($pattern, $matches[0], $matches);
				return $matches[0] . $ellip;
			}
			elseif(preg_match($pattern, $str, $matches))
			{
				return $matches[0];
			}
			else
			{
				return $str;
			}
		}
	}

	// Formats a value so it's safe to insert into the database
	function FormatStringForDatabaseInput($inValue, $bStripHtml = '0') {
		$bStripHtml = Utils::ForceBool($bStripHtml, 0);
		// $sReturn = stripslashes($inValue);
		$sReturn = $inValue;
		if ($bStripHtml) $sReturn = trim(strip_tags($sReturn));
		//return MAGIC_QUOTES_ON ? $sReturn : addslashes($sReturn);
		//return $sReturn;
		return addslashes($sReturn);
	}

	// Takes a user defined string and formats it for page display.
	// You can optionally remove html from the string.
	function FormatStringForDisplay($inValue, $bStripHtml = true, $AllowEncodedQuotes = true) {
		$sReturn = trim($inValue);
		if ($bStripHtml) $sReturn = strip_tags($sReturn);
		if (!$AllowEncodedQuotes) $sReturn = preg_replace("/(\"|\')/", '', $sReturn);
		global $Configuration;
		$sReturn = htmlspecialchars($sReturn, ENT_QUOTES, 'iso-8859-1');//)$Configuration['CHARSET']);
		if ($bStripHtml) $sReturn = str_replace("\r\n", "<br />", $sReturn);
		return $sReturn;
	}

	// Force a boolean value
	// Accept a default value if the input value does not represent a boolean value
	function ForceBool($InValue, $DefaultBool) {
		// If the invalue doesn't exist (ie an array element that doesn't exist) use the default
		if (!$InValue) return $DefaultBool;
		$InValue = strtoupper($InValue);
		if ($InValue == 1) {
			return 1;
		} elseif ($InValue === 0) {
			return 0;
		} elseif ($InValue == 'Y') {
			return 1;
		} elseif ($InValue == 'N') {
			return 0;
		} elseif ($InValue == 'TRUE') {
			return 1;
		} elseif ($InValue == 'FALSE') {
			return 0;
		} else {
			return $DefaultBool;
		}
	}

	// Take a value and force it to be an integer.
	function ForceInt($InValue, $DefaultValue) {
		$iReturn = intval($InValue);
		return ($iReturn == 0) ? $DefaultValue : $iReturn;
	}
	// Take a value and force it to be a string.
	function ForceString($InValue, $DefaultValue) {
		if (is_string($InValue)) {
			$sReturn = trim($InValue);
			if (empty($sReturn) && strlen($sReturn) == 0) $sReturn = $DefaultValue;
		} else {
			$sReturn = $DefaultValue;
		}
		return $sReturn;
	}
	function UnserializeArray($InSerialArray) {
		$aReturn = array();
		if ($InSerialArray != '' && !is_array($InSerialArray)) {
			$aReturn = unserialize($InSerialArray);
			if (is_array($aReturn)) {
				$Count = count($aReturn);
				$i = 0;
				for ($i = 0; $i < $Count; $i++) {
					$aReturn[$i] = array_map('Strip_Slashes', $aReturn[$i]);
				}
			}
		}
		return $aReturn;
	}

	function UnserializeAssociativeArray($InSerialArray) {
		$aReturn = array();
		if ($InSerialArray != '' && !is_array($InSerialArray)) {
			$aReturn = @unserialize($InSerialArray);
			if (!is_array($aReturn)) $aReturn = array();
		}
		return $aReturn;
	}

	function FormatDate($format,$time)
	{
	 return (date($format, $time));
	}

	// Convert a datetime to a timestamp
	function UnixTimestamp($DateTime) {
		if (preg_match('/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/', $DateTime, $Matches)) {
			$Year = $Matches[1];
			$Month = $Matches[2];
			$Day = $Matches[3];
			$Hour = $Matches[4];
			$Minute = $Matches[5];
			$Second = $Matches[6];
			return mktime($Hour, $Minute, $Second, $Month, $Day, $Year);

		} elseif (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $DateTime, $Matches)) {
			$Year = $Matches[1];
			$Month = $Matches[2];
			$Day = $Matches[3];
			return mktime(0, 0, 0, $Month, $Day, $Year);
		}
	}

	function TimeDiff($Time, $TimeToCompare = '') {
		if ($TimeToCompare == '') $TimeToCompare = time();
		$Difference = $TimeToCompare-$Time;
		$Days = floor($Difference/60/60/24);
		$Hours = floor(($Difference - ($Days*60*60*24))/60/60);
		$Minutes = floor(($Difference - ($Hours*60*60))/60);
		$Seconds = $Difference - ($Minutes*60);

		if ($Days > 7) {
			return date("M jS Y"/*$Context->GetDefinition('OldPostDateFormatCode')*/, $Time); // m-d-y g:i a
		} elseif ($Days > 1) {
			return str_replace('//1', $Days, "//1 days ago"/*$Context->GetDefinition('XDaysAgo')*/);
		} elseif ($Days == 1) {
			return str_replace('//1', $Days, "//1 day ago"/*$Context->GetDefinition('XDayAgo')*/);
		} else {

			if ($Hours > 1) {
				return str_replace('//1', $Hours, "//1 hours ago"/*$Context->GetDefinition('XHoursAgo')*/);
			} elseif ($Hours == 1) {
				return str_replace('//1', $Hours, "//1 hour ago"/*$Context->GetDefinition('XHourAgo')*/);
			} else {

				if ($Minutes > 1) {
					return str_replace('//1', $Minutes, "//1 minutes ago"/*$Context->GetDefinition('XMinutesAgo')*/);
				} elseif ($Minutes == 1) {
					return str_replace('//1', $Minutes, "//1 minute ago"/*$Context->GetDefinition('XMinuteAgo')*/);
				} else {

					if ($Seconds == 1) {
						return str_replace('//1', $Seconds, "//1 seconds ago"/*$Context->GetDefinition('XSecondAgo')*/);
					} else {
						return str_replace('//1', $Seconds, "//1 second ago"/*$Context->GetDefinition('XSecondsAgo')*/);
					}
				}
			}
		}
	}
	// This function is compliments of Entriple on the Lussumo Community
	function DefineVerificationKey() {
		return md5(
				sprintf(
						'%04x%04x%04x%03x4%04x%04x%04x%04x',
						mt_rand(0, 65535),
						mt_rand(0, 65535),
						mt_rand(0, 4095),
						bindec(substr_replace(sprintf('%016b', mt_rand(0, 65535)), '01', 6, 2)),
						mt_rand(0, 65535),
						mt_rand(0, 65535),
						mt_rand(0, 65535),
						mt_rand(0, 65535)
				)
		);
	}
	function GetRemoteIp($FormatIpForDatabaseInput = '0') {
		$FormatIpForDatabaseInput = ForceBool($FormatIpForDatabaseInput, 0);
		$sReturn = ForceString(@$_SERVER['REMOTE_ADDR'], '');
		if (strlen($sReturn) > 20) $sReturn = substr($sReturn, 0, 19);
		if ($FormatIpForDatabaseInput) $sReturn = FormatStringForDatabaseInput($sReturn, 1);
		return $sReturn;
	}
	function ContextPath($RequestURI)
	{
		return substr($RequestURI, 0, strpos($RequestURI,'/',1));
	}

	function GetFiles($directory)
	{
		// Try to open the directory
		if(file_exists($directory))
		{
			if($dir = opendir($directory))
			{
				// Create an array for all files found
				$tmp = Array();
				// Add the files
				while($file = readdir($dir))
				{
					// Make sure the file exists
					if($file != "." && $file != ".." && $file[0] != '.')
					{
						// If it's a directiry, list all files within it
						if(is_dir($directory . "/" . $file))
						{
							$tmp2 = Utils::getFiles($directory . "/" . $file);
							if(is_array($tmp2))
							{
								$tmp = array_merge($tmp, $tmp2);
							}
						} else {
							array_push($tmp, $directory . "/" . $file);
						}
					}
				}

				// Finish off the function
				closedir($dir);
				return $tmp;
			}
		}
	}
}
?>