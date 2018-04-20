<?php
include("config/setup.php");
session_start();

if (isset($_POST['logout'])) {
	if ($_POST['logout'] === 'logout') {
		$_SESSION['userName'] = "";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
	</head>
	<body>
		<header>
			<div class="navbar-container">
				<div>
					<h1>Camagru!</h1>
				</div>
			</div>
			<?php if (userNameIsSet()) { ?>
			<div class="user-button-container">
				<button class="user-button"><?php echo $_SESSION['userName']; ?></button>
				<a href="logout.php"><button class="user-button">Logout</button></a>
			</div>
			<?php } else { include "login_form.php"; } ?>
		</header>
	</body>
</html>
<?php
function userNameIsSet() {
	if (isset($_SESSION['userName'])) {
		if (empty($_SESSION['userName'])) {
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}
?>
