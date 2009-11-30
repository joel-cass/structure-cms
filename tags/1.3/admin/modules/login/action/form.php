<?php 
$strUsername = "";
$strPassword = "";

if (array_key_exists("username", $_REQUEST)) {
	$strUsername = stripslashes( $_REQUEST["username"] );
}
if (array_key_exists("password", $_REQUEST)) {
	$strPassword = stripslashes( $_REQUEST["password"] );
}

?>