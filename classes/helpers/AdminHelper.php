<?php

require_once getRootPath() . "/cms/config/users.php";

class AdminHelper {

	/* CONSTANTS */

	const MODE_PUBLIC = "public";
	const MODE_ADMIN = "admin";
	const MODE_PREVIEW = "preview";
	
	/* STATIC METHODS */
	
	public static function session_init () {
		session_start();
		if (array_key_exists("fc_mode", $_REQUEST)) {
			$_SESSION["fc_mode"] = $_REQUEST["fc_mode"];
		}
	}

	
	public static function session_footer () {
		if (array_key_exists("fc_mode", $_SESSION)) {
			$mode = $_SESSION["fc_mode"];
			if ($mode == AdminHelper::MODE_ADMIN) {
				AdminHelper::admin_footer();
			} elseif ($mode == AdminHelper::MODE_PREVIEW) {
				AdminHelper::preview_footer();
			}
		}
	}
	

	public static function admin_footer () {
		echo "<hr>Admin";
	}
	

	public static function preview_footer () {
		echo "<hr>PREVIEW";
	}


	public static function authenticate ($username, $password) {
		global $aryUsers;
		$blnValidated = false;
		$password = hash("md5",strtolower($password));
		foreach ($aryUsers as $u) {
			if ($username == $u[0] && $password == $u[1]) {
				return true;
			}
		}
		return false;
	}
	

	public static function session_authenticate ($username, $password) {
		return true;
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