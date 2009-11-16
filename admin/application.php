<?php 

// CHECK PHP VERSION
if (phpversion() < "5.0") {
	die("This project is only supported in PHP 5 and above.");
}

// CALCULATE PATH
$numDirs = substr_count(preg_replace("/^.*\/admin/","",$_SERVER["SCRIPT_NAME"]),"/");
$strIncludePath = str_repeat("../", $numDirs-1);

$adminPath = preg_replace("/(^.*\/admin\/).*$/","$1",$_SERVER["SCRIPT_NAME"]);

// INCLUDE SHARED DEPENDENCIES
require_once $strIncludePath . "../classes/includes/paths.php";
require_once $strIncludePath . "../classes/helpers/AdminHelper.php";
require_once $strIncludePath . "modules/controller.php";

// AUTHENTICATE USER
session_start();

if (array_key_exists("s", $_GET)) {
	$strSession = base64_decode($_GET["s"]);
	session_decode($strSession);
}

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
		header("Location: ". $adminPath . "login.php");
		exit;
	}
}
?>
