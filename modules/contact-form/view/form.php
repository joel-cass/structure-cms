<?php 
if ( count($aryError) > 0 ) {
	echo "<ul class=\"error-wrapper\">";
	foreach ($aryError as $strError) {
		echo "<li>$strError</li>";
	}
	echo "</ul>";
}
?>

<form action="" method="POST">

	<fieldset>
		<label for="txtName">Name</label>
		<input type="text" name="name" id="txtName" value="<?php echo $strName; ?>">
	</fieldset>

	<fieldset>
		<label for="txtEmail">Email</label>
		<input type="text" name="email" id="txtEmail" value="<?php echo $strEmail; ?>">
	</fieldset>

	<fieldset>
		<label for="txtMessage">Message</label>
		<textarea name="message" id="txtMessage"><?php echo $strMessage; ?></textarea>
	</fieldset>

	<fieldset class="spam-check">
		<label for="fldSpamCheck">Please leave this field blank</label>
		<input type="text" name="spamcheck" id="fldSpamCheck" value="<?php echo $strSpamCheck; ?>">
	</fieldset>

	<fieldset>
		<label>&nbsp;</label>
		<input type="submit" id="btnSubmit" value="Send Message">
	</fieldset>

	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">

</form>