<?php 
require_once getRootPath() . "/structureCMS/classes/helpers/XmlHelper.php";
require_once getRootPath() . "/structureCMS/classes/helpers/UrlHelper.php";
require_once getRootPath() . "/structureCMS/classes/helpers/FileSystemHelper.php";

require_once getRootPath() . "/structureCMS/classes/core/ContentType.php";
require_once getRootPath() . "/structureCMS/classes/core/Field.php";
require_once getRootPath() . "/structureCMS/classes/core/Layout.php";
require_once getRootPath() . "/structureCMS/classes/core/PageOrder.php";
require_once getRootPath() . "/structureCMS/classes/core/PlaceHolder.php";

require_once getRootPath() . "/structureCMS/includes/lists.php";

class Page {

	/* PUBLIC VARS */

	var $xml;
	var $path;

	var $objLayout;
	var $objParent;
	var $objContentType;
	var $objPageOrder;
	var $aryFields = array();
	var $aryPlaceholders = array();
	
	/* PUBLIC METHODS */

	public function Page ($path) {
		if (!Page::isPage($path)) {
			throw(new Exception("Page does not exist: $path (" . getPath($path) . ")"));
		}
		$this->path = $path;
		$this->xml = XmlHelper::getXML( getXMLPath($path) );
	}


	public function render () {
		$this->getLayout()->render($this);
	}

	
	public function getFileInfo () {
		return FileSystemHelper::getFileInfo( getXMLPath($this->path) );
	}
	
	
	public function getLevel () {
		return listlen($this->path, "/");
	}


	public function getName () {
		return listLast($this->path, "/");
	}


	public function setName ($name) {
		$strPath = listDeleteAt($this->path, listLen($this->path, "/"), "/");
		$strPath = listAppend($strPath, $name, "/");
		rename(getPath($this->path), getPath($strPath));
		$this->path = $strPath;
	}


	public function getURL () {
		return UrlHelper::getPageURL($this->path);
	}


	public function getContentTypeObject () {
		if ($this->objContentType == null) {
			$this->objContentType = new ContentType($this->getContentType());
		}
		return $this->objContentType;
	}
	

	public function getContentType () {
		return $this->xml->firstChild->getAttribute("type");
	}
	
	
	public function setContentType ($type) {
		$this->xml->firstChild->setAttribute("type", $type);
	}
	
	
	public function getLayout() {
		if ($this->objLayout == null) {
			$layout = XmlHelper::xpath($this->xml, "/content/options/layout");
			$this->objLayout = new Layout($layout->item(0)->textContent);
		}
		return $this->objLayout;
	}
	

	public function setLayout($layout) {
		$layout_xml = XmlHelper::xpath($this->xml, "/content/options/layout");
		XmlHelper::setText($layout_xml->item(0), $layout);
	}
	

	public function getFields () {
		$xmlFields = XmlHelper::xpath($this->xml, "/content/fields/descendant::field");
		$objContentType = $this->getContentTypeObject();
		$aryFields = array();
		foreach ($xmlFields as $xmlField) {
			$name = $xmlField->getAttribute("name");
			if (!array_key_exists($name, $this->aryFields)) {
				$objContentTypeField = $this->getContentTypeObject()->getField($name);
				$this->aryFields[$name] = new Field(
						$objContentTypeField->getDataTypeObject(), 
						$xmlField,
						$objContentTypeField->getOptions()
					);
			}
			$aryFields[] = $this->aryFields[$name];
		}
		return $aryFields;
	}
	

	public function getField ($field) {
		if (!array_key_exists($field, $this->aryFields)) {
			$xmlFields = XmlHelper::xpath($this->xml, "/content/fields/descendant::field[@name='$field']");

			if ($xmlFields->item(0) != null) {
				$xmlField = $xmlFields->item(0);
			} else {
				$xmlField = $this->xml->createElement("field", "");
				$xmlField->setAttribute("name", $field);
				$xmlParent = XmlHelper::xpath($this->xml, "/content/fields");
				$xmlParent->item(0)->appendChild($xmlField);
			}

			$objContentTypeField = $this->getContentTypeObject()->getField($field);

			$this->aryFields[$field] = new Field(
					$objContentTypeField->getDataTypeObject(), 
					$xmlField,
					$objContentTypeField->getOptions()
				);
		}
		return $this->aryFields[$field];
	}
	

	public function setField ($field, $value, $process = true) {
		$this->getField($field)->setValue($value);
	}
	
	
	public function getActive () {
		$xmlOptions = XmlHelper::xpath($this->xml, "/content/options/active");
		if ($xmlOptions->item(0) != null) {
			return $xmlOptions->item(0)->nodeValue;
		} else {
			return 1;
		}
	}
	

