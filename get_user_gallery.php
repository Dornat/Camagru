<?php
require_once 'config/setup.php';
session_start();

$rawUserGallery = getRawUserGallery($pdo);
$userGalleryArr = array();

if(!empty($rawUserGallery[0][0])) {
	foreach ($rawUserGallery as $img) {
		$userGalleryArr[] = $img[0];
	}
}

echo json_encode($userGalleryArr);

function getRawUserGallery($pdo) {
	$statement = "SELECT `img_path` FROM `collage_images` WHERE `user_id`=?
		ORDER BY `id` DESC";
	$preparedStatement = $pdo->prepare($statement);
	$userId = getUserIdFromDb($pdo);
	$preparedStatement->execute([$userId]);
	$userGallery = $preparedStatement->fetchAll();
	return $userGallery;
}

function getUserIdFromDb($pdo) {
	$statement = "SELECT `id` FROM `users` WHERE `login`=?;";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_SESSION['userName']]);
	$id = $preparedStatement->fetchAll();
	return $id[0][0];
}

?>
