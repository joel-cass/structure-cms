<?php 
if (!function_exists("sidenav_renderNavItem")) {
	
	function sidenav_renderNavItem ($page, $type=null, $bloodline=null) {
		global $PAGE;
		$strURL = $page->getURL();
		$strTitle = $page->getField("Title")->getValue();
		$strSubNav = sidenav_renderNavItemsBelow ($page, $type, $bloodline);
		$strAttribs = "";
		if ($PAGE->path == $page->path) $strAttribs .= " class=\"selected\"";
		return "<li><a href=\"$strURL\"$strAttribs>$strTitle</a>$strSubNav</li>";
	}
	
	function sidenav_renderNavItemsBelow ($parent, $type=null, $bloodline=null) {
		$aryPages = $parent->getChildren();
		$strReturn = "";
		if (count($aryPages) > 0) {
			$strReturn .= "<ul>";
			for ($i = 0; $i < count($aryPages); $i++) {
				if ($type != null && $aryPages[$i]->getContentType() != $type) continue;
				if ($bloodline != null && !strstr($bloodline, $parent->path)) continue;
				$strReturn .= sidenav_renderNavItem($aryPages[$i], $type, $bloodline);
			}	
			$strReturn .= "</ul>";
		}
		return $strReturn;
	}
	
}

$objSection = $PAGE;
if ($objSection->path != "/home") {
	while($objSection->getParent() != null && $objSection->getParent()->path != "/home") {
		$objSection = $objSection->getParent();
	}
	echo sidenav_renderNavItemsBelow($objSection, null, $PAGE->path);
}

?>