<?php
require_once getRootPath() . "/classes/core/DataType.php";

class type_date extends DataType {

	// show input field for display in form
	public function edit ($name, $id, $value) {
		return "<input type=\"text\" name=\"$name\" id=\"$id\" value=\"$value\"> (dd/mm/yy)";
	}
	
	// show value for display.use in site
	public function render ($value) {
		return $value;
	}
	
	// process value / form / files and return preferred value
	public function process ($name, $value) {
		return $value;
	}
	
	// validate - return true/false to indicate field validity
	public function validate ($value) {
		return true;
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