<!-- stub for validation -->

<?php 
$strNode = $_GET["node"];
$strConfirm = $_POST["button"];
if ($strConfirm == "Delete Node") {
	$mode = "save";
} else {
	$mode = "cancel";
}
?>