<?php
/*
 * @name: Controller Framework
 * @author: Joel Cass
 * @description: Very basic framework for minor applications
 * 	Structure:
 * 		[attributes.module]/
 * 			action/
 * 				[mode].php - gets / modifies data as per instruction	[optional]
 * 			view/
 * 				[mode].php - displays data / interfaces, can also be used for relocations.
 */

	function Controller( $module, $defaultMode="default", $modeField="" ) {
		
		$path = realpath("./modules");
		$mode = $defaultMode;
		
		if ($modeField == "") {
			$modeField = $module . "_mode";
		}
		
		if (!is_dir($path . "/" . $module)) {
			die("Module " . $path . "/" . $module . " not found.");
		}
		
		if (array_key_exists($modeField, $_POST)) {
			$mode = $_POST[$modeField];
		} elseif (array_key_exists($modeField, $_GET)) {
			$mode = $_GET[$modeField];
		}


		# include model file from processing / getting data
		$lastMode = "";
		while ($lastMode != $mode) {
			$lastMode = $mode;
			$actionPath = $path . "/" . $module . "/action/" . $mode . ".php";
			if (file_exists($actionPath)) {
				include($actionPath);
			}
		}

		# include view file for displaying data
		$viewPath = $path . "/" . $module . "/view/" . $mode . ".php";
		if (file_exists($viewPath)) {
			include($viewPath);
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