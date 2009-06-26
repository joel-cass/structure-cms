<?php
include_once (getRootPath() . "/classes/core/Page.php");
include_once (getRootPath() . "/classes/core/Layout.php");

$strNode = stripslashes( $_REQUEST["node"] );
$objPage = new Page($strNode);

foreach ($_POST["placeholders"] as $strPlaceHolder) {
	$aryField = $_POST["placeholder_" . $strPlaceHolder];
	for ($i = 0; $i < count($aryField); $i++) {
		$aryField[$i] = stripslashes( $aryField[$i] ); 
	}
	$objPage->getPlaceholder($strPlaceHolder)->setViews ( $aryField );
}

if ($_POST["layout"] != $_POST["old-layout"]) {
	$objPage->setLayout( stripslashes( $_POST["layout"] ) );
}

$objPage->save();

$mode = "form";

?>