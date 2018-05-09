<?php
require_once 'config/setup.php';
session_start();

$globalGallery = getGlobalGallery($pdo, getNumberOfPages($pdo));
$globalGalleryArr = array();

if(!empty($globalGallery[0][0])) {
	foreach ($globalGallery as $img) {
		$img['like_count'] = getLikesCountOnImgId($pdo, $img['id']);
		$img['liked_user_ids'] = getUserIdsWhoLikedImg($pdo, $img['id']);
		$globalGalleryArr[] = $img;
	}
	if (isset($_SESSION['userName'])) {
		$globalGalleryArr[] = array(
			'user_id' => $pdoInit->getUserIdFromDbByLogin($pdo, $_SESSION['userName'])
		);
	} else {
		$globalGalleryArr[] = array('user_id' => null);
	}
	$globalGalleryArr[] = array('number_of_pages' => getNumberOfPages($pdo));
}

//echo $_GET['page'];
echo json_encode($globalGalleryArr);

function getGlobalGallery($pdo, $numberOfPages) {
	$statement = "SELECT `id`,`img_path` FROM `collage_images` ORDER BY `id` DESC
		LIMIT " . (($_GET['page'] - 1) * 12) . ", 12";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([(($numberOfPages - 1) * 12)]);
	$globalGallery = $preparedStatement->fetchAll();
	return $globalGallery;
}

function getNumberOfPages($pdo) {
	$statement = "SELECT COUNT(`id`) FROM `collage_images`";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute();
	$numberOfPages = $preparedStatement->fetchAll();
	return ceil($numberOfPages[0][0] / 12);
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

?>
