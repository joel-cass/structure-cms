<?php 

global $wpdb, $wp;

define('WP_USE_THEMES', false);
require ( getRootPath() . "/" . $PAGE->getField("Path")->getValue() . "/wp-blog-header.php");

die("wordpress integrated");

require_once( getRootPath() . "/cms/modules/controller.php" );

$params = array();
$params["PAGE"] = $PAGE;

Controller("wordpress", "list", "", $params); 
?>