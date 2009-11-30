<?php
require_once getRootPath() . "/classes/core/Page.php";

class UrlHelper {

	public static function getCurrentPage ($defaultPage = "/home") {
		$strPage = $defaultPage;
		if ( array_key_exists("path", $_GET) ) {
			$strPage = $_GET["path"];
		/*} elseif ( array_key_exists("PATH_INFO", $_SERVER) ) {
			$strPage = $_SERVER["PATH_INFO"];*/
		} elseif (strstr($_SERVER["SCRIPT_FILENAME"], getPath(""))) {
			$strPage = "/" . str_replace(getPath(""), "", dirname($_SERVER["SCRIPT_FILENAME"]));
		}
		// strip out paths
		$strPage = preg_replace("/\/index\.php$/", "", $strPage);
		$strPage = preg_replace("/^\/content/", "", $strPage);
		
		// if page exists, return it, otherwise return default page
		if (Page::isPage($strPage)) {
			return $strPage;
		}
		return $defaultPage;
	}
	

	public static function getPageURL ($node) {
		$strPath = getRootURL() . "/content$node";
		//$strPath = "index.php?path=$node";
		return $strPath;
	}

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