<?php
require_once getRootPath() . "/structureCMS/classes/core/DataType.php";

class type_html extends DataType {
	
	public function edit ($name, $id, $value) {
		$value = htmlentities($value);
		$strReturn = "<!-- TINYMCE -->";
		$strReturn .= "<textarea name=\"$name\" id=\"$id\" rows=\"15\" cols=\"80\" style=\"width: 100%\">$value</textarea>";
		$strReturn .= "<script type=\"text/javascript\">
				tinyMCE.init({
					// General options
					mode : \"exact\",
					theme : \"advanced\",
					elements : \"$id\",
					plugins : \"safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template\",
			
					// Theme options
					theme_advanced_buttons1 : \"bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,cleanup,help,code\",
					theme_advanced_buttons2 : \"bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,tablecontrols,|,hr,removeformat,visualaid,|,sub,sup\",
					theme_advanced_buttons3 : \"charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak\",
					theme_advanced_buttons4 : \"\",
					theme_advanced_toolbar_location : \"top\",
					theme_advanced_toolbar_align : \"left\",
					theme_advanced_statusbar_location : \"bottom\",
					theme_advanced_resizing : true,

					// Other options
					external_link_list_url : \"".getRootURL()."/admin/services/tinymce-node-list.php\",
					
					// Example content CSS (should be your site CSS)
					content_css : \"lib/tiny_mce/css/content.css\"
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