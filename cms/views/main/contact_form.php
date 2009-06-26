<?php 
require_once( getRootPath() . "/modules/controller.php" );

$params = array();
$params["PAGE"] = $PAGE;

Controller("contact-form", "form", "", $params); 
?>