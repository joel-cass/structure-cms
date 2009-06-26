<?php
$aryError = array();

// required fields
if ( $_POST["name"] == "" ) {
	$aryError["name"] = "Please enter your name";
}
if ( $_POST["email"] == "" ) {
	$aryError["email"] = "Please enter your email address";
}
if ( $_POST["message"] == "" ) {
	$aryError["message"] = "Please enter your message";
}

// email fields
if ( !preg_match("/[^@]+@[^@]+.[^@]+/", $_POST["email"]) ) {
	$aryError["email"] = "Your email address does not appear to be valid";
}

// spam check - check that field is not filled in
if ( $_POST["spamcheck"] != "" ) {
	$aryError["spamcheck"] = "Please do not fill in this field";
}

// redirection
if ( count($aryError) ) {
	$mode = "form";
} else {
	$mode = "process";
}

?>