<?php

function getRootPath() {
	global $_ROOT_PATH;
	if ($_ROOT_PATH == null || $_ROOT_PATH == "") {
		$absPath = $_SERVER["SCRIPT_FILENAME"];
		$strPath = str_replace("\\", "/", $absPath);
				
		$isWindows = substr($absPath, 0, 1) != "/";
	
		while (strstr($strPath,"/")) {
			$strPath = preg_replace("/\/[^\/]*$/","",$strPath);
			if (is_file($strPath . "/.structurecms.root")) {
				$path_found = true;
				break;
			}
		}
				
		if (!$path_found) {
			die("<h1>Root path not found.</h1><p>Please ensure that a file with the name \".structurecms.root\" exists in the root of this installation.</p>");
		}
		
		$_ROOT_PATH = $strPath;
	}
	return $_ROOT_PATH;
}

function getRootURL() {
	global $_ROOT_URL;
	if ($_ROOT_URL == null || $_ROOT_URL == "") {
		$strDocRoot = $_SERVER["DOCUMENT_ROOT"];
		$strAppRoot = getRootPath();
		$strDocRoot = preg_replace("/[\/]{2,}/", "/", $strDocRoot);
		$strAppRoot = preg_replace("/[\/]{2,}/", "/", $strAppRoot);
		if (strstr($strAppRoot, $strDocRoot)) {
			// method 1 - folder is under site root
			$_ROOT_URL = str_ireplace($strDocRoot, "/", $strAppRoot);
		} else {
			// method 2 - folder is mapped
			$strScriptName = preg_replace("/[\/]{2,}/", "/", $_SERVER["SCRIPT_NAME"]);
			$strScriptFileName = preg_replace("/[\/]{2,}/", "/", $_SERVER["SCRIPT_FILENAME"]);
			$aryScriptName = array_reverse( explode("[\\/]", $strScriptName) );
			$aryScriptFileName = array_reverse( explode("[\\/]", $strScriptFileName) );
			$aryAppRoot = explode("[\\/]", $strAppRoot);
			for ($i = 0; $i < count($aryScriptName); $i++) {
				// if folder name deviates, the last folder must have been the root.
				if ($aryScriptName[$i] != $aryScriptFileName[$i]) {
					break;
				}
				// if search traverses past root folder, exit
				if ( (count($aryScriptFileName)-$i) <= count($aryAppRoot) ) {
					break;
				}
			}
			$strURL = "";
			for ($i = $i; $i < count($aryScriptName); $i++) {
				$strURL = $aryScriptName[$i] . "/" . $strURL;
			}
			$_ROOT_URL = $strURL;
		}
	}
	// strip slashes
	$_ROOT_URL = preg_replace("/[\/]{2,}/", "/", $_ROOT_URL);
	$_ROOT_URL = preg_replace("/[\/]$/", "", $_ROOT_URL);
	return $_ROOT_URL;
}

// include paths config file
require getRootPath() . "/cms/config/paths.php";

function getPath ($page) {
	global $CONTENT_FOLDER;
	return getRootPath() . $CONTENT_FOLDER . $page;
}


function getXMLPath ($page) {
	global $CONTENT_FILE;
	return getPath($page) . $CONTENT_FILE;
}


function getLayoutPath ($page_layout) {
	global $LAYOUT_FOLDER;
	return getRootPath() . $LAYOUT_FOLDER . $page_layout . ".php";
}


function getViewPath ($path) {
	global $VIEW_FOLDER;
	return getRootPath() . $VIEW_FOLDER . $path;
}


function getDataTypePath ($type) {
	global $DATA_TYPE_FOLDER;
	return getRootPath() . $DATA_TYPE_FOLDER . $type . ".php";
}


function getContentTypePath ($type) {
	global $CONTENT_TYPE_FOLDER;
	return getRootPath() . $CONTENT_TYPE_FOLDER . $type;
}


function getUploadPath () {
	global $UPLOAD_FOLDER;
	return getRootPath() . $UPLOAD_FOLDER;
}


function getUploadURL () {
	global $UPLOAD_FOLDER;
	return getRootURL() . $UPLOAD_FOLDER;
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