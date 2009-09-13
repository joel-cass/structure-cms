<?php
require_once getRootPath() . "/classes/core/DataType.php";

class Field {

	/* PUBLIC VARS */
	
	var $xml;
	var $type;
	var $options;
	
	/* PUBLIC METHODS */
	
	public function Field(DataType $type, DOMElement $xml, array $options = array()) {
		$this->type = $type;
		$this->xml = $xml;
		$this->options = $options;
	}

	
	public function getDataType() {
		return $this->type;
	}

	
	public function getName() {
		return $this->xml->getAttribute("name");
	}

	
	public function setName($name) {
		$this->xml->setAttribute("name",$name);
	}

	
	public function getValue() {
		return $this->xml->nodeValue;
	}

	
	public function setValue($value, $process = true) {
		if ($process == true) {
			$value = $this->process($value);
		}
		XmlHelper::setText($this->xml, ($value != null ? $value : ""));
	}

	
	public function getOptions() {
		return $this->options;
	}

	
	public function render() {
		echo $this->getDataType()->render($this->getValue());
	}

	
	public function edit($name, $id) {
		echo $this->getDataType()->edit($name, $id, $this->getValue());
	}

		
	public function validate() {
		return $this->getDataType()->validate($this->getValue());
	}

		
	public function process($value) {
		return $this->getDataType()->process($this->getName(), $value);
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