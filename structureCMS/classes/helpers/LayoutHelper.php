<?php
require_once (getRootPath() . "/structureCMS/classes/helpers/UrlHelper.php");

require_once (getRootPath() . "/structureCMS/classes/core/Page.php");

class LayoutHelper {
	
	// GLOBALS
	
	var $_page_placeholders = array();
	var $_page_views = array();
	
	// INITIALISATION FUNCTIONS
	
	public static function getCurrentPage ($defaultPage = "/home") {
		return UrlHelper::getCurrentPage($defaultPage);
	}
	
	public static function getInstance () {
		if (!array_key_exists("LayoutHelper", $_REQUEST)) {
			$_REQUEST["LayoutHelper"] = new LayoutHelper();
		}
		return $_REQUEST["LayoutHelper"];
	}
	
	// UTILITY FUNCTIONS
	
	public static function getPageURL ($page) {
		return UrlHelper::getPageURL ($page);
	}
	
	public static function getPage ($page) {
		return new Page($page);
	}
	
	// RENDERING FUNCTIONS
	
	public static function renderLink (Page $objPage, $titleField = "Title") {
		echo "<a href=" . $objPage->getURL() . ">";
		LayoutHelper::renderField($objPage, $titleField);
		echo "</a>";
	}
	
	public static function renderField (Page $objPage, $field) {
		echo $objPage->getField($field)->render();
	}
	
	public static function renderLayout (Page $objPage) {
		echo $objPage->getLayout()->render();
	}
	
	public static function renderPlaceHolder (Page $objPage, $name) {
		// set globals
		LayoutHelper::getInstance()->_page_placeholders[] = $name;
		// render placeholder views
		echo $objPage->getPlaceHolder($name)->render($objPage);
	}
	
	public static function renderView (Page $objPage, $path) {
		// set globals
		LayoutHelper::getInstance()->_page_views[] = $path;
		// render view
		$objView = new View($path);
		$objView->render($objPage);
	}
	
	// QUERY FUNCTIONS
	
	public static function getPlaceholdersExecuted () {
		return LayoutHelper::getInstance()->_page_placeholders;
	}
	
	public static function getViewsExecuted () {
		return LayoutHelper::getInstance()->_page_views;
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