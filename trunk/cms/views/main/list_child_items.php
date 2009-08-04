<!-- @@name: List Child Items -->

<?php $children = $PAGE->GetChildren(); ?>

<?php foreach ($children as $child) { ?>

	<h2><?php LayoutHelper::renderLink($child, "Title"); ?></h2>
	
	<?php if ($child->getField("Listing Image")->getValue() != "") {
		echo "<div class=\"listing-image\">";
		LayoutHelper::renderField($child, "Listing Image"); 
		echo "</div>";
	}?>

	<?php LayoutHelper::renderField($child, "Description"); ?>

	<hr>

<?php } ?>