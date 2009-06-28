<?php
require_once getRootPath() . "/classes/core/DataType.php";

class ContentTypeField {

	/* PUBLIC VARS */
	
	var $xml;
	var $type;
	
	/* PUBLIC METHODS */
	
	public function ContentTypeField ($xml) {
		$this->xml = $xml;
	} 

	
	public function getName() {
		return $this->xml->getAttribute("name");
	}
	

	public function setName($name) {
		$this->xml->setAttribute("name",$name);
	}

	
	public function getDescription() {
		return XmlHelper::getChildNode($this->xml, "description")->textContent;
	}

	
	public function setDescription($description) {
		$xmlDescription = XmlHelper::getChildNode($this->xml, "description"); 
		XmlHelper::setText($xmlDescription->item(0), $description);
	}

	
	public function getDataType() {
		return XmlHelper::getChildNode($this->xml, "type")->textContent;
	} 

	
	public function setDataType($type) {
		$xmlType = XmlHelper::getChildNode($this->xml, "description"); 
		XmlHelper::setText($xmlType->item(0), $type);
	} 

	
	public function getOptions() {
		$xmlOptions = XmlHelper::getChildNode($this->xml, "options");
		$aryOptions = array();
		if ($xmlOptions != null) {
			$lstOptions = $xmlOptions->childNodes;
			if ($lstOptions != null) {
				foreach ($lstOptions as $xmlOption) {
					if ($xmlOption->childNodes->length <= 1) {
						$aryOptions[$xmlOption->getAttribute("name")] = $xmlOption->nodeValue;	
					} else {
						$aryOptions[$xmlOption->getAttribute("name")] = $xmlOption->childNodes;
					}
				}
			}
		}
		return $aryOptions;
	} 

	
	public function getOption($name) {
		$lstOptions = XmlHelper::getChildNode($this->xml, "options")->childNodes;
		foreach ($lstOptions as $xmlOption) {
			if ($xmlOption->getAttribute("name") == $name) {
				return $xmlOption->nodeValue;
			}
		}
		return "";
	} 

	
	public function setOption($name, $value) {
		$xmlOptions = XmlHelper::getChildNode($this->xml, "options");
		$lstOptions = $xmlOptions->childNodes;
		// look for option, set, exit
		foreach ($lstOptions as $xmlOption) {
			if ($xmlOption->getAttribute("name") == $name) {
				XmlHelper::setValue($xmlOption, $value);
				return;
			}
		}
		// add new option if not found
		$xmlNewOption = $this->xml->ownerDocument->createElement("option", "");
		$xmlNewOption->setAttribute("name", $name);
		$xmlOptions->appendChild($xmlNewOption);
	} 

	
	public function getDataTypeObject() {
		return DataType::getDataTypeObject($this->getDataType(), $this->getOptions());
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