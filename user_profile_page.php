<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Camagru | User profile</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/profile_container.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	</head>
	<body>
<?php
require_once "header.php";
returnHomeIfUserNameNotSet();

function returnHomeIfUserNameNotSet() {
	if (isset($_SESSION['userName'])) {
		if ($_SESSION['userName'] == false) {
			header("Location: index.php");
		}
	}
}

if (isset($_POST['login'])) {
	if (empty($_POST['passwd']) === false) {
		if (passwordChanged($pdo)) {
			setNewPasswordToDb($pdo);
			$mailReturnValue =
				mail(
					userEmailFromDb($pdo),
					"New password",
					emailNewPasswordMessage($_POST['passwd']),
					emailHeaders()
				);
		}
	}
	if (emailChanged($pdo)) {
		setNewEmailToDb($pdo);
	}
	if (loginChanged()) {
		setNewLoginToDb($pdo);
		$_SESSION['userName'] = $_POST['login'];
	}
}
?>
		<div class="profile-container">
			<div class="profile-inner-container">
				<h2>Edit Profile</h2>
				<p class="careful-message">Be careful, everything you type into fields then press 'Save changes' will be applied to your account.</p>
				<form id="form" action="user_profile_page.php" method="post" class="login-form-container profile-form-container">
					<input value="<?php echo $_SESSION['userName']; ?>" class="field-of-login-form field-of-signup-form" type="text" name="login" placeholder="Login" required pattern="^[a-zA-Z_0-9]{1,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid login.');">
					<input value="<?php echo userEmailFromDb($pdo); ?>" class="field-of-login-form field-of-signup-form" type="text" name="email" placeholder="Email" required pattern="^[A-Za-z0-9._\-]{1,32}@(?!\.)[A-Za-z0-9.\-]+\.[A-Za-z]{2,63}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Invalid Email address.');">
					<input class="field-of-login-form field-of-signup-form" type="password" name="passwd" placeholder="Password" pattern="^(?=.*[A-Z])(?=.*[0-9]).{6,32}$" oninput="setCustomValidity(''); checkValidity(); setCustomValidity(validity.valid ? '' : 'Your password must have not less than 6 letters, must contain at least one normal letter, one CAPITAL letter and one digit.');">
					<input class="field-of-login-form submit-btn-for-login-form submit-btn-for-signup" type="submit" name="submit" value="Save changes">
				</form>
			</div>
		</div>
		<?php require_once "footer.php"; ?>
	</body>
</html>
<?php
function passwordChanged($pdo) {
	$passwordFromPost = hash('sha256', $_POST['passwd']);
	if ($passwordFromPost !== userPasswordFromDb($pdo)) {
		return true;
	}
	return false;
}

function userPasswordFromDb($pdo) {
	$statement = "SELECT `password` FROM `users` WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_SESSION['userName']]);
	$password = $preparedStatement->fetchAll();

	return $password[0][0];
}

function setNewPasswordToDb($pdo) {
	$statement = "UPDATE `users` SET `password`=? WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([hash('sha256', $_POST['passwd']), $_SESSION['userName']]);
}

function loginChanged() {
	if (strtolower($_POST['login']) !== strtolower($_SESSION['userName'])) {
		return true;
	}
	return false;
}

function emailChanged($pdo) {
	if (strtolower($_POST['email']) !== strtolower(userEmailFromDb($pdo))) {
		return true;
	}
	return false;
}

function userEmailFromDb($pdo) {
	$statement = "SELECT `email` FROM `users` WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([strtolower($_SESSION['userName'])]);
	$userName = $preparedStatement->fetchAll();

	return $userName[0][0];
}

function setNewEmailToDb($pdo) {
	$statement = "UPDATE `users` SET `email`=? WHERE `email`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([strtolower($_POST['email']), userEmailFromDb($pdo)]);
}

function setNewLoginToDb($pdo) {
	$statement = "UPDATE `users` SET `login`=? WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([strtolower($_POST['login']), $_SESSION['userName']]);
}

function emailNewPasswordMessage($password) {
	$message = "<html><head>";
	$message .= "<title>Password was changed</title></head>";
	$message .= "<body><h1>You changed your password</h1>";
	$message .= "<p>Your password is: $password (don't lose it)</p>";

	return $message;
}

function emailHeaders() {
	$mailHeaders = 'MIME-version: 1.0' . "\r\n";
	$mailHeaders .= 'Content-Type:text/html;charset=UTF-8' . "\r\n";
	$mailHeaders .= 'From: noreply@camagru.com' . "\r\n";
	$mailHeaders .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
	$mailHeaders .= 'Date: ' . date("r (T)") . "\r\n";
	$mailHeaders .= iconv_mime_encode("Subject", "New password");

	return $mailHeaders;
}
?>
