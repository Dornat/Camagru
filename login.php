<?php
include("config/setup.php");
session_start();

if (postSubmitIsSetToLogin()) {
	if (loginIsValid($pdo)) {
		$_SESSION['userExistence'] = 'exists';
		if (loginPasswordMatches($pdo) && userIsVerified($pdo)) {
			setSessionUserNameToLogin();
			$_SESSION['isVerified'] = 'verified';
			$_SESSION['wrongPassword'] = 'good';
		} else if (userIsVerified($pdo) === false) {
			$_SESSION['isVerified'] = 'notVerified';
		} else {
			$_SESSION['wrongPassword'] = 'wrong';
		}
	} else {
		$_SESSION['userExistence'] = 'doesNotExists';
	}
}

header("Location: index.php");

function postSubmitIsSetToLogin() {
	if (isset($_POST['submit'])) {
		if (empty($_POST['submit'])) {
			return false;
		} else if ($_POST['submit'] === 'Login'){
			return true;
		}
	}
	return false;
}

function loginIsValid($pdo) {
	$statement = "SELECT `login` FROM `users` WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['login']]);
	$userName = $preparedStatement->fetchAll();
	if (empty($userName[0][0])) {
		return false;
	}
	return true;
}

function loginPasswordMatches($pdo) {
	$password = hash('sha256', $_POST['passwd']);
	$statement = "SELECT `login` FROM `users` WHERE `password`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$password]);
	$match = $preparedStatement->fetchAll();
	if (empty($match[0][0])) {
		return false;
	}
	return true;
}

function userIsVerified($pdo) {
	$statement = "SELECT `is_verified` FROM `users` WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['login']]);
	$match = $preparedStatement->fetchAll();
	if ($match[0][0] === "false") {
		return false;
	}
	return true;
}

function setSessionUserNameToLogin() {
	$_SESSION['userName'] = strtolower($_POST['login']);
}
?>
