<?php
require_once 'config/setup.php';
session_start();

changeEmailNotification($pdo, $_POST['notify']);

function changeEmailNotification($pdo, $notify) {
	$statement = "UPDATE `users` SET `email_on_img_comment`=? WHERE `login`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$notify, $_SESSION['userName']]);
}

?>
