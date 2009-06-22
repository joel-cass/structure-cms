<?php

require_once getRootPath() . "/structureCMS/classes/core/Page.php";

if ( array_key_exists("node", $_REQUEST) ) {
	$strNode = stripslashes( $_REQUEST["node"] );
} else {
	$strNode = "/home";
}

$objPage = new Page($strNode); 
$objContentType = $objPage->getContentTypeObject();

$strType = $objContentType->getName();
$strName = $objPage->getName();

$aryTypes = ContentType::getContentTypes();
$aryFields = $objContentType->getFields();

if ( !isset($aryInvalid) ) {
	$aryInvalid = array();
}

$blnActive = $objPage->getActive(); 

?>
