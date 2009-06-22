<?php
$aryPage = array();

$objSection = $PAGE;
$aryPage[] = $objSection;
while($objSection->getParent() != null) {
	$objSection = $objSection->getParent();
	$aryPage[] = $objSection;
}

$aryPage = array_reverse($aryPage);

echo "<ul>";
for ($i = 0; $i < count($aryPage); $i++) {
	$objPage = $aryPage[$i];
	if ($objPage->path == $PAGE->path) {
		echo "<li>" . $objPage->getField("Title")->getValue() . "</li>";
	} else {
		echo "<li><a href=\"" . $objPage->getURL() . "\">" . $objPage->getField("Title")->getValue() . "</a></li>";
	}
}
echo "</ul>";
?>