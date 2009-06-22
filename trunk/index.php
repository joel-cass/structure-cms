<?php

// CHECK PHP VERSION
if (phpversion() < "5.0") {
	die("This project is only supported in PHP 5 and above.");
}

require_once "structureCMS/includes/paths.php";

require_once "structureCMS/classes/core/Page.php";
require_once "structureCMS/classes/helpers/UrlHelper.php";

if (!Page::isPage("/home")) {
	include "installer.php";
}

global $PAGE;
global $PAGE_HANDLE;

$PAGE_HANDLE = UrlHelper::getCurrentPage("/home");
$PAGE = new Page($PAGE_HANDLE);
$PAGE->render();

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