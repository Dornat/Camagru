<?php
include("config/setup.php");
session_start();

if (isset($_POST['logout'])) {
	if ($_POST['logout'] === 'logout') {
		$_SESSION['userName'] = "";
	}
}
?>
<header>
	<div class="navbar-container">
		<div>
			<a href="index.php" class="logo"><h1>Camagru!</h1></a>
		</div>
	</div>
	<?php if (userNameIsSet()) { ?>
	<div class="user-button-container">
		<a href="user_profile_page.php"><button class="user-button"><i class="fas fa-user"></i> <?php echo $_SESSION['userName']; ?></button></a>
		<a href="logout.php"><button class="user-button">Logout</button></a>
	</div>
	<?php } else { include "login_form.php"; } ?>
</header>
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
