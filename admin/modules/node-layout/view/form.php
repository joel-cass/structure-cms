<?php include_once(getRootPath() . "/structureCMS/classes/controls/ListBuilder.php"); ?>

<?php ListBuilder::init(); ?>

<form action="" method="POST">

	<h2>Editing Layout: <?php echo $strNode?></h2>

	<ul id="actions-nav">
		<li><a href="node-edit.php?node=<?php echo $strNode?>">Go back</a></li>
	</ul>
	<div class="clear-hidden"></div>

	<h3>Layout</h3>

	<fieldset>
		<label for="layout">layout</label>
		<select name="layout" id="layout">
			<option></option>
			<?php 
			for ($i = 0; $i < count($aryLayouts); $i++) {
				$strOption = "<option value=\""; 
				$strOption .= $aryLayouts[$i]; 
				$strOption .= "\"";
				if ($aryLayouts[$i] == $strLayout) { 
					$strOption .= " selected";
				} 
				$strOption .= ">"; 
				$strOption .= $aryLayouts[$i]; 
				$strOption .= "</option>"; 
				echo $strOption; 
			} 
			?>
		</select>
		<input type="hidden" name="old-layout" value="<?php echo($strLayout)?>">
	</fieldset>

	<h3>Placeholders</h3>

	<?php for ($i = 0; $i < count($aryPlaceholders); $i++) {
		$strName = $aryPlaceholders[$i];
		$strKey = strToLower($aryPlaceholders[$i]);
		$strField = "placeholder_" . preg_replace("[^A-Za-z0-9]", "_", $strName);
		if (array_key_exists($strKey, $aryViewsSelected)) {
			$arySelected = $aryViewsSelected[$strKey];
		} else {
			$arySelected = array();
		}
		if (array_key_exists($strKey, $aryViewsAvailable)) {
			$aryAvailable = $aryViewsAvailable[$strKey];
		} else {
			$aryAvailable = null;
		}
		?>
		<fieldset>
			<label for="<?php echo $strField?>" title="<?php echo $strDescription?>">Placeholder: <?php echo $strName?></label>
			<?php ListBuilder::render($strField, $aryAvailable, $arySelected); ?>
		</fieldset>
		<input type="hidden" name="placeholders[]" value="<?php echo $strName; ?>">
	<?php } ?>
	
	<input type="hidden" name="node" value="<?php echo $strNode; ?>">
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" value="Save Layout">

</form>