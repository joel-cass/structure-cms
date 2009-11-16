<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta name="Keywords" content="<?php LayoutHelper::renderField($PAGE, "Keywords"); ?>">
	<meta name="Description" content="<?php LayoutHelper::renderField($PAGE, "Description"); ?>">
	<title><?php LayoutHelper::renderField($PAGE, "Title"); ?></title>
	<link href="<?php echo getRootURL(); ?>/styles/<?php echo SettingsHelper::getSetting("Theme"); ?>/lib/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="page-wrapper">
		<div id="page">
			<div id="site-name">
				<span><?php echo SettingsHelper::getSetting("Site Name"); ?></span>
			</div>
			<div id="navigation">
				<?php include "includes/nav.php" ?>
			</div>
			<div id="content-wrapper">
				<div id="content" class="home">
					<?php LayoutHelper::renderPlaceHolder($PAGE, "Main"); ?>
				</div>
				<div id="side">
					<?php LayoutHelper::renderPlaceHolder($PAGE, "Side"); ?>
				</div>
				<div class="clear-hidden"></div>
			</div>
			<div id="footer">
				<?php include "includes/footer.php" ?>
				&copy; 2009 Joel Cass
				<div class="clear-hidden"></div>
			</div>
		</div>
	</div>
</body>

</html>
