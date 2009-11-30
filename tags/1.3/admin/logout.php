<?php 
$blnAuthenticate = false;
include "application.php";

unset($_SESSION["username"]);
unset($_SESSION["password"]);
header("Location: ./");
?>
