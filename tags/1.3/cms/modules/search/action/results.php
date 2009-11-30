<?php

require_once getRootPath() . "/classes/helpers/PageHelper.php";

$keyword = $_REQUEST["keyword"];
$aryResult = PageHelper::Search("", $keyword);

?>