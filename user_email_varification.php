<?php include("config/setup.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User varification</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/user_email_varification.css">
	</head>
	<body>
		<div class="varification-container">
			<div>
<?php			if (isAccountAlreadyVerified($pdo)): ?>
					<h1 style="color: #3e5154;">Account is already verified (ᵔᴥᵔ)</h1>
<?php			elseif (isVerifCodeInDb($pdo)):
					tellDbThatAccountIsVerified($pdo); ?>
					<h1 style="color: #3e5154;">Account is verified \ (•◡•) /</h1>
		<?php	else: ?>
					<h1 style="color: #3e5154;">Something went wrong and you couldn't verify your account... ಠ╭╮ಠ</h1>
			<?php endif; ?>
			</div>
			<a href="index.php"><h4>Go Home</h4></a>
		</div>
	</body>
</html>

<?php

function isAccountAlreadyVerified($pdo) {
	$statement = "SELECT `is_verified` FROM `users` WHERE `is_verified`='true' && `verif_code`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_GET['verif_code']]);
	$result = $preparedStatement->fetchAll();
	if ($result) {
		return true;
	} else {
		return false;
	}
}

function isVerifCodeInDb($pdo) {
	$statement = "SELECT `verif_code` FROM `users` WHERE `verif_code`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_GET['verif_code']]);
	$result = $preparedStatement->fetchAll();
	if ($result) {
		return true;
	} else {
		return false;
	}
}

function tellDbThatAccountIsVerified($pdo) {
	$statement = "UPDATE `users` SET `is_verified`='true' WHERE `verif_code`=?";
	$preparedStatement = $pdo->prepare($statement);
	$preparedStatement->execute([$_GET['verif_code']]);
}
?>
