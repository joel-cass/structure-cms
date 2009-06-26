<?php
include_once (getRootPath() . "/classes/core/Page.php");

$strNode = stripslashes( $_REQUEST["node"] );
$strName = stripslashes( $_REQUEST["name"] );
$strContentType = stripslashes( $_REQUEST["content_type"] );

Page::create($strNode . "/" . $strName, $strContentType)

?>