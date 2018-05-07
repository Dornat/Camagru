<?php
require_once 'config/setup.php';

likeImage($pdo, $_POST['image_id'], $_POST['current_user_id']);

function likeImage($pdo, $imageId, $userId) {
	$statement = "INSERT INTO `likes` (`img_id`, `user_id`) VALUES (?, ?)";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_POST['image_id'], $_POST['current_user_id']]);
}

?>
