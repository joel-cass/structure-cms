<?php

class XmlHelper {

	public static function getXML( $path ) {
		return DOMDocument::load( $path, LIBXML_NOBLANKS );
	}
	

	public static function fromString( $strXML ) {
		return DOMDocument::loadXML( $strXML, LIBXML_NOBLANKS );
	}
	

	public static function setXML( $path, $xml ) {
		$xml->formatOutput = true;
		fwrite( fopen($path, "w"), $xml->SaveXML() );
	}
	

	public static function xpath ($xml, $query) {
		$xpath = new DOMXPath( $xml );
		$result = $xpath->query( $query );
		if ($result == null) {
			die("XPath Error: $query ");
		}
		return $result;
	}
	

	public static function getChildNode ($node, $childName) {
		foreach ($node->childNodes as $child) {
			if ($child->nodeName == $childName) {
				return $child;
			}
		}
	}

	public static function setText ($node, $value) {
		$node_new_value = $node->ownerDocument->createTextNode($value);
		if ($node->childNodes->item(0) != null) {
			$node->replaceChild($node_new_value, $node->childNodes->item(0));
		} else {
			$node->appendChild($node_new_value);
		}
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