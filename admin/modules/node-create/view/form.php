<form action="" method="POST" id="frmNew" class="edit">

	<h2>Create page below: <?php echo $strName?></h2>

	<ul id="actions-nav">
		<li>
			<a href="node-edit.php?node=<?php echo $strNode?>">
				<img src="images/go-previous.png" alt="Go back" width="16" height="16" border="0" align="left">
				Go back
			</a>
		</li>
		<li>
			<a href="#" onclick="javascript:$('#frmNew').submit();return false;">
				<img src="images/page-save.png" alt="Create Page" width="16" height="16" border="0" align="left">
				Create Page
			</a>
		</li>
	</ul>
	<div class="clear-hidden"></div>

	<h3><a id="lblSettings" href="#" onclick="javascript:switchDisplay('grpSettings',this);return false;">Settings</a></h3>
	
	<div id="grpSettings">

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
			</div>
		</fieldset>
	
		<fieldset>
			<label for="name">Name</label>
			<div class="field-container">
				<input type="text" name="name" id="name" class="text">
			</div>
		</fieldset>
	
	</div>
	
	<input type="hidden" name="parent" value="<?php echo $strParent?>">
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" name="button" value="Create Page" id="btnSave">

</form>

<script type="text/javascript">
initDisplay('grpSettings','lblSettings');
$("#btnSave").hide();
</script>