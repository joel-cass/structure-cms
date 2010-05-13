<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta name="Keywords" content="<?php LayoutHelper::renderField($PAGE, "Keywords"); ?>">
	<meta name="Description" content="<?php LayoutHelper::renderField($PAGE, "Description"); ?>">
	<title><?php LayoutHelper::renderField($PAGE, "Title"); ?> &laquo; <?php echo SettingsHelper::getSetting("Site Name"); ?></title>
	<link href="<?php echo getRootURL(); ?>/styles/<?php echo SettingsHelper::getSetting("Theme"); ?>/lib/style.css" rel="stylesheet" type="text/css">
	<?php if (file_exists(getRootPath()."/styles/".SettingsHelper::getSetting("Theme")."/head.php")) { include(getRootPath()."/styles/".SettingsHelper::getSetting("Theme")."/head.php"); }?>
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
			<div id="navigation-footer"></div>
			<div id="content-wrapper">
				<div id="side-nav">
					<?php include "includes/side-nav.php" ?>
				</div>
				<div id="breadcrumb">
					<?php include "includes/bread-crumb.php" ?>
				</div>
				<div id="content">
					<?php LayoutHelper::renderPlaceHolder($PAGE, "Main"); ?>
				</div>
				<div class="clear-hidden"></div>
			</div>
			<div id="footer">
				<?php include "includes/footer.php" ?>
				<a href="http://www.jozza.net/content/home/projects/structure-cms/"><img src="<?php getPath("")?>/structurecms-logo.gif" border="0" alt="&copy; Created using StructureCMS" title="&copy; Created using StructureCMS"></a>
				<div class="clear-hidden"></div>
			</div>
		</div>
	</div>
</body>

</html>
