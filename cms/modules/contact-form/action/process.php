<?php

$PAGE = $params["PAGE"];

$strTo = $PAGE->getField("Email")->getValue();
$strFrom = $_POST["email"];
$strSubject = $PAGE->getField("Subject")->getValue();
$strMessage =  "Message posted from " . $_SERVER['SERVER_NAME'];
$strMessage .= " at " . date( "d-M-Y", time() ) . "\n";
$strMessage .= "------------------------------------\n\n";
$strMessage .= "Name: " . $_POST["name"] . "\n";
$strMessage .= "Email: " . $_POST["email"] . "\n";
$strMessage .= "Message: \n" . $_POST["message"];

// send mail
mail($strTo, $strSubject, $strMessage, "From: $strFrom");

$mode = "thanks";

?>