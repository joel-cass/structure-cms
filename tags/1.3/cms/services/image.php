<?php

$strPath = $_GET["p"];
$numWidth = $_GET["w"];
$numHeight = $_GET["h"];
$numMaxWidth = $_GET["mw"];
$numMaxHeight = $_GET["mh"];

$isImage = true;

// check file extension
if ($strExt == "png") {
	$objImage = imagecreatepng($strPath);
} else if ($strExt == "gif") {
	$objImage = imagecreatepng($strPath);
} else if ($strExt == "jpg" || $strExt == "jpeg") {
	$objImage = imagecreatepng($strPath);
} else {
	$isImage = false;
}

if ($isImage) {
	// detect image size
	$numImageWidth = imagex($objImage);
	$numImageHeight = imageu($objImage);
	
	// resize image by w / h
	
	// resize image by max w / h
	
	// save image
	
}

// relocate to new file

?>