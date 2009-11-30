<ul>
<?php $pages=LayoutHelper::getPage("/footer")->getChildren();foreach ($pages as $page) {?>
	<li><?php LayoutHelper::renderLink($page);?></li>
<?php } ?>
</ul>
