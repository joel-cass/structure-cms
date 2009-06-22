<?php
include_once (getRootPath() . "/structureCMS/classes/core/Page.php");
include_once (getRootPath() . "/structureCMS/classes/core/Layout.php");

if ( array_key_exists("node", $_REQUEST) ) {
	$strNode = stripslashes( $_REQUEST["node"] );
} else {
	$strNode = "/home";
}

$objPage = new Page($strNode);

$strLayout = $objPage->getLayout()->name;

$aryLayouts = Layout::getLayouts();

$aryPlaceholders = $objPage->getLayout()->getPlaceHolders();
$aryPagePlaceholders = $objPage->getPlaceHolders();

$aryViewsSelected = array();
$aryViewsAvailable = array();

foreach ($aryPagePlaceholders as $ph) {
	$strName = strToLower($ph->name);
	$aryViews = $ph->getViews();
	$aryViewsSelected[$strName] = array();
	foreach($aryViews as $v) {
		$aryViewsSelected[$strName][] = $v->path;
	}
}

foreach ($aryPlaceholders as $strName) {
	$strName = strToLower($strName);
	$aryViewsAvailable[$strName] = PlaceHolder::getViewsAvailable($strName);
}

?>
