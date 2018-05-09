<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/global_gallery.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<?php require_once "header.php"; ?>
		<div class="global-gallery-container">
			<div id="global-gallery-wrapper">
				<!-- This container will be filled from database -->
			</div>
			<!-- <div class="pagination">
				<a href="#">&laquo;</a>
				<a href="index.php">1</a>
				<a href="#">...</a>
				<a class="active" href="index.php?page=2">16</a>
				<a href="index.php?page=3">17</a>
				<a href="index.php?page=3">18</a>
				<a href="index.php?page=3">19</a>
				<a href="index.php?page=6">20</a>
				<a href="#">&raquo;</a>
			</div> -->
		</div>
		<div id="pagination-container">

		</div>

		<?php require_once "footer.php"; ?>
		<script src="js/print_global_gallery.js"></script>
	</body>
</html>
