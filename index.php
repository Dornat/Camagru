<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Camagru</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
	</head>
	<body>
		<?php require_once "header.php"; ?>

		<div class="webcam-container">
			<video id="video" style="-moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); filter: FlipH; -ms-filter: \"FlipH\";" width="640" height="480" autoplay></video>
			<canvas style="-moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); filter: FlipH; -ms-filter: \"FlipH\";" id="picture-canvas" width="640" height="480"></canvas>
			<img style="-moz-transform: scaleX(-1); -o-transform: scaleX(-1); -webkit-transform: scaleX(-1); transform: scaleX(-1); filter: FlipH; -ms-filter: \"FlipH\";" id="picture-img" src="">
			<button id="take-picture-button">Shoot</button>


			<div class="carousel-container">
				<img id="firstimg" class="img-carousel" src="img/580b57fbd9996e24bc43be4e.png">
				<img class="img-carousel" src="img/580b57fbd9996e24bc43be5c.png">
				<img class="img-carousel" src="img/580b57fcd9996e24bc43c2f0.png">
				<img class="img-carousel" src="img/580b57fcd9996e24bc43c2f1.png">
				<img class="img-carousel" src="img/580b57fcd9996e24bc43c2f2.png">
				<img class="img-carousel" src="img/580b57fcd9996e24bc43c2f7.png">
				<img class="img-carousel" src="img/580b585b2edbce24c47b2618.png">
				<img class="img-carousel" src="img/5845ccd80b2a3b54fdbaecf5.png">
				<img class="img-carousel" src="img/5845cd430b2a3b54fdbaecf8.png">
				<img class="img-carousel" src="img/5845e13e7733c3558233c0ec.png">
				<img class="img-carousel" src="img/5845e14e7733c3558233c0ed.png">
				<img class="img-carousel" src="img/5845e1677733c3558233c0ee.png">
				<img class="img-carousel" src="img/5845e635fb0b0755fa99d7e9.png">
				<img class="img-carousel" src="img/5845e643fb0b0755fa99d7ea.png">
				<img class="img-carousel" src="img/5845e665fb0b0755fa99d7ec.png">
				<img class="img-carousel" src="img/5845e6b1fb0b0755fa99d7f0.png">
				<img class="img-carousel" src="img/5845e755fb0b0755fa99d7f3.png">
				<img class="img-carousel" src="img/5845e770fb0b0755fa99d7f4.png">
				<img class="img-carousel" src="img/5845ec53dda95a5696fa1a26.png">
				<img class="img-carousel" src="img/5845ec62dda95a5696fa1a27.png">
				<img class="img-carousel" src="img/5845ec7fdda95a5696fa1a28.png">
				<img class="img-carousel" src="img/5845ec9fdda95a5696fa1a29.png">
				<img class="img-carousel" src="img/5845ed1bdda95a5696fa1a2a.png">
				<img class="img-carousel" src="img/584997587422de75c36182d4.png">
				<img class="img-carousel" src="img/5849978e7422de75c36182d8.png">
				<img class="img-carousel" src="img/584998d695008575ff974862.png">
				<img class="img-carousel" src="img/58499929f6ff2e760b7467a8.png">
				<img class="img-carousel" src="img/584999937b7d4d76317f5ffd.png">
				<img class="img-carousel" src="img/584999a27b7d4d76317f5ffe.png">
				<img class="img-carousel" src="img/58499c84e9678476f613457a.png">
				<img class="img-carousel" src="img/58499e29b89d73775876620d.png">
				<img class="img-carousel" src="img/58499f7926191c779d22d92f.png">
				<img class="img-carousel" src="img/58499f8b26191c779d22d931.png">
				<img class="img-carousel" src="img/58499f9726191c779d22d932.png">
				<img class="img-carousel" src="img/58499fc926191c779d22d933.png">
				<img class="img-carousel" src="img/5849a03726191c779d22d936.png">
				<img class="img-carousel" src="img/585059646a5ae41a83ddee9c.png">
				<img class="img-carousel" src="img/585059b56a5ae41a83ddee9d.png">
				<img class="img-carousel" src="img/5859b173711f64423aa5e050.png">
				<img class="img-carousel" src="img/5862d43c1aa68e0bf26fa200.png">
				<img class="img-carousel" src="img/586567ea7d90850fc3ce2a29.png">
				<img class="img-carousel" src="img/588a6acad06f6719692a2d28.png">
				<img class="img-carousel" src="img/588a6ad0d06f6719692a2d29.png">
				<img class="img-carousel" src="img/588a6b2ad06f6719692a2d2a.png">
				<img class="img-carousel" src="img/58909b545236a4e0f6e2f975.png">
				<img class="img-carousel" src="img/58909bfe5236a4e0f6e2f97a.png">
				<img class="img-carousel" src="img/58967e8c0803320bf17c2fb7.png">
				<img class="img-carousel" src="img/5896f72ecba9841eabab60fe.png">
				<img class="img-carousel" src="img/589b4da582250818d81e748f.png">
				<img class="img-carousel" src="img/59401c27bd0e8b4eeeb603c3.png">
				<img class="img-carousel" src="img/5984a0f14ca2e7219dcbe493.png">
				<img class="img-carousel" src="img/59cfce69d3b1936210a5ddf6.png">
				<img class="img-carousel" src="img/59cfce7ad3b1936210a5ddf7.png">
			</div>
		</div>

		<?php require_once "footer.php"; ?>
		<script src="js/camera_setup.js"> </script>
	</body>
</html>
