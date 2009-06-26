<!-- @@name: List Child Items -->

<?php $children = $PAGE->GetChildren(); ?>

<?php foreach ($children as $child) { ?>

	<h2><?php LayoutHelper::renderLink($child, "Title"); ?></h2>
	
	<?php LayoutHelper::renderField($child, "Description"); ?>

	<hr>

<?php } ?>