<?php

require_once('config/setup.php');
session_start();

$rawImgSrc = preg_replace(
	'/^data:image\/\w+;base64,/i', '', $_POST['img_src']
);
$rawImgSrc = str_replace(' ', '+', $rawImgSrc);
$decodedImg = base64_decode($rawImgSrc);

file_put_contents('user_collages/img' . getImgNumber($pdo) . '.png', $decodedImg);
addImgToDb($pdo);

function addImgToDb($pdo) {
	$imgNumber = getImgNumber($pdo);
	$userId = getUserId($pdo);
	$statement = "INSERT INTO `collage_images` (`user_id`, `img_path`)
		VALUES (?, ?)";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([
		$userId, 'user_collages/img' . $imgNumber . '.png'
	]);
}

function getImgNumber($pdo) {
	$imgNumber = getMaxIdFromUserCollages($pdo);
	if (empty($imgNumber)) {
		$imgNumber = 1;
	} else {
		$imgNumber += 1;
	}
	return $imgNumber;
}

function getMaxIdFromUserCollages($pdo) {
	$statement = "SELECT MAX(`id`) AS `id` FROM `collage_images`";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute();
	$num = $preparedStatement->fetchAll();
	return $num[0][0];
}

function getUserId($pdo) {
	$statement = "SELECT `id` FROM `users` WHERE `login`=?;";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_SESSION['userName']]);
	$id = $preparedStatement->fetchAll();
	return $id[0][0];
}
?>
