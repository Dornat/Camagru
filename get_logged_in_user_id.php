<?php
require_once 'config/setup.php';
session_start();

echo getUserIdFromDb($pdo);

function getUserIdFromDb($pdo) {
	$statement = "SELECT `id` FROM `users` WHERE `login`=?;";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_SESSION['userName']]);
	$id = $preparedStatement->fetchAll();
	return $id[0][0];
}

?>
