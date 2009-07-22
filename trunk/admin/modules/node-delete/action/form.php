<?php
if ( array_key_exists("node", $_REQUEST) ) {
	$strNode = stripslashes( $_REQUEST["node"] );
} else {
	$strNode = "/home";
}

if ($strNode == "/home") {
	$mode = "accessdenied";
}

?>
