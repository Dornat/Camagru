<?php
require_once 'config/setup.php';
session_start();

$latestUserImgSrc = getLatestUserImageSrc($pdo);

echo $latestUserImgSrc;

function getLatestUserImageSrc($pdo) {
	$statement = "SELECT `img_path` FROM `collage_images` WHERE `user_id`=?
		ORDER BY `id` DESC LIMIT 1";
	//$statement = "SELECT `img_path` FROM `collage_images` WHERE `user_id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$userId = getUserIdFromDB($pdo);
	$preparedStatement->execute([$userId]);
	$latestImg = $preparedStatement->fetchAll();
	return $latestImg[0][0];
	//return $latestImg;
}

function getUserIdFromDB($pdo) {
	$statement = "SELECT `id` FROM `users` WHERE `login`=?;";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_SESSION['userName']]);
	$id = $preparedStatement->fetchAll();
	return $id[0][0];
}

?>
