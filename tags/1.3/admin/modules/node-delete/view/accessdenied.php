<form action="" method="POST">

	<h2>Access Denied</h2>

	<p>Unfortunately, the node <?php echo $strNode ?> cannot be deleted.</p>

	<input type="hidden" name="<?php echo $modeField; ?>" value="cancel">
	
	<input type="submit" name="button" value="OK">

</form>