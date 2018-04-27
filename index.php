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
			<div id="webcam-wrapper">
				<video id="video" width="640" height="480" autoplay></video>
				<canvas id="picture-canvas" width="640" height="480"></canvas>
			</div>
			<img id="picture-img" src="">
			<button id="take-picture-button">Shoot</button>

			<div class="carousel-container">
				<div class="img-wrapper">
					<img id="obama" class="img-carousel" src="img/580b57fbd9996e24bc43be4e.png">
				</div>
				<div class="img-wrapper">
					<img id="trump" class="img-carousel" src="img/580b57fbd9996e24bc43be5c.png">
				</div>
				<div class="img-wrapper">
					<img id="steave-head" class="img-carousel" src="img/580b57fcd9996e24bc43c2f0.png">
				</div>
				<div class="img-wrapper">
					<img id="grass-block" class="img-carousel" src="img/580b57fcd9996e24bc43c2f1.png">
				</div>
				<div class="img-wrapper">
					<img id="creeper-head" class="img-carousel" src="img/580b57fcd9996e24bc43c2f2.png">
				</div>
				<div class="img-wrapper">
					<img id="creeper" class="img-carousel" src="img/580b57fcd9996e24bc43c2f7.png">
				</div>
				<div class="img-wrapper">
					<img id="weed-bush" class="img-carousel" src="img/580b585b2edbce24c47b2618.png">
				</div>
				<div class="img-wrapper">
					<img id="pepe-inhales-memes" class="img-carousel" src="img/5845ccd80b2a3b54fdbaecf5.png">
				</div>
				<div class="img-wrapper">
					<img id="pepe-happy" class="img-carousel" src="img/5845cd430b2a3b54fdbaecf8.png">
				</div>
				<div class="img-wrapper">
					<img id="grumpy-cat-loogink-to-right" class="img-carousel" src="img/5845e13e7733c3558233c0ec.png">
				</div>
				<div class="img-wrapper">
					<img id="grumpy-cat-toungue" class="img-carousel" src="img/5845e14e7733c3558233c0ed.png">
				</div>
				<div class="img-wrapper">
					<img id="grumpy-cat-loogink-to-left" class="img-carousel" src="img/5845e1677733c3558233c0ee.png">
				</div>
				<div class="img-wrapper">
					<img id="dog-pixel-glasses" class="img-carousel" src="img/5845e635fb0b0755fa99d7e9.png">
				</div>
				<div class="img-wrapper">
					<img id="dog-transparent" class="img-carousel" src="img/5845e643fb0b0755fa99d7ea.png">
				</div>
				<div class="img-wrapper">
					<img id="dog-with-cigar" class="img-carousel" src="img/5845e665fb0b0755fa99d7ec.png">
				</div>
				<div class="img-wrapper">
					<img id="dog-yawning" class="img-carousel" src="img/5845e6b1fb0b0755fa99d7f0.png">
				</div>
				<div class="img-wrapper">
					<img id="dog-looking-left" class="img-carousel" src="img/5845e755fb0b0755fa99d7f3.png">
				</div>
				<div class="img-wrapper">
					<img id="dog-looking-right" class="img-carousel" src="img/5845e770fb0b0755fa99d7f4.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5845ec53dda95a5696fa1a26.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5845ec62dda95a5696fa1a27.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5845ec7fdda95a5696fa1a28.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5845ec9fdda95a5696fa1a29.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5845ed1bdda95a5696fa1a2a.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/584997587422de75c36182d4.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5849978e7422de75c36182d8.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/584998d695008575ff974862.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499929f6ff2e760b7467a8.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/584999937b7d4d76317f5ffd.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/584999a27b7d4d76317f5ffe.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499c84e9678476f613457a.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499e29b89d73775876620d.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499f7926191c779d22d92f.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499f8b26191c779d22d931.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499f9726191c779d22d932.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58499fc926191c779d22d933.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5849a03726191c779d22d936.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/585059646a5ae41a83ddee9c.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/585059b56a5ae41a83ddee9d.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5859b173711f64423aa5e050.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5862d43c1aa68e0bf26fa200.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/586567ea7d90850fc3ce2a29.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/588a6acad06f6719692a2d28.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/588a6ad0d06f6719692a2d29.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/588a6b2ad06f6719692a2d2a.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58909b545236a4e0f6e2f975.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58909bfe5236a4e0f6e2f97a.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/58967e8c0803320bf17c2fb7.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5896f72ecba9841eabab60fe.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/589b4da582250818d81e748f.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/59401c27bd0e8b4eeeb603c3.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/5984a0f14ca2e7219dcbe493.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/59cfce69d3b1936210a5ddf6.png">
				</div>
				<div class="img-wrapper">
					<img class="img-carousel" src="img/59cfce7ad3b1936210a5ddf7.png">
				</div>
			</div>
		</div>

		<?php require_once "footer.php"; ?>
		<script src="js/camera_setup.js"> </script>
	</body>
</html>
