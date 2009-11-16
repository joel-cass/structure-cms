<?php 
require_once "classes/core/Page.php";

if (Page::isPage("/home")) {
	die("System is installed.");
}

if (array_key_exists("password",$_POST) && $_POST["password"] != "" && $_POST["password"] == $_POST["password2"]) {
	
	// set up admin account
	$strUserFilePath = getRootPath() . "/cms/config/users.php";
	$strUserFile = file_get_contents($strUserFilePath);
	$strUsername = $_POST["username"];
	$strPassword = hash("md5", strtolower($_POST["password"]));
	$strExpression = "/\\\$aryUsers\[\] = array\(\"admin\", \"[^\"]*\"\);/";
	$strReplace = "\$aryUsers[] = array(\"" . $strUsername . "\", \"" . $strPassword . "\");";
	if (preg_match($strExpression, $strUserFile) > 0) {
		$strUserFile = preg_replace(
				$strExpression,
				$strReplace,
				$strUserFile
			);
	} else {
		$strUserFile = "<?php \$aryUsers = array(); $strReplace ?>";
	}
	file_put_contents($strUserFilePath, $strUserFile);
	
	// create content folder
	if (!is_dir(getPath(""))) {
		mkdir(getPath(""));
	}

	// Create website tree
	if (!Page::isPage("/home")) {
		$home = Page::create("/home", "content");
		$home->setField("Title", "Home");
		$home->setField("Description", "Home page of a default installation of StructureCMS");
		$home->setField("Keywords", "StructureCMS Content Management System");
		$home->setField("Content", "<h2>Welcome to StructureCMS!</h2><p>Your site has been installed and is ready to use. The following links may be of assistance to you.</p><ul><li><a href=\"" . getRootURL() . "/admin\">Administration</a> (U:$strUsername, p:".$_POST["password"].")</li><li><a href=\"" . getRootURL() . "/content/footer/search/\">Search</a></li><li><a href=\"" . getRootURL() . "/content/footer/contact/\">Contact</a></li><li><a href=\"" . getRootURL() . "/content/rss/latest/\">RSS Feed</a></li></ul>");
		$home->setLayout("home");
		$home->save();
	}
	if (!Page::isPage("/home/about")) {
		$about = Page::create("/home/about", "content");
		$about->setField("Title", "About");
		$about->setField("Description", "About StructureCMS");
		$about->setField("Keywords", "StructureCMS Content Management System");
		$about->setField("Content", "<p>For more information, please visit <a href=\"http://code.google.com/p/structure-cms/\">the project home page</a></p>");
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
		$contact->setField("Content", "<p>No email address has been entered. You will need to enter one.</p>");
		$contact->save();
	}
	if (!Page::isPage("/footer/search")) {
		$search = Page::create("/footer/search", "content");
		$search->setField("Title", "Search");
		$search->setField("Description", "A simple text-based file crawling search engine.");
		$search->setField("Keywords", "StructureCMS Content Management System");
		$search->setField("Content", "<p>Enter a keyword, see if it turns up.</p>");
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
	
	// create settings
	if (!Page::isPage("/config")) {
		$settings = Page::create("/config", "settings");
		$settings->setField("Site Name", $_POST["sitename"]);
		$settings->setField("Description", "Default installation of StructureCMS");
		$settings->setField("Keywords", "StructureCMS Content Management System");
		$settings->setField("Theme", "classic");
		$settings->save();
	}
	
} else {
	$strSiteName = array_key_exists("sitename", $_POST) ? $_POST["sitename"] : "StructureCMS";
	$strUserName = array_key_exists("username", $_POST) ? $_POST["username"] : "admin";
	$strPassword1 = array_key_exists("password", $_POST) ? $_POST["password"] : "";
	$strPassword2 = array_key_exists("password2", $_POST) ? $_POST["password2"] : "";
	?>
	<html>
	
	<head>
		<title>StructureCMS Installation</title>
		<link rel="Stylesheet" type="text/css" href="admin/lib/admin.css" />
	</head>
	
	<body>

	<h1>StructureCMS Installation</h1>

	<form action="" method="POST">
		
		<fieldset>
			<label for="sitename">Site Name</label>
			<input type="text" name="sitename" id="sitename" value="<?php echo $strSiteName?>" />
		</fieldset>	
	
		<fieldset>
			<label for="username">Admin Username</label>
			<input type="text" name="username" id="username" value="<?php echo $strUserName?>" />
		</fieldset>	
	
		<fieldset>
			<label for="password">Admin Password</label>
			<input type="password" name="password" id="password" value="<?php echo $strPassword1?>" />
		</fieldset>	
	
		<fieldset>
			<label for="password2">(confirm)</label>
			<input type="password" name="password2" id="password2" value="<?php echo $strPassword2?>" />
		</fieldset>	
	
		<input type="submit" name="submit" id="submit" value="Create Site" />
	
	</form>

	</body>
	</html>
	<?php
	exit();
}
?>