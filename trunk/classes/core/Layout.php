<?php
class Layout {

	/* PUBLIC VARS */
	
	var $name;
	var $path;

	/* PUBLIC METHODS */

	public function Layout($name) {
		$this->name = $name;
		$this->path = getLayoutPath($name);
	}

	
	public function render(Page $PAGE) {
		require_once getRootPath() . "/classes/helpers/LayoutHelper.php";
		include $this->path; 
	}


	public function getPlaceholders() {
		$aryPlaceholders = array();
		$aryMatches = array();
		$content = file_get_contents( $this->path );
		preg_match_all("/renderPlaceHolder\(.*\"(.*)\"\)/", $content, $aryMatches);
		if (count($aryMatches) == 2) {
			$aryPlaceholders = $aryMatches[1];
		}
		return $aryPlaceholders; 
	}
	
	/* STATIC METHODS */
	
	public static function getLayouts () {
		$strPath = dirname( getLayoutPath ("null") );
		$aryPath = array();
		$objDir = dir($strPath);
		while ($entry = $objDir->read()) {
			if ($entry != "." && $entry != ".." && is_file($objDir->path . "/" . $entry) && substr($entry, strlen($entry)-4, 4) == ".php") {
				$aryPath[] = substr($entry, 0, strlen($entry)-4);
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