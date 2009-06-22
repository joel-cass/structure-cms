<form action="" method="POST">

	<h2>Please Login Below</h2>

	<fieldset>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo($strUsername)?>">
	</fieldset>
	
	<fieldset>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="<?php echo($strPassword)?>">
	</fieldset>
	
	<input type="hidden" name="<?php echo $modeField; ?>" value="submit">
	
	<input type="submit" value="Login">

</form>
