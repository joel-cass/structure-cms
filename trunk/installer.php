<?php 
require_once "classes/core/Page.php";

if (!is_dir(getPath(""))) {
	mkdir(getPath(""));
}
if (!Page::isPage("/home")) {
	$home = Page::create("/home", "content");
	$home->setField("Title", "Home");
	$home->setField("Content", "<h2>Welcome to StructureCMS!</h2><p>Lorem ipsum dolor sit amet...</p>");
	$home->setLayout("home");
	$home->save();
}
if (!Page::isPage("/home/about")) {
	$about = Page::create("/home/about", "content");
	$about->setField("Title", "About");
	$about->setField("Content", "<h2>Welcome to StructureCMS!</h2><p>Lorem ipsum dolor sit amet...</p>");
	$about->save();
}
if (!Page::isPage("/footer")) {
	$footer = Page::create("/footer", "content");
	$footer->setField("Title", "Footer");
	$footer->save();
}
if (!Page::isPage("/footer/contact")) {
	$contact = Page::create("/footer/contact", "content");
	$contact->setField("Title", "Contact");
	$contact->setField("Content", "<h2>Welcome to StructureCMS!</h2><p>Lorem ipsum dolor sit amet...</p>");
	$contact->save();
}

?>