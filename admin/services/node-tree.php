<?php

include_once "../../classes/includes/paths.php";
include_once getRootPath() . "/classes/core/Page.php";
include_once getRootPath() . "/classes/core/PageOrder.php";

$node = "";
if ( array_key_exists("node", $_REQUEST) ) {
	$node = $_REQUEST["node"];
}

$blnAjax = true;
if ( array_key_exists("ajax", $_REQUEST) ) {
	$blnAjax = $_REQUEST["ajax"] != true;
}

if ( array_key_exists("move", $_REQUEST) ) {
	$parent_node = listDeleteAt($node, listLen($node, "/"), "/");
	$node_name = listGetAt($node, listLen($node, "/"), "/");
	$objPageOrder = new PageOrder($parent_node);
	$objPageOrder->move($node_name, $_REQUEST["move"]);
	$objPageOrder->save();
	$node = $parent_node;
}

$strParentID = "node_" . md5("$node");

if (!isset($_SESSION)) {
	session_start();
}

echo "<!-- Path:\"".$node."\" -->";
echo "<!-- Children:".count(Page::getPages($node, false))." -->";

if (!array_key_exists("nodes", $_SESSION)) {
	$_SESSION["nodes"] = array();
}
if (array_key_exists("close", $_GET)) {
	$_SESSION["nodes"][$node] = "closed";
	exit();
} else {
	$_SESSION["nodes"][$node] = "open";
}

if ( $blnAjax ) {
	?>
	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
		<title>Tree</title>
		<link href="../lib/admin.css" rel="STYLESHEET" type="text/css">
		<link href="../lib/jquery.contextMenu/jquery.contextMenu.css" rel="STYLESHEET" type="text/css">
		<script src="../lib/admin.js" type="text/javascript"></script>
		<script src="../lib/jquery-1.3.1.min.js" type="text/javascript"></script>
		<script src="../lib/jquery.contextMenu/jquery.contextMenu.js" type="text/javascript"></script>
		<script src="../lib/node-tree.js" type="text/javascript"></script>
	</head>
	<body class="side-pane">
	<ul class="tree">
		<li>
			<a href="#" id="lnkRoot">[root]</a>
			<ul id="<?php echo $strParentID;?>">
	<?php
}

function showPages($node) {
	$aryPages = Page::getPages($node, false);
	
	for ($i = 0; $i < count($aryPages); $i++) {
		$strName = $aryPages[$i]->getName();
		$strEntry = $node . "/" . $strName;
		$strID = "node_" . md5("$strEntry");
		$numChildren = count(Page::getPages($strEntry, false));
		//$aryChildren = array();
		echo "<li class=\"";
		if (array_key_exists($strEntry, $_SESSION["nodes"]) && $_SESSION["nodes"][$strEntry] == "open") {	
			echo "open";
		} elseif ($numChildren > 0) {
			echo "closed";
		} else {
			echo "empty";
		}
		echo "\">";
			echo "<a href=\"#\" class=\"node\" onclick=\"clickNode(this.parentNode, '$strEntry', '#$strID');return false;\">&nbsp;</a>";
				echo "<a href=\"../node-edit.php?node=$strEntry\" target=\"main\" rel=\"$strEntry\">$strName</a>";
			echo "<ul id=\"$strID\" REL=\"$strEntry\">";
				if (array_key_exists($strEntry, $_SESSION["nodes"]) && $_SESSION["nodes"][$strEntry] == "open") {
					showPages($strEntry);
				}
			echo "</ul>";
		echo "</li>";
	}
}
showPages($node);

if ( $blnAjax ) {
	?>
			</ul>
		</li>
	</ul>
	<ul id="actionsMenu" class="contextMenu">
	    <li class="edit">
	        <a href="#edit">Edit</a>
	    </li>
	    <li class="layout">
	        <a href="#layout">Layout</a>
	    </li>
	    <li class="create">
	        <a href="#create">Create</a>
	    </li>
	    <li class="delete">
	        <a href="#delete">Delete</a>
	    </li>
	    <li class="up separator">
	        <a href="#up">Move Up</a>
	    </li>
	    <li class="down">
	        <a href="#down">Move Down</a>
	    </li>
	</ul>
	<ul id="bodyActionsMenu" class="contextMenu">
	    <li class="create">
	        <a href="#create">Create</a>
	    </li>
	</ul>
	<script type="text/javascript">
	<!-- 
	$(document).ready( function() {
		// set default on body
		$("#lnkRoot").contextMenu(
			{ menu: "bodyActionsMenu" },
			contextMenu_select
		);
		// set specific on pages
		$("#<?php echo $strParentID;?> A").contextMenu(
				{ menu: "actionsMenu" },
				contextMenu_select
			);
	});
	// -->
	</script>
	<div id="logout">
		<a href="../logout.php" target="_parent">
			<img src="../images/logout.png" alt="Logout" width="16" height="16" border="0" align="left">
			Logout
		</a>
	</div>
	</body>
	</html>
	<?php
} else {
	?>
	<script type="text/javascript">
	<!-- 
		// this assumes that the document is now loaded
		$("#<?php echo $strParentID;?> A").contextMenu(
			{ menu: "actionsMenu" },
			contextMenu_select
		);
	// -->
	</script>
	<?php
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