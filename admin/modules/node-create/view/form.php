<form action="" method="POST">

	<h2>Create page below: <?php echo $strName?></h2>

	<ul id="actions-nav">
		<li><a href="node-edit.php?node=<?php echo $strNode?>">Go back</a></li>
	</ul>
	<div class="clear-hidden"></div>

	<h3>Settings</h3>

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
	</fieldset>

	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name">
	</fieldset>
	
	<input type="hidden" name="parent" value="<?php echo $strParent?>">
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" name="button" value="Create Node">

</form>