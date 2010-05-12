<?php
include_once (getRootPath() . "/classes/core/Page.php");
include_once (getRootPath() . "/classes/core/Layout.php");

$strNode = stripslashes( $_REQUEST["node"] );
$objPage = new Page($strNode);

foreach ($_POST["placeholders"] as $strPlaceHolder) {
	if (array_key_exists("placeholder_" . $strPlaceHolder, $_POST)) {
		$aryField = $_POST["placeholder_" . $strPlaceHolder];
		$aryPlaceholders = array();
		for ($i = 0; $i < count($aryField); $i++) {
			if ($aryField[$i] != "") {
				$aryPlaceholders[] = stripslashes( $aryField[$i] );
			} 
		}
		$objPage->getPlaceholder($strPlaceHolder)->setViews ( $aryPlaceholders );
	}
}
		
if ($_POST["layout"] != $_POST["old-layout"]) {
	$objPage->setLayout( stripslashes( $_POST["layout"] ) );
}

$objPage->save();

$mode = "form";

?>