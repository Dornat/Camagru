<?php
require_once 'config/setup.php';

unlikeImage($pdo, $_POST['image_id'], $_POST['current_user_id']);

function unlikeImage($pdo, $imageId, $userId) {
	$statement = "DELETE FROM `likes` WHERE `img_id`=? AND `user_id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['image_id'], $_POST['current_user_id']]);
}

?>
