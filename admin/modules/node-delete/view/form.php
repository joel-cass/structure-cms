<form action="" method="POST" id="frmDelete" class="Edit">

	<h2>Delete Page: <?php echo $strNode?></h2>

	<fieldset>
		All pages beneath this page will be deleted. Are you sure?
		<br><br>
		<input type="submit" name="button" value="Delete Node">
		<input type="submit" name="button" value="Cancel">
	</fieldset>

	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
</form>