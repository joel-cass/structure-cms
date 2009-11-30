<?php 
require_once getRootPath() . "/classes/helpers/XmlHelper.php";

require_once getRootPath() . "/classes/core/ContentTypeField.php";

class ContentType {

	/* PUBLIC VARS */
	
	var $xml;
	var $name;
	var $path;
	
	/* PUBLIC METHODS */
	
	public function ContentType ($name) {
		$this->name = $name;
		$this->path = getContentTypePath($name) . "/schema.xml";
		$this->xml = XmlHelper::getXML($this->path);
	}


	public function getName () {
		return $this->name;
	}

	
	public function getFields () {
		$fields = XmlHelper::xpath($this->xml, "/type/fields/field");
		$aryFields = array();
		foreach ($fields as $field) {
			$aryFields[] = new ContentTypeField($field);
		}
		return $aryFields;
	}

	
	public function getField ($field) {
		$fields = XmlHelper::xpath($this->xml, "/type/fields/field[@name='$field']");
		$node_field = $fields->item(0);
		
		if ($node_field == null) {
			$node_field = $this->xml->createElement("field");
			$node_field->setAttribute("name", $field);
			$node_field->appendChild($this->xml->createElement("type", "string"));
			$node_field->appendChild($this->xml->createElement("description", ""));
			$xml_parent = XmlHelper::xpath($this->xml, "/type/fields");
			$xml_parent->item(0)->appendChild($node_field);
		}

		return new ContentTypeField($node_field);
	}
	

	public function setField ($field, $name, $type, $description) {
		$field = $this->getField ($field);
		$field->setName($name);
		$field->setDataType($type);
		$field->setDescription($description);
	}
	

	public function save () {
		XmlHelper::setXML( getPath($this->path), $this->xml );
	}
	
	/* STATIC METHODS */
	
	public static function getContentTypes () {
		$strPath = getContentTypePath (".");
		$aryPath = array();
		$objDir = dir($strPath);
		while ($entry = $objDir->read()) {
			if ($entry != "." && $entry != ".." && is_dir($objDir->path . "/" . $entry)) {
				$aryPath[] = $entry;
			}
		}
		return $aryPath;
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