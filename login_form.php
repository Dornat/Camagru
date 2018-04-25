<form action="login.php" class="login-form-outer-container" method="post">
	<div class="login-form-container">
		<input class="field-of-login-form" type="text" name="login" placeholder="Login" required>
		<input class="field-of-login-form" type="password" name="passwd" placeholder="Password" required pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid password.');">
		<input class="field-of-login-form submit-btn-for-login-form" type="submit" name="submit" value="Login">
		<div class="sign-up-forgot-container">
			<p class="sign-up">or <a class="sign-up-href" href="sign_up_page.php">Sign up</a></p>
			<p class="sign-up"><a class="sign-up-href" href="forgot_password_page.php">Forgot password?</a></p>
		</div>
	</div>
	<div class="invalid-input">
<?php	if (isset($_SESSION['userExistence'])):
			if ($_SESSION['userExistence'] === 'doesNotExists'): ?>
				<p>* User does not exists</p>
<?php		elseif (isset($_SESSION['isVerified'])): ?>
<?php			if ($_SESSION['isVerified'] === 'notVerified'): ?>
					<p>* Only verified users can log in</p>
<?php			endif; ?>
<?php		elseif (isset($_SESSION['wrongPassword'])): ?>
<?php			if ($_SESSION['wrongPassword'] === 'wrong'): ?>
					<p>* Wrong password</p>
<?php			endif; ?>
<?php		endif; ?>
<?php	elseif (isset($_SESSION['wrongPassword'])): ?>
<?php		if ($_SESSION['wrongPassword'] === 'wrong'): ?>
				<p>* Wrong password</p>
<?php		endif; ?>
<?php	endif; ?>
	</div>
</form>
