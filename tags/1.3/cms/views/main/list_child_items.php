<!-- @@name: List Child Items -->

<?php $children = $PAGE->GetChildren(); ?>

<?php foreach ($children as $child) { ?>

	<?php if ($child->getField("Listing Image")->getValue() != "") { ?>
		<div class="listing-image">
			<a href="<?php echo $child->getURL();?>">
				<img src="<?php LayoutHelper::renderField($child, "Listing Image");?>" alt="<?php LayoutHelper::renderField($child, "Title");?>" border="0" />
			</a>
		</div>
	<?php }?>

	<h2><?php LayoutHelper::renderLink($child, "Title"); ?></h2>
	
	<?php LayoutHelper::renderField($child, "Description"); ?>

	<div class="hr"><hr/></div>

<?php } ?>