<?php
/* START LIST FUNCTIONS */
function listAppend ($list, $value, $delim = ",") {
	if (strlen($list)) {
		return $list . $delim . $value;
	} else {
		return $value;
	}
}
function listFind ($list, $value, $delim = ",") {
	$arrList = explode($delim, $list);
	foreach ($arrList as $i => $v) {
		if ($v == $value) {
			return ($i+1);
		}
	}
	return 0;
}
function listFindNoCase ($list, $value, $delim = ",") {
	$arrList = explode($delim, $list);
	foreach ($arrList as $i => $v) {
		if (strToLower($v) == strToLower($value)) {
			return ($i+1);
		}
	}
	return 0;
}
function listLen ($list, $delim = ",") {
	if (strlen($list) == 0) {
		return 0;
	} else {
		return substr_count($list, $delim) + 1;
	}
}
function listDeleteAt ($list, $index, $delim = ",") {
	$newList = "";
	$arrList = explode($delim, $list);
	foreach ($arrList as $i => $v) {
		if ($i < ($index-1) && $v != "") {
			$newList .= $delim . $v;
		}
	}
	return $newList;
}
function listGetAt($list, $index, $delim = ",") {
	$arrList = split($delim, $list);
	foreach ($arrList as $i => $v) {
		if ($i == ($index-1)) {
			return $v;
		}
	}
	return "";
}
function listLast($list, $delim = ",") {
	$arrList = split($delim, $list);
	return $arrList[count($arrList)-1];
}
function listLeft($list, $index, $delim = ",") {
	$arrList = split($delim, $list);
	$strNew = "";
	foreach ($arrList as $i => $v) {
		if (i <= ($index-1)) {
			$strNew = listAppend($strNew, $v, $delim);
		}
	}
	return $strNew;
}

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