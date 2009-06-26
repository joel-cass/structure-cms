<form action="" method="POST">
	<div>
		<label for="txtSearch">Enter Keyword:</label>
		<input type="text" name="keyword" id="txtSearch" value="<?php echo $keyword?>">
		<input type="submit" class="button" value="GO">
	</div>
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
</form>

<div class="clear">&nbsp;</div>