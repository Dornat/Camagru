<?php
require_once 'config/setup.php';
session_start();

$pdoInit->addCommentToDb(
	$pdo,
	$_GET['image_id'],
	$pdoInit->getUserIdFromDbByLogin($pdo, $_SESSION['userName']),
	$_POST['comment-textarea']
);

$imageAuthor = $pdoInit->getUserLoginByImageId($pdo, $_GET['image_id']);

if ($imageAuthor != $_SESSION['userName'] &&
	$pdoInit->getEmailNotificationStatusByLogin($pdo, $imageAuthor) != 'false') {
	mail(getEmailByImageId($pdo, $_GET['image_id']), "Comment", emailMessage($_SESSION['userName'], $_POST['comment-textarea']), emailHeaders());
}
header('Location: comment_page.php?image_id=' . $_GET['image_id']);

function getEmailByImageId($pdo, $imageId) {
	$statement = "SELECT `email` FROM `users`
		INNER JOIN `collage_images`
		ON `users`.`id` = `collage_images`.`user_id`
		WHERE `collage_images`.`id`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$imageId]);
	$email = $preparedStatement->fetchAll();
	return $email[0][0];
}

function emailMessage($userName, $comment) {
	$message = "<html><head>";
	$message .= "<title>Somebody commented your picture!</title></head>";
	$message .= "<body><h1>Somebody left comment on your picture</h1>";
	$message .= "<p><b>$userName</b></p>";
	$message .= "<p>Comment: $comment</p>";
	$message .= "</body></html>";

	return $message;
}

function emailHeaders() {
	$emailHeaders = 'MIME-version: 1.0' . "\r\n";
	$emailHeaders .= 'Content-Type:text/html;charset=UTF-8' . "\r\n";
	$emailHeaders .= 'From: noreply@camagru.com' . "\r\n";
	$emailHeaders .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
	$emailHeaders .= 'Date: ' . date("r (T)") . "\r\n";
	$emailHeaders .= iconv_mime_encode("Subject", "Comment");

	return $emailHeaders;
}

?>
