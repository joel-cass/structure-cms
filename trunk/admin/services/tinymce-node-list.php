<?php 
header("Content-type: text/javascript");

include_once "../../classes/includes/paths.php";
include_once getRootPath() . "/classes/core/Page.php";

function getNodeList($path, $aryReturn = array()) {
	$aryPages = Page::getPages($path, false);
	
	for ($i = 0; $i < count($aryPages); $i++) {
		$strEntry = $aryPages[$i]->path;
		$strURL = $aryPages[$i]->getURL();
		$aryReturn[] = "[\"" .  $strEntry . "\", \"" .  $strURL . "\"]";
		$aryReturn = getNodeList($strEntry, $aryReturn);
	}
	
	return $aryReturn;
}

$aryNodes = getNodeList("");

echo "var tinyMCELinkList = new Array(";
for ($i = 0; $i < count($aryNodes); $i++) {
	if ($i > 0) echo ",";
	echo "\n\t";
	echo $aryNodes[$i];
}
echo "\n";
echo ");";


/*  ******* LICENSE ******* 
 *  
 *  Copyright 2009 Joel Cass 
 *  
 *  Licensed under the Apache License, Version 2.0 (the "License"); 
 *  you may not use this file except in compliance with the License. 
 *  You may obtain a copy of the License at 
 *  
 *  	http://www.apache.org/licenses/LICENSE-2.0 
 *  	
 *  Unless required by applicable law or agreed to in writing, software 
 *  distributed under the License is distributed on an "AS IS" BASIS, 
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. 
 *  See the License for the specific language governing permissions and 
 *  limitations under the License. 
 */

?>