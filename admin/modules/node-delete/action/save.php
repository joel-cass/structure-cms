<?php
include_once (getRootPath() . "/structureCMS/classes/core/Page.php");

$strNode = stripslashes( $_REQUEST["node"] );

Page::delete($strNode)
?>