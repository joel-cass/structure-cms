<?php
require_once getRootPath() . "/classes/helpers/PageHelper.php";

$strParentNode = $PAGE->path;
$strContentType = "";
$numItems = 20;

if ($PAGE->getField("Parent Node") != "") {
	$strParentNode = $PAGE->getField("Parent Node")->getValue();
}
if ($PAGE->getField("Content Type") != "") {
	$strContentType = $PAGE->getField("Content Type")->getValue();
}
if ($PAGE->getField("Number of Items") != "") {
	$numItems = $PAGE->getField("Number of Items")->getValue();
}

$children = PageHelper::getRecentlyModified(getPath($strParentNode), $numItems, $strContentType);

foreach ($children as $child) {
	$aryFileInfo = $child->getFileInfo();
?>
		<item>
			<title><?php LayoutHelper::renderField($child, "Title"); ?></title>
			<link><?php echo $child->getURL() ?></link>
			<description><?php LayoutHelper::renderField($child, "Description"); ?></description>
			<pubDate><?php echo Date("D, d F Y H:i:s e",$aryFileInfo["modified"]); ?></pubDate>
			<guid><?php echo $child->getURL() ?></guid>
		</item>

<?php
}
?>