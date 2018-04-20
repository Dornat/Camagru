<?php
include("config/setup.php");

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

?>
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
<?php
if (isset($_POST['submit'])):
	if ($_POST['submit'] === 'Create account'):
		if (isUserAlreadyExistsInDb($_POST['login'], $pdo)): ?>
			<div class="user-already-exists">* Username already exists</div>
<?php	elseif (isEmailAlreadyTaken($_POST['email'], $pdo)): ?>
			<div class="user-already-exists">* Email is already in use</div>
<?php	else:
			$statement = "INSERT INTO `users` (`login`, `email`, `password`, `verif_code`) VALUES (?, ?, ?, ?)";
			$preparedStatement = $pdo->prepare($statement);
			$hashedPassword = hash('sha256', $_POST['passwd']);
			$verificationCode = bin2hex(random_bytes(8));
			$preparedStatement->execute([$_POST['login'], $_POST['email'], $hashedPassword, $verificationCode]);

			$mailMassage = '<html><head>';
			$mailMassage .= '<title>Thanks for registration!</title></head>';
			$mailMassage .= '<body><h1>Thank you for registration to Camagru!</h1>';
			$mailMassage .= '<p>Your login is: ' . $_POST['login'] . '</p>';
			$mailMassage .= '<p>Your password is: ' . $_POST['passwd'] . ' (don\'t lose it)</p>';
			$mailMassage .= '<p>To finish your registration follow the link below:</p>';
			$mailMassage .= '<a href="http://127.0.0.1:8100/user_email_varification.php?verif_code=' . $verificationCode . '">Click on me please</a></body></html>';

			$mailHeaders = 'MIME-version: 1.0' . "\r\n";
			$mailHeaders .= 'Content-Type:text/html;charset=UTF-8' . "\r\n";
			$mailHeaders .= 'From: noreply@camagru.com' . "\r\n";

			$mailReturnValue = mail($_POST['email'], "Registration to Camagru", $mailMassage, $mailHeaders);
		endif;
	endif;
endif;
?>
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
