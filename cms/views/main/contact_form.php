<?php 
require_once( getRootPath() . "/cms/modules/controller.php" );

$params = array();
$params["PAGE"] = $PAGE;

Controller("contact-form", "form", "", $params); 
?>