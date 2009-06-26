<!-- @@name: List Child Items -->

<?php function subnav_listitems($page) { 
	$children = $page->GetChildren();
	if (count($children) > 0) { ?>
		<ul>
		<?php foreach ($children as $child) { ?>
			<li>
				<a href="<?php echo $child->getURL(); ?>"><?php LayoutHelper::renderField($child, "Title"); ?></a>
				<?php subnav_listitems($child); ?>
			</li>
		<?php } ?>
		</ul>
	<?php } ?>
<?php } ?>

<?php subnav_listitems($PAGE); ?>