<?php include("config/setup.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sign up to Camagru</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/sign_up_page.css">
	</head>
	<body>
		<form id="form" action="sign_up_page.php" method="post" class="login-form-container sign-up-form-container">
			<input class="field-of-login-form field-of-signup-form" type="text" name="login" placeholder="Login" required pattern="^[a-zA-Z_0-9]{1,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid login.');">
			<input id="input2" class="field-of-login-form field-of-signup-form" type="text" name="email" placeholder="Email" required pattern="^[A-Za-z0-9._\-]{1,32}@(?!\.)[A-Za-z0-9.\-]+\.[A-Za-z]{2,63}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid Email address.');">
			<input class="field-of-login-form field-of-signup-form" type="password" name="passwd" placeholder="Password" required pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Your password must have not less than 6 letters, must contain at least one normal letter, one CAPITAL letter and one digit.');">
			<div id="caps" class="caps-lock-is-on">* CAPS LOCK IS ON</div>
<div class="user-already-exists">&nbsp;<?php
if (isset($_POST['submit'])):
	if ($_POST['submit'] === 'Create account'):
		if (isUserAlreadyExistsInDb($_POST['login'], $pdo)):
			echo "* Username already exists";
		elseif (isEmailAlreadyTaken($_POST['email'], $pdo)):
			echo "* Email is already in use";
		else:
			$statement = "INSERT INTO `users` (`login`, `email`, `password`, `verif_code`) VALUES (?, ?, ?, ?)";
			$preparedStatement = $pdo->prepare($statement);
			$hashedPassword = hash('sha256', $_POST['passwd']);
			$verificationCode = bin2hex(random_bytes(8));
			$preparedStatement->execute([strtolower($_POST['login']), strtolower($_POST['email']), $hashedPassword, $verificationCode]);

			session_start();
			$_SESSION['email'] = strtolower($_POST['email']);

			$mailMessage = emailMessage(strtolower($_POST['login']), $_POST['passwd'], $verificationCode);

			$mailHeaders = 'MIME-version: 1.0' . "\r\n";
			$mailHeaders .= 'Content-Type:text/html;charset=UTF-8' . "\r\n";
			$mailHeaders .= 'From: noreply@camagru.com' . "\r\n";
			$mailHeaders .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
			$mailHeaders .= 'Date: ' . date("r (T)") . "\r\n";
			$mailHeaders .= iconv_mime_encode("Subject", "Registration to Camagru");

			$mailReturnValue = mail($_POST['email'], "Registration to Camagru", $mailMessage, $mailHeaders);
			header("Location: thanks_for_registration_page.php");
		endif;
	endif;
endif;
?></div>
			<input class="field-of-login-form submit-btn-for-login-form submit-btn-for-signup" type="submit" name="submit" value="Create account">
			<div class="sign-up-forgot-container sign-up-gohome">
				<p class="sign-up">or <a class="sign-up-href" href="index.php">Go home</a></p>
			</div>
		</form>
	</body>
	<script>
		document.addEventListener('keydown', function(event) {
			var caps = event.getModifierState && event.getModifierState( 'CapsLock' );
			if (caps == true) {
				var div = document.getElementById("caps");
				div.style.visibility = 'visible';
			} else {
				var div = document.getElementById("caps");
				div.style.visibility = 'hidden';
			}
		});
	</script>
</html>
<?php

function isUserAlreadyExistsInDb($userName, $pdo) {
	$statement = "SELECT `login` FROM `users` WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$userName]);
	return ($preparedStatement->fetch());
}

function isEmailAlreadyTaken($email, $pdo) {
	$statement = "SELECT `email` FROM `users` WHERE `email`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$email]);
	return ($preparedStatement->fetch());
}

function emailMessage($login, $password, $verificationCode) {
	$message = "<html><head>";
	$message .= "<title>Thanks for registration!</title></head>";
	$message .= "<body><h1>Thank you for registration to Camagru!</h1>";
	$message .= "<p>Your login is: $login</p>";
	$message .= "<p>Your password is: $password (don't lose it)</p>";
	$message .= "<p>To finish your registration follow the link below:</p>";
	$message .= "<a href=\"http://127.0.0.1:8100/user_email_varification.php?verif_code=$verificationCode\">Click on me please</a></body></html>";

	return $message;
}
?>
