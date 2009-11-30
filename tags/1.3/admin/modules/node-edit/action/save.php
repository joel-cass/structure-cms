<?php

/* !!! Fields set in submit.php */

/* Save Fields */

for ($i = 0; $i < count($aryFields); $i++) {
	$objPage->setField ($aryFields[$i], $aryValues[$i], true);
}

/* Save Details */

if ($strOldContentType != $strContentType) {
	$objPage->setContentType ($strContentType);
}

if ($strOldName != $strName) {
	$objPage->setName ($strName);
	$_REQUEST["node"] = listDeleteAt($strNode, listLen($strNode, "/"), "/") . "/" . $strName;
}

/* Save Options */

if ($blnOldActive != $blnActive) {
	$objPage->setActive($blnActive);
}

/* Commit */

$objPage->save();

//setPageLayout ($strNode, $layout);

//setPageView ($strNode, $placeholder, $index, $path);

$blnRefresh = true;
$mode = "form";

?>