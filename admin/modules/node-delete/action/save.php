<?php
include_once (getRootPath() . "/classes/core/Page.php");

$strNode = stripslashes( $_REQUEST["node"] );

Page::delete($strNode)
?>