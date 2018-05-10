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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
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
					<p><span class="made-by">Made by:</span><i class="fas fa-user-astronaut"></i><span class="made-by-author"><?php echo $pdoInit->getUserLoginByImageId($pdo, $_GET['image_id']); ?></span></p>
					<i id="<?php echo $_GET['image_id'] . '/' . $userIdFromDb; ?>" class="fas fa-thumbs-up like <?php echo $liked; ?>" onClick="likeClick()">
						<span class="like-count"><?php echo $likesCount; ?></span>
					</i>
				</div>
			</div>
			<div class="actual-comments-container">
<?php		if (isset($_SESSION['userName'])): ?>
				<form method="post" action="add_comment_to_db.php?image_id=<?php echo $_GET['image_id']; ?>">
					<div class="add-comment-box">
						<textarea rows="3" name="comment-textarea" id="comment-textarea" placeholder="Type your comment here..." required ></textarea>
						<input type="submit" name="add_comment" value="Add comment" class="take-picture-button delete-comment-button">
					</div>
				</form>
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
					<button id="<?php echo $comment['id']; ?>" class="take-picture-button delete-comment-button" onClick="deleteComment()">Delete</button>
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
