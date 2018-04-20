<?php
include("config/setup.php");
session_start();

if (postSubmitIsSetToLogin()) {
	if (loginIsValid($pdo) && passwordIsValid($pdo)) {
		setSessionUserNameToLogin($pdo);
	}
}

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
	$preparedStatement->execute([$_POST['Login']]);
	$userName = $preparedStatement->fetchAll();
	if (empty($userName[0][0])) {
		return false;
	}
	return true;
}

function passwordIsValid($pdo) {
	$password = hash('sha256', $_POST['passwd']);
	$statement = "SELECT `password` FROM `users` WHERE `password`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['Login']]);
	$userName = $preparedStatement->fetchAll();

}

function setSessionUserNameToLogin($pdo) {
	$statement = "SELECT `login` FROM `users` WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['Login']]);
	$userName = $preparedStatement->fetchAll();
	$_SESSION['userName'] = $userName[0][0];
}
?>
