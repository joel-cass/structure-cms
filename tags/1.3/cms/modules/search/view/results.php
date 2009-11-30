<?php include "form.php"; ?>

<?php foreach ($aryResult as $i=>$r) {?>

	<h3><a href="<?php echo $r->getURL() ?>"><?php echo $r->getField("Title")->getValue() ?></a></h3>
	<p><?php echo $r->getField("Description")->getValue() ?></p>
	<hr />

<?php } ?>