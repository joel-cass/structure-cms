<?php 
require "application.php";

header("content-type: text/javascript"); 

echo "function getSessionString () { 
	return \"" . base64_encode(session_encode()) . "\"; 
}";

?>
