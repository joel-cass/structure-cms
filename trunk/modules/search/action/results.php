<?php

require_once getRootPath() . "/structureCMS/classes/helpers/PageHelper.php";

$keyword = $_REQUEST["keyword"];
$aryResult = PageHelper::Search("", $keyword);

?>