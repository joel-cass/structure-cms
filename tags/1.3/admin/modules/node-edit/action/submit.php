<?php 

require_once getRootPath() . "/classes/core/Page.php";

$strNode = $_REQUEST["node"];

/* Map Parameters to Variables */

$strName = stripslashes( $_REQUEST["name"] );
$strOldName = stripslashes( $_REQUEST["old-name"] );

$strContentType = stripslashes( $_REQUEST["content_type"] );
$strOldContentType = stripslashes( $_REQUEST["old-content_type"] );

$aryInvalid = array();
$aryFields = array();
$aryValues = array();
$numFields = stripslashes( $_REQUEST["numFields"] );

$blnActive = stripslashes( $_REQUEST["active"] );
$blnOldActive = stripslashes( $_REQUEST["old-active"] );

/* Get fields */

for ($i = 0; $i < $numFields; $i++) {
	$aryFields[] = stripslashes( $_REQUEST["field_$i"] );
	if (array_key_exists("value_$i", $_FILES)) {
		$aryValues[] = $_FILES["value_$i"];
	} else {
		$aryValues[] = stripslashes( $_REQUEST["value_$i"] );
	}
}

/* Create Instance */

$objPage = new Page($strNode);

/* Validate */
for ($i = 0; $i < count($aryFields); $i++) {
	$field = $objPage->getField($aryFields[$i]);
	$field->setValue($aryValues[$i]);
	$isValid = $field->validate();
	if ( $isValid != true ) {
		$aryInvalid[$aryFields[$i]] = $isValid;
	}
}

/* Set mode */
if (count($aryInvalid) == 0) {
	$mode = "save";
} else {
	$mode = "form";
}

?>