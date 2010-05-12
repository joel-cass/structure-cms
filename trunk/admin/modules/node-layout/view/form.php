<?php include_once(getRootPath() . "/classes/controls/ListBuilder.php"); ?>

<?php ListBuilder::init(); ?>

<form action="" method="POST" class="edit" id="frmLayout">

	<h2>Editing Layout: <?php echo $strNode?></h2>

	<ul id="actions-nav">
		<li>
			<a href="node-edit.php?node=<?php echo $strNode?>">
				<img src="images/go-previous.png" alt="Go back" width="16" height="16" border="0" align="left">
				Go back
			</a>
		</li>
		<li>
			<a href="#" onclick="javascript:$('#frmLayout').submit();return false;">
				<img src="images/page-save.png" alt="Save layout" width="16" height="16" border="0" align="left">
				Save layout
			</a>
		</li>
	</ul>
	<div class="clear-hidden"></div>

	<h3><a id="lblLayout" href="#" onclick="javascript:switchDisplay('grpLayout',this);return false;">Layout</a></h3>
	
	<div id="grpLayout">

		<fieldset>
			<label for="layout">layout</label>
			<div class="field-container">
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
			</div>
		</fieldset>
	
	</div>

	<h3><a id="lblPlaceholders" href="#" onclick="javascript:switchDisplay('grpPlaceholders',this);return false;">Placeholders</a></h3>
	
	<div id="grpPlaceholders">

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
			<div class="field-container">
				<?php ListBuilder::render($strField, $aryAvailable, $arySelected); ?>
			</div>
		</fieldset>
		<input type="hidden" name="placeholders[]" value="<?php echo $strName; ?>">
	<?php } ?>
	
	</div>
	
	<input type="hidden" name="node" value="<?php echo $strNode; ?>">
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" value="Save Layout" id="btnSave">

</form>

<script type="text/javascript">
initDisplay('grpLayout','lblLayout');
initDisplay('grpPlaceholders','lblPlaceholders');
$("#btnSave").hide();
</script>
