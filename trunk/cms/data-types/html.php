<?php
require_once getRootPath() . "/classes/core/DataType.php";
require_once getRootPath() . "/classes/helpers/SettingsHelper.php";

class type_html extends DataType {
	
	public function edit ($name, $id, $value) {
		$value = htmlentities($value);
		$strReturn = "<!-- TINYMCE -->";
		$strReturn .= "<textarea name=\"$name\" id=\"$id\" rows=\"30\" cols=\"80\" style=\"width: 100%\">$value</textarea>";
		$strReturn .= "<script type=\"text/javascript\">
				tinyMCE.init({
					// General options
					mode : \"exact\",
					theme : \"advanced\",
					elements : \"$id\",
					plugins : \"safari,pagebreak,style,layer,table,save,advhr,advimage,imgmap,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount\",
					relative_urls : false,
					
					// Theme options
					theme_advanced_buttons1 : \"save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect\",
					theme_advanced_buttons2 : \"cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,imgmap,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor\",
					theme_advanced_buttons3 : \"tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen\",
					theme_advanced_buttons4 : \"insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
					theme_advanced_toolbar_location : \"top\",
					theme_advanced_toolbar_align : \"left\",
					theme_advanced_statusbar_location : \"bottom\",
					theme_advanced_resizing : true,
					
					// Content CSS (should be your site CSS)
					";
		if ( file_exists(getRootPath()."/styles/".SettingsHelper::getSetting("Theme")."/lib/editor.css") ) {
			$strReturn .= "content_css : \"".getRootURL()."/styles/".SettingsHelper::getSetting("Theme")."/lib/editor.css\",";
		} else {
			$strReturn .= "content_css : \"lib/tinymce/css/content.css\",";
		}
			$strReturn .= "
					
					// Drop lists for link/image/media/template dialogs
					external_link_list_url : \"lib/tinymce/lists.php?type=link\",
					external_image_list_url : \"lib/tinymce/lists.php?type=image\",
					media_external_list_url : \"lib/tinymce/lists.php?type=media\"
				});
		</script>";
		$strReturn .= "<!-- /TINYMCE -->";
		return $strReturn;
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