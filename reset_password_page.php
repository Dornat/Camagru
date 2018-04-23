<?php session_start(); ?>
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
				<h1 style="color: #3e5154;">The email with instructions was sent to <?php echo $_SESSION['email']; ?></h1>
			</div>
			<a href="index.php"><h4>Go Home</h4></a>
		</div>
	</body>
</html>
<?php header("Refresh: 10; URL=index.php"); ?>
