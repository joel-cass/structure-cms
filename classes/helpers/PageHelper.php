<?php
require_once (getRootPath() . "/classes/core/Page.php");
require_once (getRootPath() . "/classes/helpers/FileSystemHelper.php");

class PageHelper {
	
	public function PageHelper () {
		
	}
	
	/* STATIC METHODS */
	
	public static function getInstance() {
		return new PageHelper();	
	}
	
	
	public static function getDescendants ($node, $contentType = "", array $aryPages = array()) {
		$aryTemp = Page::getPages($node);
		foreach ($aryTemp as $objPage) {
			if ($contentType == "" || $objPage->getContentType() == $contentType) {
				$aryPages[] = $objPage;
				$aryPages = PageHelper::getDescendants($objPage->path, $contentType, $aryPages);
			}
		}
		return $aryPages;
	}
	
	
	public static function search ($node, $keyword, $contentType = "") {
		$aryPages = PageHelper::getDescendants($node, $contentType);
		$aryResult = array();
		$strKeyword = strToLower($keyword);
		foreach ($aryPages as $objPage) {
			$aryFields = $objPage->getFields();
			foreach ($aryFields as $objField) {
				if ( strstr(strtoLower($objField->getValue()), $strKeyword) ) {
					$aryResult[]= $objPage;
					break;
				}
			}
		}
		return $aryResult;
	}
	
	
	public static function getRecentlyModified ($below, $maxrows = null, $contentType = "", $dateEnd = null) {
		if ($dateEnd == null) {
			$dateEnd = localtime();
		}
		$aryFiles = FileSystemHelper::getRecentlyModified($below);
		$aryPages = array();
		foreach ($aryFiles as $p=>$d) {
			if ($maxrows == null || count($aryFiles) < $maxrows) {
				$objPage = new Page($p);
				if ($contentType == "" || $objPage->getContentType() == $contentType) {
					$aryPages[] = $objPage;
				}
			}
		}
		return $aryPages;
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