<?php
require_once 'config/setup.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Camagru | Comment</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/global_gallery.css">
		<link rel="stylesheet" href="css/comment_page.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<?php require_once "header.php";
if (isset($_SESSION['userName'])) {
	$userIdFromDb = $pdoInit->getUserIdFromDbByLogin($pdo, $_SESSION['userName']);
} else {
	$userIdFromDb = 0;
}
if ($pdoInit->isUserLikedImage($pdo, $_GET['image_id'], $userIdFromDb) === true) {
	$liked = 'liked';
} else {
	$liked = '';
}
$likesCount = $pdoInit->countLikesForImage($pdo, $_GET['image_id']);
?>

		<div class="global-comment-container">
			<div class="global-gallery-img-container comment-global-gallery-img-container">
				<img src="<?php echo $pdoInit->getImagePathByImageId($pdo, $_GET['image_id']); ?>" class="comment-gallery-img" id="user_collages/img131.png">
				<div class="like-and-comment-container">
					<i id="<?php echo $_GET['image_id']; ?>" class="fas fa-thumbs-up like <?php echo $liked; ?>">
						<span class="like-count"><?php echo $likesCount; ?></span>
					</i>
				</div>
			</div>
			<div class="actual-comments-container">
<?php		if (isset($_SESSION['userName'])): ?>
				<div class="add-comment-box">
					<textarea rows="3" name="comment-textarea" id="comment-textarea" placeholder="Type your comment here..."></textarea>
					<button id="<?php echo $pdoInit->getUserIdFromDbByLogin($pdo, $_SESSION['userName']); ?>" class="take-picture-button delete-comment-button" onClick="addComment()">Add comment</button>
				</div>
<?php		endif; ?>
<?php
$commentsArray = $pdoInit->getCommentsForImage($pdo, $_GET['image_id']);

foreach ($commentsArray as $comment): ?>
				<div class="comment-box">
					<div class="author-date-container">
						<p class="comment-author">
<?php
	echo $pdoInit->getLoginById($pdo, $comment['user_id']);
?>
						</p>
						<p class="comment-date">
<?php
echo $comment['datetime'];
?>
						</p>
					</div>
					<div class="actual-comment">
						<p>
<?php
echo $comment['comment'];
?>
						</p>
					</div>
<?php
if (isset($_SESSION['userName'])):
	if ($pdoInit->getLoginById($pdo, $comment['user_id']) === $_SESSION['userName']):
?>
					<button class="take-picture-button delete-comment-button">Delete</button>
<?php
	endif;
endif;
?>
				</div>
<?php
endforeach;
?>
			</div>
		</div>

		<?php require_once "footer.php"; ?>
		<script src="js/comment_page.js"></script>
	</body>
</html>
