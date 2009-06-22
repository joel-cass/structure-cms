<?php
class View {
	
	/* PUBLIC VARS */

	var $path;
	var $xml;

	/* PUBLIC METHODS */
	
	public function View($path, DOMElement $xml) {
		$this->path = $path;
		$this->xml = $xml;
	}
	
	
	public function render(Page $page) {
		$viewPath = $this->path;
		if (substr($viewPath, strlen($viewPath)-5, 5) == ".xslt") {
			// file is XSLT
			$objXML = $page->xml;
			$objXSL = new DomDocument;
			$objXSL->load($viewPath);
			$proc = new xsltprocessor;
			$proc->importStyleSheet($objXSL);
			echo $proc->transformToXML($objXML);
		} else {
			// FILE IS PHP
			$PAGE = $page;
			include getViewPath ($this->path); 
		}		
	}


	public function getOptions() {
		$xmlOptions = XmlHelper::getNode($this->xml, "options");
		$lstOptions = $xmlOptions->childNodes;
		$aryOptions = array();
		if ($lstOptions != null) {
			foreach ($lstOptions as $xmlOption) {
				$aryOptions[$xmlOption->getAttribute("name")] = $xmlOption->nodeValue;
			}
		}
		return $aryOptions;
	} 

	
	public function getOption($name) {
		$xmlOptions = XmlHelper::getNode($this->xml, "options");
		$lstOptions = $xmlOptions->childNodes;
		if ($lstOptions != null) {
			foreach ($lstOptions as $xmlOption) {
				if ($xmlOption->getAttribute("name") == $name) {
					return $xmlOption->nodeValue;
				}
			}
		}
		return "";
	} 

	
	public function setOption($name, $value) {
		$xmlOptions = XmlHelper::getNode($this->xml, "options");
		$lstOptions = $xmlOptions->childNodes;
		// search for option, if found, set & exit
		if ($lstOptions != null) {
			foreach ($lstOptions as $xmlOption) {
				if ($xmlOption->getAttribute("name") == $name) {
					XmlHelper::setValue($xmlOption, $value);
					return;
				}
			}
		}
		// create new option
		$xmlNewOption = $this->xml->ownerDocument->createElement("option");
		$xmlNewOption->setAttribute("name", $name);
		XmlHelper::setValue($xmlNewOption, $value);
		$xmlOption->appendChild($xmlNewOption); 
		return "";
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
