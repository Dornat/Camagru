<?php
require_once 'config/setup.php';
session_start();

$pdoInit->addCommentToDb(
	$pdo,
	$_GET['image_id'],
	$pdoInit->getUserIdFromDbByLogin($pdo, $_SESSION['userName']),
	$_POST['comment-textarea']
);

header('Location: comment_page.php?image_id=' . $_GET['image_id']);

?>
