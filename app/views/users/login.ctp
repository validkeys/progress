<div class="login-container">
	<form action="<?php echo $this->webroot ?>users/login" method="post">
		<label>Username:</label>
		<input type="text" name="data[User][username]" />
		<label>Password:</label>
		<input type="password" name="data[User][password]" />
		<input class="btn" type="submit" value="Login">
	</form>
</div>	