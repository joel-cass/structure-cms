<?php 
require_once( getRootPath() . "/modules/controller.php" );

$params = array();
$params["PAGE"] = $PAGE;

Controller("search", "form", "", $params); 
?>