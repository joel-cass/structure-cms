<?php 

// CHECK PHP VERSION
if (phpversion() < "5.0") {
	die("This project is only supported in PHP 5 and above.");
}

// INCLUDE SHARED DEPENDENCIES
require_once "../structureCMS/includes/paths.php";
require_once "../structureCMS/classes/helpers/AdminHelper.php";
require_once "modules/controller.php";

// AUTHENTICATE USER
session_start();
if (!isset($blnAuthenticate)) {
	$blnAuthenticate = true;
}
if ( $blnAuthenticate == true ) {
	$strUsername = "";
	$strPassword = "";
	if (array_key_exists("username", $_SESSION)) { 
		$strUsername = $_SESSION["username"];
	}
	if (array_key_exists("password", $_SESSION)) { 
		$strPassword = $_SESSION["password"];
	}

	if ( !AdminHelper::authenticate($strUsername, $strPassword) ) {
		header("Location: login.php");
		exit;
	}
}
?>
