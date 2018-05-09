<?php
require_once 'config/setup.php';
session_start();

deleteCommentFromDb($pdo, $_POST['comment_id']);

function deleteCommentFromDb($pdo, $commentId) {
	$statement = "DELETE FROM `comments` WHERE `id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$commentId]);
}
?>
