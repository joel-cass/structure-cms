<?php 
require_once "classes/core/Page.php";

if (!is_dir(getPath(""))) {
	mkdir(getPath(""));
}

// Create website tree
if (!Page::isPage("/home")) {
	$home = Page::create("/home", "content");
	$home->setField("Title", "Home");
	$home->setField("Description", "Home page of a default installation of StructureCMS");
	$home->setField("Keywords", "StructureCMS Content Management System");
	$home->setField("Content", "<h2>Welcome to StructureCMS!</h2><p>Your site has been installed and is ready to use. The following links may be of assistance to you.</p><ul><li><a href=\"" . getRootURL() . "/admin\">Administration</a> (U:admin, p:yay)</li><li><a href=\"" . getRootURL() . "/content/rss/latest/\">RSS Feed</a></li></ul>");
	$home->setLayout("home");
	$home->save();
}
if (!Page::isPage("/home/about")) {
	$about = Page::create("/home/about", "content");
	$about->setField("Title", "About");
	$about->setField("Description", "About StructureCMS");
	$about->setField("Keywords", "StructureCMS Content Management System");
	$about->setField("Content", "<h2>About StructureCMS</h2><p>For more information, please visit <a href=\"http://code.google.com/p/structure-cms/\">the project home page</a></p>");
	$about->save();
}

// Create footer tree
if (!Page::isPage("/footer")) {
	$footer = Page::create("/footer", "content");
	$footer->setField("Title", "Footer");
	$footer->save();
}
if (!Page::isPage("/footer/contact")) {
	$contact = Page::create("/footer/contact", "contact-form");
	$contact->setField("Title", "Contact");
	$contact->setField("Description", "Contains a dummy contact form for testing purposes. Or you could actually use it.");
	$contact->setField("Keywords", "StructureCMS Content Management System");
	$contact->setField("Content", "<h2>Contact Form</h2><p>No email address has been entered. You will need to enter one.</p>");
	$contact->save();
}
if (!Page::isPage("/footer/search")) {
	$search = Page::create("/footer/search", "content");
	$search->setField("Title", "Search");
	$search->setField("Description", "A simple text-based file crawling search engine.");
	$search->setField("Keywords", "StructureCMS Content Management System");
	$search->setField("Content", "<h2>Search</h2><p>Enter a keyword, see if it turns up.</p>");
	$search->setPlaceHolderViews('main',array('main/title_and_text.php','main/search.php'));
	$search->save();
}

// Create RSS tree
if (!Page::isPage("/rss")) {
	$footer = Page::create("/rss", "content");
	$footer->setField("Title", "RSS");
	$footer->setField("Description", "RSS feeds root page");
	$footer->setField("Keywords", "StructureCMS Content Management System");
	$footer->save();
}
if (!Page::isPage("/rss/latest")) {
	$latest = Page::create("/rss/latest", "rss");
	$latest->setField("Title", "Latest Items");
	$latest->setField("Description", "An RSS Feed containing latest items.");
	$latest->setField("Keywords", "StructureCMS Content Management System");
	$latest->setField("Description", "Latest items created or modified on the site");
	$latest->save();
}

?>