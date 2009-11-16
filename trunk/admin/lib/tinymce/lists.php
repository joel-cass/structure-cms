<?php 

require "application.php";

header("content-type: text/javascript");

if (array_key_exists("type",$_GET) && array_key_exists($_GET["type"], $stcTypes)) {
	$stcType = $stcTypes[$_GET["type"]];
	
	$strPath = getRootPath() . "/" . $stcType["path"];
	$strPath = str_ireplace("\\", "/", $strPath);
	$strURL  = getRootURL() . "/" . $stcType["path"];
	$strURL  = str_ireplace("\\", "/", $strURL);

	echo "var " . $stcType["tinyMceVarName"] . " = new Array(";
	
	if (file_exists($strPath)) {
		$aryEntries = scanDir($strPath);
		$blnComma = false;
		for ($i = 0; $i < count($aryEntries); $i++) {
			$strExt = preg_replace("/^.*\./","",$aryEntries[$i]);
			if (array_search($strExt, $stcType["extensions"], true)) {
				if ($blnComma) echo ","; $blnComma = true;
				echo "\r\n\t[\"" . $aryEntries[$i] . "\", \"" . $strURL . "/" . $aryEntries[$i] . "\"]";
			}
		}
	}
		
	echo "\r\n);";
}

?>