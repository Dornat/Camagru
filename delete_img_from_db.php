<?php
require_once 'config/setup.php';
session_start();

deleteImgFromDb($pdo);
unlink($_POST['img_src']);

function deleteImgFromDb($pdo) {
	deleteImgFromLikesTable($pdo);
	$statement = "DELETE FROM `collage_images` WHERE `img_path`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['img_src']]);
}

function deleteImgFromLikesTable($pdo) {
	$statement = "DELETE FROM `likes` WHERE `img_id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([getImageId($pdo)]);
}

function getImageId($pdo) {
	$statement = "SELECT `id` FROM `collage_images` WHERE `img_path`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['img_src']]);
	$imageId = $preparedStatement->fetchAll();
	return $imageId[0][0];
}

?>
