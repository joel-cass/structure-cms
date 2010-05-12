<?php if (isset($blnRefresh) && $blnRefresh == true) { ?>
	<script type="text/javascript">
	window.open("services/node-tree.php", "side");
	</script>
<?php } ?>

<form action="" method="POST" enctype="multipart/form-data" id="frmNodeEdit" class="edit">

	<h2>Editing: <?php echo $strNode?></h2>

	<ul id="actions-nav">
		<li>
			<a href="#" onclick="javascript:$('#frmNodeEdit').submit();return false;">
				<img src="images/page-save.png" alt="Save Page" width="16" height="16" border="0" align="left">
				Save page
			</a>
		</li>
		<li>
			<a href="node-layout.php?node=<?php echo $strNode?>">
				<img src="images/page-layout.png" alt="Edit page layout" width="16" height="16" border="0" align="left">
				Edit page layout
			</a>
		</li>
		<li>
			<a href="node-create.php?node=<?php echo $strNode?>">
				<img src="images/page-new.png" alt="Create new page" width="16" height="16" border="0" align="left">
				Create new page
			</a>
		</li>
		<li>
			<a href="node-delete.php?node=<?php echo $strNode?>">
				<img src="images/page-delete.png" alt="Delete page" width="16" height="16" border="0" align="left">
				Delete page
			</a>
		</li>
		<li>
			<a href="<?php echo $objPage->getURL()?>" target="preview">
				<img src="images/page-preview.png" alt="View page" width="16" height="16" border="0" align="left">
				View page
			</a>
		</li>
	</ul>
	<div class="clear"></div>
	
	<h3><a id="lblGeneral" href="#" onclick="javascript:switchDisplay('grpGeneral',this);return false;">General Settings</a></h3>

	<div id="grpGeneral">

		<fieldset>
			<label for="content_type">Content Type</label>
			<div class="field-container">
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
			</div>
			<div class="clear-hidden"></div>
		</fieldset>
	
		<fieldset>
			<label for="name">Name</label>
			<div class="field-container">
				<input type="text" class="text" name="name" id="name" value="<?php echo($strName)?>">
				<input type="hidden" name="old-name" value="<?php echo($strName)?>">
			</div>
			<div class="clear-hidden"></div>
		</fieldset>
		
		<fieldset>
			<label for="active">Active</label>
			<div class="field-container">
				<select name="active" id="active">
					<option value="1"<?php if ($blnActive == 1) echo " selected"; ?>>Yes</option>
					<option value="0"<?php if ($blnActive == 0) echo " selected"; ?>>No</option>
				</select>
				<input type="hidden" name="old-active" value="<?php echo($blnActive)?>">
			</div>
			<div class="clear-hidden"></div>
		</fieldset>
	
	</div>

	<h3><a id="lblFields" href="#" onclick="javascript:switchDisplay('grpFields',this);return false;">Fields</a></h3>
	
	<div id="grpFields">

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
			<div class="field-container">
				<?php echo($objType->edit("value_$i", $strField, $strValue)) ?>
				<input type="hidden" name="field_<?php echo $i?>" value="<?php echo $strName?>">
			</div>
			<div class="clear-hidden"></div>
		</fieldset>
	<?php } ?>
	
	</div>

	<input type="hidden" name="numFields" value="<?php echo count($aryFields);?>">
	
	<input type="hidden" name="node" value="<?php echo $strNode; ?>">
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" value="Save Node" id="btnSave">

</form>

<script type="text/javascript">
initDisplay('grpGeneral','lblGeneral');
initDisplay('grpFields','lblFields');
$("#btnSave").hide();
</script>


