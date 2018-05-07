<?php
require_once 'config/setup.php';
session_start();

$globalGallery = getGlobalGallery($pdo);
$globalGalleryArr = array();

if(!empty($globalGallery[0][0])) {
	foreach ($globalGallery as $img) {
		$img['like_count'] = getLikesCountOnImgId($pdo, $img['id']);
		$img['liked_user_ids'] = getUserIdsWhoLikedImg($pdo, $img['id']);
		$globalGalleryArr[] = $img;
	}
	if (isset($_SESSION['userName'])) {
		$globalGalleryArr[] = array('user_id' => getUserIdFromDb($pdo));
	} else {
		$globalGalleryArr[] = array('user_id' => null);
	}
}

echo json_encode($globalGalleryArr);

function getGlobalGallery($pdo) {
	$statement = "SELECT `id`,`img_path` FROM `collage_images` ORDER BY `id` DESC";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute();
	$globalGallery = $preparedStatement->fetchAll();
	return $globalGallery;
}

function getLikesCountOnImgId($pdo, $imgId) {
	$statement = "SELECT COUNT(`img_id`) FROM `likes` WHERE `img_id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$imgId]);
	$likesCount = $preparedStatement->fetchAll();
	return $likesCount[0][0];
}

function getUserIdsWhoLikedImg($pdo, $imgId) {
	$statement = "SELECT `user_id` FROM `likes` WHERE `img_id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$imgId]);
	$userIds = $preparedStatement->fetchAll();
	return $userIds;
}

function getUserIdFromDb($pdo) {
	$statement = "SELECT `id` FROM `users` WHERE `login`=?;";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_SESSION['userName']]);
	$id = $preparedStatement->fetchAll();
	return $id[0][0];
}
?>
