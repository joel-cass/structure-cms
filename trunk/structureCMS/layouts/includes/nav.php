<?php 
if (!function_exists("nav_renderNavItem")) {
	function nav_renderNavItem ($page, $type=null, $recurse=true) {
		global $PAGE;
		$strURL = $page->getURL();
		$strTitle = $page->getField("Title")->getValue();
		if ($recurse == true) {
			$strSubNav = nav_renderNavItemsBelow ($page, $type);
		} else {
			$strSubNav = "<ul></ul>";
		}
		$strAttribs = "";
		if (($page->path != "/home" || $PAGE->path == "/home") && strstr($PAGE->path, $page->path)) $strAttribs .= " class=\"selected\"";
		return "<li$strAttribs><a href=\"$strURL\">$strTitle</a>$strSubNav</li>";
	}
	
	function nav_renderNavItemsBelow ($parent, $type=null, $includeParent=false) {
		$aryPages = $parent->getChildren();
		$strReturn = "";
		$strReturn .= "<ul>";
		if ($includeParent == true) {
			$strReturn .= nav_renderNavItem($parent, $type, false);
		}
		for ($i = 0; $i < count($aryPages); $i++) {
			if ($type != null && $aryPages[$i]->getContentType() != $type) continue;
			$strReturn .= nav_renderNavItem($aryPages[$i], $type);
		}	
		$strReturn .= "</ul>";
		return $strReturn;
	}
	
}
echo nav_renderNavItemsBelow(new Page("/home"), "content", true);

?>