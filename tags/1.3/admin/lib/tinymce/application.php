<?php 

require_once "../../application.php";
//require_once "../../application.php";

$aryDenyFileExt = split(",","exe,dll,asp,aspx,php,cfm");

$stcTypes = array();

$stcTypes["image"] = array();
$stcTypes["image"]["path"] = "site_files/images";
$stcTypes["image"]["extensions"] = split(",","gif,jpeg,jpg,png");
$stcTypes["image"]["tinyMceVarName"] = "tinyMCEImageList";
$stcTypes["image"]["mimetypes"] = split(",","image/gif,image/jpeg,image/png");

$stcTypes["link"] = array();
$stcTypes["link"]["path"]  = "site_files/files";
$stcTypes["link"]["extensions"] = split(",","pdf,zip,txt,htm,html,doc,xls,ppt,csv,docx,xlsx,pptx");
$stcTypes["link"]["tinyMceVarName"] = "tinyMCELinkList";
$stcTypes["link"]["mimetypes"] = split(",","image/gif,image/jpeg,image/png,text/plain,application/rdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/pdf,application/x-pdf,application/acrobat,applications/vnd.pdf,text/pdf,text/x-pdf");

$stcTypes["media"] = array();
$stcTypes["media"]["path"] = "site_files/flash";
$stcTypes["media"]["extensions"] = split(",","swf,spl,flv,rm,ra,ram,dir,dcr,asf,wma,wax,wmv,wvx,wm,wmx,wmz,wmd,rm,ra,rv,mov");
$stcTypes["media"]["tinyMceVarName"] = "tinyMCEMediaList";
$stcTypes["media"]["mimetypes"] = split(",","application/x-shockwave-flash,application/x-shockwave-flash2-preview,application/futuresplash,image/vnd.rn-realflash,application/x-director,image/x-freehand,video/x-ms-asf,video/x-ms-asf,audio/x-ms-wma,audio/x-ms-wax,audio/x-ms-wmv,video/x-ms-wvx,video/x-ms-wm,video/x-ms-wmx,application/x-ms-wmz,application/x-ms-wmd,application/vnd.rn-realmedia,audio/vnd.rn-realaudio,video/vnd.rn-realvideo,audio/x-pn-realaudio,audio/x-pn-realaudio-plugin,video/quicktime");

?>