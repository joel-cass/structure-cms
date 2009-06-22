<?php
require_once getRootPath() . "/structureCMS/classes/helpers/XmlHelper.php";
require_once getRootPath() . "/structureCMS/classes/core/Page.php";

class PageOrder {

	var $xml;
	var $path;

	/* PUBLIC METHODS */
	
	public function PageOrder ($path) {
		$this->path = $path;
		$strPath = getPath($path) . "/page-order.xml";
		if (file_exists($strPath)) {
			$this->xml = XmlHelper::getXML( $strPath );
		} else {
			$this->reset();
		}
	}

	
	public function getPages ($blnActiveOnly = true) {
		// return array of page objects, ordered
		$pages_xml = XmlHelper::xpath($this->xml, "/order/pages/page");
		$aryPages = array();
		foreach ($pages_xml as $page_node) {
			$objPage = new Page("$this->path/$page_node->nodeValue");
			if ($blnActiveOnly == false || $objPage->getActive() == true) {
				$aryPages[] = $objPage;
			}
		}
		return $aryPages;
	}
	
	
	public function getIndex ($page) {
		// loop over pages, return index
		$pages_xml = XmlHelper::xpath($this->xml, "/order/pages/page");
		$i = 0;
		foreach ($pages_xml as $page_node) {
			if ($page == $page_node->nodeValue) {
				return $i;
			} 
			$i++;
		}
		return -1;
	}
	
	
	public function getNode ($page) {
		// loop over pages, return index
		$pages_xml = XmlHelper::xpath($this->xml, "/order/pages/page");
		foreach ($pages_xml as $page_node) {
			if ($page == $page_node->nodeValue) {
				return $page_node;
			} 
		}
		return null;
	}
	
	
	public function move ($page, $increment) {
		// move page by increment
		// use DOMNode::insertBefore(newNode, refNode)
		// refNode being newNode + 1 + inc
		$xmlPages = XmlHelper::xpath($this->xml, "/order/pages/page");
		$xmlParent = XmlHelper::xpath($this->xml, "/order/pages")->item(0);
		$from_index = $this->getIndex($page);
		$to_index = $from_index + $increment;
		$from_item = $xmlPages->item($from_index);
		$to_item = $xmlPages->item($to_index);
		if ($from_item != null && $to_item != null) {
			if ($increment < 0) {
				$xmlParent->insertBefore($from_item, $to_item);
			} elseif ($increment > 0) {
				$xmlParent->insertBefore($to_item, $from_item);
			}
		}
	}
	
	
	public function add ($page) {
		// add node to parent
		$xml_parent = XmlHelper::xpath($this->xml, "/order/pages");
		$xml_parent = $xml_parent->item(0);
		$xml_parent->appendChild( $this->xml->createElement("page", $page) );
	}
	
	
	public function delete ($page) {
		// delete node
		$xml_parent = XmlHelper::xpath($this->xml, "/order/pages");
		$xml_parent = $xml_parent->item(0);
		$node = $this->getNode($page);
		if ($node != null) {
			$xml_parent->removeChild( $node );
		}
	}
	

	public function save () {
		XmlHelper::setXML( getPath($this->path) . "/page-order.xml", $this->xml );
	}

	/* PRIVATE METHODS */
	
	private function reset () {
		$aryDirectory = scandir ( getPath($this->path) );
		$this->xml = XmlHelper::fromString( "<order><pages/></order>" );
		foreach ($aryDirectory as $strEntry) {	
			if ($strEntry != "." && $strEntry != ".." && Page::isPage($this->path . "/" . $strEntry)) {
				$this->add($strEntry);
			}
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