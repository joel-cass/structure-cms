<?php
require_once getRootPath() . "/classes/core/View.php";

class PlaceHolder {

	/* PUBLIC VARS */

	var $name;
	var $xml;

	/* PUBLIC METHODS */

	public function PlaceHolder($name, DOMElement $xml) {
		$this->name = $name;
		$this->xml = $xml;
	}

	
	public function render(Page $page) {
		$views = $this->getViews();
		foreach ($views as $view) {
			$view->render($page);
		}
	}


	public function getViews() {
		$aryViews = array();
		$views_xml = XmlHelper::xpath($this->xml->ownerDocument, "/content/options/placeholders/descendant::placeholder[@name='$this->name']/descendant::view");
		foreach ($views_xml as $view_xml) {
			$aryViews[] = new View($view_xml->getAttribute("path"), $view_xml);
		}
		return $aryViews;
	}

	
	public function setViews(array $views) {
		$placeholder_xml = $this->xml;
		// set views
		for ($index = 0; $index < count($views); $index++) {
			$path = $views[$index];
			$i = 0;
			$node_view = null;
			foreach ($this->xml->childNodes as $child) {
				if ($child->nodeName == "view") {
					if ($i == $index) {
						$node_view = $child;
						break;
					}
					$i++;
				} 
			}
			if ($node_view != null) {
				$node_view->setAttribute("path", $path);
			} else {
				$node_view = $this->xml->ownerDocument->createElement("view");
				$node_view->setAttribute("path", $path);
				$this->xml->appendChild( $node_view );
			}
		}
		// clear out any unwanted views
		$i = 0;
		while ($child = $this->xml->childNodes->item($i)) {
			if ($child->nodeName == "view") {
				if ($i >= count($views)) {
					$this->xml->removeChild($child);
				} else {
					$i++;
				}
			} 
		}
	}
	

	public function deleteView ($index) {
		$placeholder_xml = $this->xml;
		if ($placeholder_xml->item(0) != null) {
			$node = $placeholder_xml->item(0);
			$node->removeChild( $node->item($index) );
		}
	}
	
	/* STATIC METHODS */
	
	public static function getViewsAvailable($placeholder) {
		$placeholder = strToLower($placeholder);
		$strPath = getViewPath($placeholder);
		$aryPath = array();
		if (file_exists($strPath) && is_dir($strPath)) {
			$objDir = dir($strPath);
			while ($entry = $objDir->read()) {
				if ($entry != "." && $entry != ".." && is_file($objDir->path . "/" . $entry)) {
					$aryPath[] = $placeholder . "/" . $entry;
				}
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
