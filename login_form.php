<form action="login.php" class="login-form-container">
	<input class="field-of-login-form" type="text" name="login" placeholder="Login" required>
	<input class="field-of-login-form" type="password" name="passwd" placeholder="Password" required pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid password.');">
	<input class="field-of-login-form submit-btn-for-login-form" type="submit" name="submit" value="Login">
	<div class="sign-up-forgot-container">
		<p class="sign-up">or <a class="sign-up-href" href="sign_up_page.php">Sign up</a></p>
		<p class="sign-up"><a class="sign-up-href" href="#">Forgot password?</a></p>
	</div>
</form>
