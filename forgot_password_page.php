<?php include("config/setup.php");
session_start();
if (isset($_SESSION['userName']) && $_SESSION['userName'] != '') {
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Forgot password?</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/sign_up_page.css">
		<link rel="stylesheet" href="css/user_email_varification.css">
	</head>
	<body>
		<div class="varification-container">
			<div class="varification-container-div">
				<h3>Lost your password? Please enter your email address. You will recieve a link to create a new password via email.</h3>
			</div>
			<form id="form" action="forgot_password_page.php" method="post" class="login-form-container sign-up-form-container">
				<input class="field-of-login-form field-of-signup-form" type="text" name="email" placeholder="Email" required pattern="^[A-Za-z0-9._\-]{1,32}@(?!\.)[A-Za-z0-9.\-]+\.[A-Za-z]{2,63}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid Email address.');">
				<div class="user-already-exists">&nbsp;<?php
if (isset($_POST['submit'])) {
	if ($_POST['submit'] === 'Reset password') {
		if (emailIsInDb($_POST['email'], $pdo)) {
			$tempPassword = strtoupper(bin2hex(random_bytes(6)));
			$hashedTempPassword = hash('sha256', $tempPassword);
			resetOldUserPasswordToTemp($_POST['email'], $hashedTempPassword, $pdo);
			$resetMessage = emailResetMessage($tempPassword);

			$mailHeaders = 'MIME-version: 1.0' . "\r\n";
			$mailHeaders .= 'Content-Type:text/html;charset=UTF-8' . "\r\n";
			$mailHeaders .= 'From: noreply@camagru.com' . "\r\n";
			$mailHeaders .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
			$mailHeaders .= 'Date: ' . date("r (T)") . "\r\n";
			$mailHeaders .= iconv_mime_encode("Subject", "Password reset");

			$mailReturnValue = mail($_POST['email'], "Camagru password reset", $resetMessage, $mailHeaders);
			setSessionEmail();
			header("Location: reset_password_page.php");
		} else {
			echo "* Email is not registered";
		}
	}
} ?></div>
				<input class="field-of-login-form submit-btn-for-login-form submit-btn-for-signup" type="submit" name="submit" value="Reset password">
			<div class="sign-up-forgot-container sign-up-gohome">
				<p class="sign-up">or <a class="sign-up-href" href="index.php">Go home</a></p>
			</div>
			</form>
		</div>
	</body>
</html>
<?php
function emailIsInDb($email, $pdo) {
	$statement = "SELECT `email` FROM `users` WHERE `email`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$email]);
	return ($preparedStatement->fetch());
}

function resetOldUserPasswordToTemp($email, $tempPassword, $pdo) {
	$statement = "UPDATE `users` SET `password`=? WHERE `email`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$tempPassword, $email]);
}

function emailResetMessage($tempPassword) {
	$message = "<html><head>";
	$message .= "<title>Password reset</title></head>";
	$message .= "<body><h1>Password reset</h1>";
	$message .= "<p>Hello there!</p>";
	$message .= "<p>You resetted your password, so we got you a new one, please change this temporary password to something a little bit more secure.</p>";
	$message .= "<p>Temporary password: $tempPassword</p>";
	$message .= "</body></html>";

	return $message;
}

function setSessionEmail() {
	session_start();
	$_SESSION['email'] = $_POST['email'];
}
?>
