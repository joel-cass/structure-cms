<?php
$blnAuthenticated = AdminHelper::authenticate($_REQUEST["username"], $_REQUEST["password"]); 
if ( $blnAuthenticated == true ) {
	$_SESSION["username"] = stripslashes( $_REQUEST["username"] );
	$_SESSION["password"] = stripslashes( $_REQUEST["password"] );
	$mode = "loggedin";
} else {
	$mode = "form";
}
?>