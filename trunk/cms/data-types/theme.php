<?php
require_once getRootPath() . "/classes/core/DataType.php";

class type_theme extends DataType {
	
	public function edit ($name, $id, $value) {
		$strReturn = "<select name=\"$name\" id=\"$id\"";
		if (array_key_exists("multiple", $this->options) && $this->options["multiple"] == true) {
			$strReturn .= " multiple";
		}
		$strReturn .= ">";
		$aryOptions = array();
		if (array_key_exists("options", $this->options)) {
			$xmlOptions = $this->options["options"];
			foreach ($xmlOptions as $o) {
				$stcOption = array();
				$stcOption["text"] = $o->nodeValue;
				$stcOption["value"] = $o->getAttribute("value");
				$aryOptions[] = $stcOption;
			}
		} else {
			$objDir = dir(getRootPath() . "/styles");
			while (false !== ($strEntry = $objDir->read())) {
				if (substr($strEntry,0,1) != ".") {
					$stcOption = array();
					$stcOption["text"] = $strEntry;
					$stcOption["value"] = $strEntry;
					$aryOptions[] = $stcOption;
				}
			}
		}
		$blnFound = false;
		foreach ($aryOptions as $o) {
			$v = $o["value"];
			$t = $o["text"];
			if ($v == null) $v = $t;
			if ($v == $value) {
				$strReturn .= "<option value=\"" . $v . "\" selected>" . $t . "</option>";
				$blnFound = true;
			} else {
				$strReturn .= "<option value=\"" . $v . "\">" . $t . "</option>";
			}
		}
		if (!$blnFound) {
			$strReturn .= "<option value=\"" . $value . "\" selected>" . $value . "</option>";
		}
		$strReturn .= "</select>";
		return $strReturn;
	}
	
	public function process ($name, $value) {
		return $value;
	}
	
	public function render ($value) {
		return $value;
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