	public function setActive ($active) {
		$xmlOptions = XmlHelper::xpath($this->xml, "/content/options/active");
		if ($xmlOptions->item(0) != null) {
			XmlHelper::setText($xmlOptions->item(0), $active);
		} else {
			$nodeActive = $this->xml->createElement("active", $active);
			$nodeParent = XmlHelper::xpath($this->xml, "/content/options");
			$nodeParent->item(0)->appendChild( $nodeActive );
		}
	}
	
	
	public function getPageOrder() {
		if ($this->objPageOrder == null) {
			$this->objPageOrder = new PageOrder($this->path);
		}
		return $this->objPageOrder;
	}
	

	public function getPlaceHolders() {
		$placeholders_xml = XmlHelper::xpath($this->xml, "/content/options/placeholders/descendant::placeholder");
		$aryPlaceholders = array();
		foreach ($placeholders_xml as $placeholder_xml) {
			$name = $placeholder_xml->getAttribute("name");
			if (!array_key_exists($name, $this->aryPlaceholders)) {
				$this->aryPlaceholders[$name]
					 = new PlaceHolder(
					 	$name, 
					 	$placeholder_xml);
			}
			$aryPlaceholders[] = $this->aryPlaceholders[$name];
		}
		return $aryPlaceholders;
	}
	

	public function getPlaceHolder($name) {
		$name = strToLower($name);
		if (!array_key_exists($name, $this->aryPlaceholders)) {
			$placeholder_xml = XmlHelper::xpath($this->xml, "/content/options/placeholders/descendant::placeholder[@name='$name']");
			// add / pick up placeholder
			if ($placeholder_xml->item(0) == null) {
				$node_placeholder = $this->xml->createElement("placeholder");
				$node_placeholder->setAttribute("name", $name);
				$node_parent = XmlHelper::xpath($this->xml, "/content/options/placeholders");
				$node_parent->item(0)->appendChild( $node_placeholder );
				$node = $node_placeholder;
			} else {
				$node = $placeholder_xml->item(0);
			}
			$this->aryPlaceholders[$name] = new PlaceHolder($name, $node);
		}
		return $this->aryPlaceholders[$name];
	}
	

	public function getPlaceHolderViews($name) {
		return getPlaceHolder($name)->getViews();
	}
	

	public function setPlaceHolderViews($name, $views) {
		getPlaceHolder($name)->setViews($views);
	}
	

	public function deletePlaceHolderView ($name, $index) {
		getPlaceHolder($name)->deleteView($index);
	}
	
	public function getParent() {
		if ($this->objParent == null) {
			try {
				$this->objParent = new Page( listDeleteAt($this->path, listLen($this->path,"/"), "/") );
			} catch (Exception $e) {
				$this->objParent = null;
			}
		}
		return $this->objParent; 
	}
	

	public function getChildren ($blnActiveOnly = true) {
		return Page::getPages( $this->path, $blnActiveOnly );
	}
	

	public function save () {
		XmlHelper::setXML( getXMLPath($this->path), $this->xml );
	}
	
	/* STATIC METHODS */
	
	public static function getPages ($path, $blnActiveOnly = true) {
		$objOrder = new PageOrder($path);
		return $objOrder->getPages($blnActiveOnly);
	}
	

	public static function isPage($page) {
		return 
			is_dir( getPath($page) ) && 
			is_file( getXMLPath($page) );
	}


	/* TODO: Refactor */
	public static function create($page, $type) {
		// copy default XML
		$strTemplatePath = getContentTypePath ($type) . "/default-content.xml";
		$strPath = getXMLPath($page);
		mkdir(dirname($strPath));
		file_put_contents( $strPath, file_get_contents($strTemplatePath) );
		// create php file
		$level = ".." . preg_replace("/[^\/]+/", "..", $page);
		$strPath = getPath($page) . "/index.php";
		file_put_contents( $strPath, "<?php require \"" . $level . "/index.php\";?>" );
		// set page content type
		$objPage = new Page($page);
		$objPage->setContentType($type);
		$objPage->save();
		// set page order
		$objOrder = new PageOrder( listDeleteAt($page, listLen($page, "/"), "/") );
		if ( $objOrder->getIndex($objPage->getName()) < 0) {
			$objOrder->add($objPage->getName());
		}
		$objOrder->save();
		return $objPage;
	}
	

	public static function delete($page) {
		// set page order
		$objPage = new Page($page);
		$objOrder = new PageOrder( listDeleteAt($page, listLen($page, "/"), "/") );
		$objOrder->delete($objPage->getName());
		$objOrder->save();
		// delete page
		FileSystemHelper::delTree(getPath($page));
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