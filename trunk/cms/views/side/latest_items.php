<!-- @@name: Latest Items -->

<?php 
$root = getPath("");
$path = $PAGE->path;
$paths = FileSystemHelper::GetRecentlyModified($root, $path); ?>


<?php $i = 0; ?>
<?php $numMaxItems = 10; ?>

<div class="container">
	
	<h2>Latest Items</h2>
	
	<?php foreach ($paths as $path=>$date) { ?>
		
		<?php $child = new Page($path); ?>
		
		<?php if ($i < $numMaxItems) { ?>
			<h3><a href="<?php echo $child->getURL(); ?>"><?php LayoutHelper::renderField($child, "Title"); ?></a></h3>
			<?php if ($child->getField("Description")->getValue() != "") { ?>
				<p><?php LayoutHelper::renderField($child, "Description"); ?></p>
			<?php }?>
		<?php } ?>
		
		<?php $i++; ?>
	
	<?php } ?>
	
</div>