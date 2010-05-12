<?php
require_once getRootPath() . "/classes/core/DataType.php";

class type_file extends DataType {
	
	public function edit ($name, $id, $value) {
		$strReturn = "<input type=\"file\" class=\"file\" name=\"$name\" id=\"$name\">";
		if ($value != "") {
			$href = $this->render($value, $this->options);
			$strReturn .= " (Currently <a href=\"$href\">$href</a>)";
		}
		return $strReturn;
	}
	
	public function process ($name, $value) {
		if ($value != null && $value["name"] != null && $value["tmp_name"] != null) {
			$strDest = getRootPath() . $this->options["path"];
			$strName = ereg_replace("[^A-Za-z0-9\.]", "-", $value["name"]);
			
			if (!file_exists($strDest)) {
				mkdir($strDest);
			}
			
			if ($this->options["conflict"] == "make-unique") {
				// fancy action: make files unique
				$strOrigName = $strName;
				$i = 1;
				while (file_exists("$strDest/$strName")) {
					$strName = ereg_replace("(\.[^\.]*)$", "_$i\\1", $strOrigName);
					$i++;
				}
			} elseif (file_exists("$strDest/$strName")) {
				// default action: overwrite
				unlink("$strDest/$strName");
			}
			
			copy($value["tmp_name"], "$strDest/$strName");
			
			return $strName;
		}
		return "";
	}
	
	public function render ($value) {
		return $this->options["path"] . "/" . $value;
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