<?php 
require_once("../../../../../classes/includes/paths.php");

$strServer = "http";
if (array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] == "on") {
	$strServer .= "s";
}
$strServer .= "://";
$strServer .= $_SERVER["HTTP_HOST"];

$strFolder = array_key_exists("folder", $_GET) ? $_GET["folder"] : "";
$strFolder = ereg_replace("../[^/]*", "/", $strFolder);
$strFolder = str_replace("../", "/", $strFolder);

$strUploadPath = getUploadPath() . $strFolder;
$strUploadURL = getUploadURL()  . $strFolder;

$blnUploaded = false;
$strUploadedFile = "";

if (array_key_exists("upload", $_FILES) && $_FILES["upload"] != null) {
	$fldUpload = $_FILES["upload"];
	$strDest = $strUploadPath;
	$strName = ereg_replace("[^A-Za-z0-9\.]", "-", $fldUpload["name"]);
			
	if (!file_exists($strDest)) {
		mkdir($strDest);
	}
			
	// fancy action: make files unique
	$strOrigName = $strName;
	$i = 1;
	while (file_exists("$strDest/$strName")) {
		$strName = ereg_replace("(\.[^\.]*)$", "_$i\\1", $strOrigName);
		$i++;
	}
			
	copy($fldUpload["tmp_name"], "$strDest/$strName");
	
	$blnUploaded = true;
	$strUploadedFile = $strServer . $strUploadURL . $strName;
}

$aryEntries = scanDir($strUploadPath);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Upload</title>
	<link rel="stylesheet" href="../../themes/advanced/skins/default/dialog.css">
	<?php if ($blnUploaded == true) { ?>
	<script type="text/javascript">
	parent.ImageUploadDialog.insert("<?php echo $strUploadedFile;?>");
	</script>
	<?php } ?>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
	<p>
		<label for="fldUpload">Upload File:</label>
		<input type="file" name="upload" id="fldUpload" />
		<input type="hidden" name="folder" value="/" />
	</p>

	<div class="mceActionPanel">
		<input type="submit" id="btnUpload" name="upload" value="Upload" />
	</div>
	
</form>

<p>Files</p>

<table width="100%">
	<?php foreach ($aryEntries as $entry) {
		if ($entry != "." && $entry != "..") {
			$strURL = $strServer . $strUploadURL . $entry;
		?>
		<tr>
			<td><a href="#select" onclick="parent.ImageUploadDialog.insert('<?php echo $strURL;?>'); return false;"><?php echo $entry ?></a></td>
			<td align="right"><a href="<?php echo $strURL ?>" target="preview">Preview</a></td>
		</tr>
		<?php }
	} ?>
</table>

</body>
</html>
