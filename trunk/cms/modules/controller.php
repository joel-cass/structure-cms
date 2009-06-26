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

	function Controller( $module, $defaultMode="default", $modeField="", $params=array() ) {
		
		$path = dirName(__FILE__);
		$mode = $defaultMode;
		
		if ($modeField == "") {
			$modeField = $module . "_mode";
		}
		
		if (!is_dir($path . "/" . $module)) {
			die("Module " . $path . "/" . $module . " not found in $path.");
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
	
?>