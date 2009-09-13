<?php
require_once getRootPath() . "/classes/core/DataType.php";

class type_image extends DataType {
	
	public function edit ($name, $id, $value) {
		$strReturn = "<input type=\"file\" name=\"$name\" id=\"$id\">";
		if ($value != "") {
			$href = $this->render($value, $this->options);
			// get image info
			list($width, $height) = getimagesize(getRootPath() . $this->options["path"] . "/" . $value);
			$imgHeight = min($height, 75);
			// output image
			$strReturn .= "<br><a href=\"$href\" target=\"_blank\"><img src=\"$href\" height=\"$imgHeight\" border=\"0\"></a>";
			// output info
			$strReturn .= "<br>($value, $width x $height)";
		}
		return $strReturn;
	}
	
	public function process ($name, $value) {
		if ($value != null && $value["name"] != null && $value["tmp_name"] != null && $value["tmp_name"] != "") {
			$strDest = getRootPath() . $this->options["path"];
			$strName = ereg_replace("[^A-Za-z0-9\.]", "-", $value["name"]);
			
			if (!file_exists($strDest)) {
				mkdir($strDest);
			}
			
			if (!array_key_exists("conflict", $this->options) || $this->options["conflict"] == "make-unique") {
				// fancy action: make files unique
				$strOrigName = $strName;
				$i = 1;
				while (file_exists("$strDest/$strName")) {
					$strName = ereg_replace("(\.[^\.]*)$", "_$i\\1", $strOrigName);
					$i++;
				}
			} elseif (file_exists("$strDest/$strName")) {
				// default action: overwrite
				unlink("$strDest/$strName");
			}
			
			if (array_key_exists("max-width", $this->options) && array_key_exists("max-height", $this->options)) {
				$this->resize ($value["tmp_name"], $this->options["max-width"], $this->options["max-height"]);
			} else if (array_key_exists("max-width", $this->options)) {
				$this->resize ($value["tmp_name"], $this->options["max-width"], 999999999);
			} else if (array_key_exists("max-height", $this->options)) {
				$this->resize ($value["tmp_name"], 999999999, $this->options["max-height"]);
			}
			
			copy($value["tmp_name"], "$strDest/$strName");
			
			return $strName;
		}
		return null;
	}
	
	public function render ($value) {
		return getRootURL() . $this->options["path"] . "/" . $value;
	}
	
	/* PRIVATE METHODS */
	
	private function resize ( $strPath, $maxWidth, $maxHeight ) {
		
		// Get new dimensions
		list($width, $height) = getimagesize($strPath);
		$xratio = $maxWidth / $width;
		$yratio = $maxHeight / $height;
		$new_width = $width * min($xratio, $yratio);
		$new_height = $height * min($xratio, $yratio);

		// Get extension
		$ext = explode(".", $strPath);
		$ext = $ext[count($ext)-1];
		
		// Resample
		$image_p = imagecreatetruecolor($new_width, $new_height);
		if ($ext == "jpg" || $ext == "jpeg") {
			$image = imagecreatefromjpeg($strPath);
		} elseif ($ext == "png") {
			$image = imagecreatefrompng($strPath);
		} elseif ($ext == "gif") {
			$image = imagecreatefromgif($strPath);
		}
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		
		// Output
		if ($ext == "jpg" || $ext == "jpeg") {
			imagejpeg($image_p, $strPath, 80);
		} elseif ($ext == "png") {
			imagepng($image_p, $strPath, 80);
		} elseif ($ext == "gif") {
			imagegif($image_p, $strPath, 80);	
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