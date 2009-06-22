<?php

// defaults
$strName = "";
$strEmail = "";
$strMessage = "";
$strSpamCheck = "";

if ( array_key_exists("name", $_POST) ) {
	$strName = $_POST["name"];
}
if ( array_key_exists("email", $_POST) ) {
	$strEmail = $_POST["email"];
}
if ( array_key_exists("message", $_POST) ) {
	$strMessage = $_POST["message"];
}
if ( array_key_exists("spamcheck", $_POST) ) {
	$strSpamCheck = $_POST["spamcheck"];
}

?>