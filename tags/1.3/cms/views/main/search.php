<?php 
require_once( getRootPath() . "/cms/modules/controller.php" );

$params = array();
$params["PAGE"] = $PAGE;

Controller("search", "form", "", $params); 
?>