<?php

class FileSystemHelper {

	public static function getFileContents( $path ) {
		return file_get_contents( $path );
	}


	public static function setFileContents( $path, $contents ) {
		fwrite( fopen($path, "w"), $contents );
	}

	
	public static function getFileInfo( $path ) {
		$aryFileInfo = array();
		$aryFileInfo["accessed"] = fileatime($path);
		$aryFileInfo["changed"] = filectime($path);
		$aryFileInfo["group"] = filegroup($path);
		$aryFileInfo["inode"] = fileinode($path);
		$aryFileInfo["modified"] = filemtime($path);
		$aryFileInfo["owner"] = fileowner($path);
		$aryFileInfo["permissions"] = fileperms($path);
		$aryFileInfo["size"] = filesize($path);
		return $aryFileInfo;
	}


	public static function delTree ($dir) {
		$aryFiles = scandir($dir);
		foreach($aryFiles as $file) {
			if ($file != "." && $file != "..") {
				$path=$dir."/".$file;
				if (is_dir($path)) {
					FileSystemHelper::delTree($path);
				} else {
					unlink($path);
				}
			}
		}
		rmdir($dir);
	}
	
	
	public static function GetAllDirectories($root, $path = "", array $aryDir = array()) {
		$aryPaths = scandir($root . "/" . $path);
		
		foreach($aryPaths as $p) {
			if (substr($p, 0, 1) != "." && is_dir($root . "/" . $path . "/" . $p)) {
				$aryDir[] = $path . "/" . $p;
				$aryDir = FileSystemHelper::GetAllDirectories($root, $path . "/" . $p, $aryDir);
			} 
		}

		return $aryDir;
	}
	
	
	public static function GetLatestPages($root, $path="") {
		$aryDirs = FileSystemHelper::GetAllDirectories($root, $path);
		$aryPages = array();
		
		foreach($aryDirs as $d) {
			if (Page::isPage($d)) {
				$aryPages[$d] = filemtime(getXMLPath($d));
			} 
		}
		
		arSort($aryPages, SORT_NUMERIC);
		
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