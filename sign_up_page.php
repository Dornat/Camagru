<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sign up to Camagru</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/sign_up_page.css">
	</head>
	<body>
		<form action="login.php" class="login-form-container sign-up-form-container">
			<input class="field-of-login-form field-of-signup-form" type="text" name="login" placeholder="Login" required pattern="^[a-zA-z_0-9]{1,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid login.');">
			<input class="field-of-login-form field-of-signup-form" type="text" name="email" placeholder="Email" required pattern="^[A-Za-z0-9._\-]{1,32}@(?!\.)[A-Za-z0-9.\-]+\.[A-Za-z]{2,63}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid Email address.');">
			<input class="field-of-login-form field-of-signup-form" type="password" name="passwd" placeholder="Password" required pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Your password must have not less than 6 letters, must contain at least one normal letter, one CAPITAL letter and one digit.');">
			<input class="field-of-login-form submit-btn-for-login-form submit-btn-for-signup" type="submit" name="submit" value="Create account">
			<div class="sign-up-forgot-container sign-up-gohome">
				<p class="sign-up">or <a class="sign-up-href" href="index.php">Go home</a></p>
			</div>
		</form>
	</body>
</html>
