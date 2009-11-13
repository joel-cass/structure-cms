<?php 
require "application.php";
?>

<?php if (array_key_exists("showForm",$_GET)) { ?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="filedata">
		<input type="submit">
	</form>
<?php } ?>

<?php
if (array_key_exists("filedata", $_FILES) && $_FILES["filedata"] != null && array_key_exists("type", $_GET) && array_key_exists($_GET["type"], $stcTypes)) {
	try {
		$stcType = $stcTypes[$_GET["type"]];
		$fldUpload = $_FILES["filedata"];
		$strDest = getRootPath() . "/" . $stcType["path"];
		$strURL = getRootURL() . "/" . $stcType["path"];
		$strName = ereg_replace("[^A-Za-z0-9\.]", "-", $fldUpload["name"]);
		$strExt = preg_replace("/^.*\./","",$strName);
		
		// check for existing file
		if (array_search($strExt, $aryDenyFileExt, true)) {
			header(null,null,599);
			echo "{error:Files of that type are not allowed to be uploaded. Sorry.}";
			exit();
		}
		
		// make directory if it doesn't exist
		if (!file_exists($strDest)) {
			$aryDir = split("/",$strDest);
			$strTmp  = "";
			for ($i = 0; $i < count($aryDir); $i++) {
				$strTmp = $strTmp . $aryDir[$i] . "/";
				if ((!file_exists($strTmp))) {
					mkdir($strTmp);
				}
			}
		}
				
		// fancy action: make files unique
		$strOrigName = $strName;
		$i = 1;
		while (file_exists("$strDest/$strName")) {
			$strName = ereg_replace("(\.[^\.]*)$", "_$i\\1", $strOrigName);
			$i++;
		}
		
		// copy file
		copy($fldUpload["tmp_name"], "$strDest/$strName");
			
		echo "{name:\"$strName\",path:\"$strURL/$strName\"}";
		exit();
		
	} catch (Exception $e) {
		header(null,null,598);
		echo "{error:" . $e->getMessage() . "}";
		exit();
	}
} else {
	header(null,null,597);
	echo "{error:invalid upload type or no file provided}";
	exit();
}

?>