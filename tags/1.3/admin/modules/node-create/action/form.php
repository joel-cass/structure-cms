<?php
include_once (getRootPath() . "/classes/core/Page.php");
include_once (getRootPath() . "/classes/core/ContentType.php");

if ( array_key_exists("node", $_REQUEST) ) {
	$strNode = stripslashes( $_REQUEST["node"] );
} else {
	$strNode = "/home";
}

if ($strNode == "") {
	$strName = "[root]";
} else {
	$strName = $strNode;
}

if (Page::isPage($strNode)) {
	$objPage = new Page($strNode);
	$objType = $objPage->getContentTypeObject();
	$strType = $objType->name;
} else {
	$strType = "content";
}
	
$aryTypes = ContentType::getContentTypes();

?>
