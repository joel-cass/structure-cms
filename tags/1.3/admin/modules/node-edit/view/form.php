<?php if (isset($blnRefresh) && $blnRefresh == true) { ?>
	<script type="text/javascript">
	window.open("services/node-tree.php", "side");
	</script>
<?php } ?>

<form action="" method="POST" enctype="multipart/form-data">

	<h2>Editing: <?php echo $strNode?></h2>

	<ul id="actions-nav">
		<li><a href="node-layout.php?node=<?php echo $strNode?>">Edit page layout</a></li>
		<li><a href="node-create.php?node=<?php echo $strNode?>">Create new page</a></li>
		<li><a href="node-delete.php?node=<?php echo $strNode?>">Delete page</a></li>
		<li><a href="<?php echo $objPage->getURL()?>" target="preview">View page</a></li>
	</ul>
	<div class="clear-hidden"></div>
	
	<h3>General</h3>

	<fieldset>
		<label for="content_type">Content Type</label>
		<select name="content_type" id="content_type">
			<option></option>
			<?php 
			for ($i = 0; $i < count($aryTypes); $i++) {
				$strOption = "<option value=\""; 
				$strOption .= $aryTypes[$i]; 
				$strOption .= "\"";
				if ($aryTypes[$i] == $strType) { 
					$strOption .= " selected";
				} 
				$strOption .= ">"; 
				$strOption .= $aryTypes[$i]; 
				$strOption .= "</option>"; 
				echo $strOption; 
			} 
			?>
		</select>
		<input type="hidden" name="old-content_type" value="<?php echo($strType)?>">
	</fieldset>

	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" value="<?php echo($strName)?>">
		<input type="hidden" name="old-name" value="<?php echo($strName)?>">
	</fieldset>
	
	<fieldset>
		<label for="active">Active</label>
		<select name="active" id="active">
			<option value="1"<?php if ($blnActive == 1) echo " selected"; ?>>Yes</option>
			<option value="0"<?php if ($blnActive == 0) echo " selected"; ?>>No</option>
		</select>
		<input type="hidden" name="old-active" value="<?php echo($blnActive)?>">
	</fieldset>

	<h3>Fields</h3>

	<?php for ($i = 0; $i < count($aryFields); $i++) {
		$objField = $aryFields[$i];
		$strName = $objField->getName();
		$strField = "fld_" . preg_replace("[^A-Za-z0-9]", "_", $strName);
		$strType = $objField->getDataType();
		$strDescription = $objField->getDescription();
		$strValue = $objPage->getField($strName)->getValue();
		$objType = $objField->getDataTypeObject($objField->getOptions());
	?>
		<fieldset<?php if (array_key_exists($strName, $aryInvalid)) { echo " class='invalid'"; }?>>
			<label for="<?php echo $strField?>" title="<?php echo $strDescription?>"><?php echo $strName?></label>
			<?php echo($objType->edit("value_$i", $strField, $strValue)) ?>
			<input type="hidden" name="field_<?php echo $i?>" value="<?php echo $strName?>">
		</fieldset>
	<?php } ?>
	<input type="hidden" name="numFields" value="<?php echo count($aryFields);?>">
	
	<input type="hidden" name="node" value="<?php echo $strNode; ?>">
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" value="Save Node">

</form>