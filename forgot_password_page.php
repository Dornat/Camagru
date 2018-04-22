<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Forgot password?</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/sign_up_page.css">
	</head>
	<body>
		<div class="varification-container">
			<form id="form" action="sign_up_page.php" method="post" class="login-form-container sign-up-form-container">
				<input class="field-of-login-form field-of-signup-form" type="text" name="email" placeholder="Email" required pattern="^[A-Za-z0-9._\-]{1,32}@(?!\.)[A-Za-z0-9.\-]+\.[A-Za-z]{2,63}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid Email address.');">
				<input class="field-of-login-form submit-btn-for-login-form submit-btn-for-signup" type="submit" name="submit" value="Reset password">
			<div class="sign-up-forgot-container sign-up-gohome">
				<p class="sign-up">or <a class="sign-up-href" href="index.php">Go home</a></p>
			</div>
			</form>
		</div>
	</body>
</html>
