<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>
	<meta name="Keywords" content="<?php LayoutHelper::renderField($PAGE, "Keywords"); ?>">
	<meta name="Description" content="<?php LayoutHelper::renderField($PAGE, "Description"); ?>">
	<title><?php LayoutHelper::renderField($PAGE, "Title"); ?></title>
	<link href="<?php echo getRootURL(); ?>/jnet/lib/style.css" rel="stylesheet" type="text/css">
	<script src="<?php echo getRootURL(); ?>/jnet/lib/suckerfish.js" type="text/javascript"></script>
</head>

<body>
	<div id="page-wrapper">
		<div id="site-name">
			<span>StructureCMS</span>
		</div>
		<div id="navigation">
			<?php include "includes/nav.php" ?>
		</div>
		<div id="content-wrapper">
			<div id="side-nav">
				<?php include "includes/side-nav.php" ?>
			</div>
			<div id="content">
				<div id="breadcrumb">
					<?php include "includes/bread-crumb.php" ?>
				</div>
				<?php LayoutHelper::renderPlaceHolder($PAGE, "Main"); ?>
			</div>
			<div class="clear-hidden"></div>
		</div>
		<div id="footer">
			<?php include "includes/footer.php" ?>
			<div class="clear-hidden"></div>
		</div>
	</div>
</body>

</html>
