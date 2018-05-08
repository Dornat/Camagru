<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Camagru | Shoot</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/login_form.css">
		<link rel="stylesheet" href="css/shoot.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width">
	</head>
	<body>
		<?php require_once "header.php"; ?>
		<div class="webcam-container">
			<div id="webcam-container-left">
				<div id="webcam-wrapper">
					<video id="video" width="640" height="480" autoplay></video>
					<!-- <video id="video" width="640" height="480" poster="img/5845ccd80b2a3b54fdbaecf5.png"></video> -->
					<canvas id="picture-canvas"></canvas>
					<input type="file" name="upload-file" id="upload-file" onchange="previewFile()">
					<label id="upload-file-label" for="upload-file"><i class="fas fa-upload"></i></label>
				</div>
				<img id="picture-img" src="">
				<div id="picture-button-container" class="picture-button-container" style="justify-content: center;">
					<a id="download-button-href" href="sign_up_page.php" download="awesome_pic.png" style="text-decoration: none;"><button id="download-button" class="take-picture-button" style="display: none;">Download</button></a>
					<button id="take-picture-button" class="take-picture-button">Shoot</button>
					<button id="save-to-gallery-button" class="take-picture-button" style="display: none;" onClick="saveToGalleryRoutine()">Save to Gallery</button>
				</div> <!-- picture-button-container -->
				<div class="carousel-container">
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="obama" class="img-carousel" src="img/580b57fbd9996e24bc43be4e.png">
						</div>
						<div class="icon-wrapper">
							<i id="obama" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="obama" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="trump" class="img-carousel" src="img/580b57fbd9996e24bc43be5c.png">
						</div>
						<div class="icon-wrapper">
							<i id="trump" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="trump" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="steave-head" class="img-carousel" src="img/580b57fcd9996e24bc43c2f0.png">
						</div>
						<div class="icon-wrapper">
							<i id="steave-head" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="steave-head" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="grass-block" class="img-carousel" src="img/580b57fcd9996e24bc43c2f1.png">
						</div>
						<div class="icon-wrapper">
							<i id="grass-block" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="grass-block" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="creeper-head" class="img-carousel" src="img/580b57fcd9996e24bc43c2f2.png">
						</div>
						<div class="icon-wrapper">
							<i id="creeper-head" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="creeper-head" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="creeper" class="img-carousel" src="img/580b57fcd9996e24bc43c2f7.png">
						</div>
						<div class="icon-wrapper">
							<i id="creeper" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="creeper" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="weed-bush" class="img-carousel" src="img/580b585b2edbce24c47b2618.png">
						</div>
						<div class="icon-wrapper">
							<i id="weed-bush" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="weed-bush" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="pepe-inhales-memes" class="img-carousel" src="img/5845ccd80b2a3b54fdbaecf5.png">
						</div>
						<div class="icon-wrapper">
							<i id="pepe-inhales-memes" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="pepe-inhales-memes" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="pepe-happy" class="img-carousel" src="img/5845cd430b2a3b54fdbaecf8.png">
						</div>
						<div class="icon-wrapper">
							<i id="pepe-happy" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="pepe-happy" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="grumpy-cat-loogink-to-right" class="img-carousel" src="img/5845e13e7733c3558233c0ec.png">
						</div>
						<div class="icon-wrapper">
							<i id="grumpy-cat-loogink-to-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="grumpy-cat-loogink-to-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="grumpy-cat-toungue" class="img-carousel" src="img/5845e14e7733c3558233c0ed.png">
						</div>
						<div class="icon-wrapper">
							<i id="grumpy-cat-toungue" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="grumpy-cat-toungue" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="grumpy-cat-loogink-to-left" class="img-carousel" src="img/5845e1677733c3558233c0ee.png">
						</div>
						<div class="icon-wrapper">
							<i id="grumpy-cat-loogink-to-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="grumpy-cat-loogink-to-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="dog-pixel-glasses" class="img-carousel" src="img/5845e635fb0b0755fa99d7e9.png">
						</div>
						<div class="icon-wrapper">
							<i id="dog-pixel-glasses" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="dog-pixel-glasses" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="dog-transparent" class="img-carousel" src="img/5845e643fb0b0755fa99d7ea.png">
						</div>
						<div class="icon-wrapper">
							<i id="dog-transparent" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="dog-transparent" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="dog-with-cigar" class="img-carousel" src="img/5845e665fb0b0755fa99d7ec.png">
						</div>
						<div class="icon-wrapper">
							<i id="dog-with-cigar" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="dog-with-cigar" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="dog-yawning" class="img-carousel" src="img/5845e6b1fb0b0755fa99d7f0.png">
						</div>
						<div class="icon-wrapper">
							<i id="dog-yawning" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="dog-yawning" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="dog-looking-left" class="img-carousel" src="img/5845e755fb0b0755fa99d7f3.png">
						</div>
						<div class="icon-wrapper">
							<i id="dog-looking-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="dog-looking-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="dog-looking-right" class="img-carousel" src="img/5845e770fb0b0755fa99d7f4.png">
						</div>
						<div class="icon-wrapper">
							<i id="dog-looking-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="dog-looking-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="purple-frog-looking-left" class="img-carousel" src="img/5845ec53dda95a5696fa1a26.png">
						</div>
						<div class="icon-wrapper">
							<i id="purple-frog-looking-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="purple-frog-looking-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="purple-frog-looking-right" class="img-carousel" src="img/5845ec62dda95a5696fa1a27.png">
						</div>
						<div class="icon-wrapper">
							<i id="purple-frog-looking-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="purple-frog-looking-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="green-frog-with-tiny-legs" class="img-carousel" src="img/5845ec7fdda95a5696fa1a28.png">
						</div>
						<div class="icon-wrapper">
							<i id="green-frog-with-tiny-legs" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="green-frog-with-tiny-legs" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="green-frog-with-chest" class="img-carousel" src="img/5845ec9fdda95a5696fa1a29.png">
						</div>
						<div class="icon-wrapper">
							<i id="green-frog-with-chest" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="green-frog-with-chest" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="green-frog-head-only" class="img-carousel" src="img/5845ed1bdda95a5696fa1a2a.png">
						</div>
						<div class="icon-wrapper">
							<i id="green-frog-head-only" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="green-frog-head-only" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="chain" class="img-carousel" src="img/584997587422de75c36182d4.png">
						</div>
						<div class="icon-wrapper">
							<i id="chain" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="chain" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="chain-with-dollar" class="img-carousel" src="img/5849978e7422de75c36182d8.png">
						</div>
						<div class="icon-wrapper">
							<i id="chain-with-dollar" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="chain-with-dollar" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="weed-cigaret" class="img-carousel" src="img/584998d695008575ff974862.png">
						</div>
						<div class="icon-wrapper">
							<i id="weed-cigaret" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="weed-cigaret" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="smoking-cigaret" class="img-carousel" src="img/58499929f6ff2e760b7467a8.png">
						</div>
						<div class="icon-wrapper">
							<i id="smoking-cigaret" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="smoking-cigaret" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="pixel-glasses" class="img-carousel" src="img/584999937b7d4d76317f5ffd.png">
						</div>
						<div class="icon-wrapper">
							<i id="pixel-glasses" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="pixel-glasses" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="pixel-glasses-looging-left" class="img-carousel" src="img/584999a27b7d4d76317f5ffe.png">
						</div>
						<div class="icon-wrapper">
							<i id="pixel-glasses-looging-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="pixel-glasses-looging-left" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="thug-life-with-two-guns-tatoo" class="img-carousel" src="img/58499c84e9678476f613457a.png">
						</div>
						<div class="icon-wrapper">
							<i id="thug-life-with-two-guns-tatoo" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="thug-life-with-two-guns-tatoo" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="thug-life-camel" class="img-carousel" src="img/58499e29b89d73775876620d.png">
						</div>
						<div class="icon-wrapper">
							<i id="thug-life-camel" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="thug-life-camel" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="obey-hat" class="img-carousel" src="img/58499f7926191c779d22d92f.png">
						</div>
						<div class="icon-wrapper">
							<i id="obey-hat" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="obey-hat" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="thug-life-red-hat" class="img-carousel" src="img/58499f8b26191c779d22d931.png">
						</div>
						<div class="icon-wrapper">
							<i id="thug-life-red-hat" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="thug-life-red-hat" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="thug-life-bandana-black" class="img-carousel" src="img/58499f9726191c779d22d932.png">
						</div>
						<div class="icon-wrapper">
							<i id="thug-life-bandana-black" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="thug-life-bandana-black" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="thug-life-bandana-red" class="img-carousel" src="img/58499fc926191c779d22d933.png">
						</div>
						<div class="icon-wrapper">
							<i id="thug-life-bandana-red" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="thug-life-bandana-red" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="thug-life-hat-black" class="img-carousel" src="img/5849a03726191c779d22d936.png">
						</div>
						<div class="icon-wrapper">
							<i id="thug-life-hat-black" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="thug-life-hat-black" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="trump-hair-front" class="img-carousel" src="img/585059646a5ae41a83ddee9c.png">
						</div>
						<div class="icon-wrapper">
							<i id="trump-hair-front" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="trump-hair-front" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="trumg-hair-profile" class="img-carousel" src="img/585059b56a5ae41a83ddee9d.png">
						</div>
						<div class="icon-wrapper">
							<i id="trumg-hair-profile" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="trumg-hair-profile" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="pepe-smiling-humble" class="img-carousel" src="img/5859b173711f64423aa5e050.png">
						</div>
						<div class="icon-wrapper">
							<i id="pepe-smiling-humble" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="pepe-smiling-humble" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="obama-on-the-phone" class="img-carousel" src="img/5862d43c1aa68e0bf26fa200.png">
						</div>
						<div class="icon-wrapper">
							<i id="obama-on-the-phone" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="obama-on-the-phone" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="robot-head" class="img-carousel" src="img/586567ea7d90850fc3ce2a29.png">
						</div>
						<div class="icon-wrapper">
							<i id="robot-head" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="robot-head" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="computer-low" class="img-carousel" src="img/588a6acad06f6719692a2d28.png">
						</div>
						<div class="icon-wrapper">
							<i id="computer-low" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="computer-low" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="computer-right" class="img-carousel" src="img/588a6ad0d06f6719692a2d29.png">
						</div>
						<div class="icon-wrapper">
							<i id="computer-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="computer-right" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="laptop" class="img-carousel" src="img/588a6b2ad06f6719692a2d2a.png">
						</div>
						<div class="icon-wrapper">
							<i id="laptop" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="laptop" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="just-do-it-front" class="img-carousel" src="img/58909b545236a4e0f6e2f975.png">
						</div>
						<div class="icon-wrapper">
							<i id="just-do-it-front" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="just-do-it-front" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="just-do-it-profile" class="img-carousel" src="img/58909bfe5236a4e0f6e2f97a.png">
						</div>
						<div class="icon-wrapper">
							<i id="just-do-it-profile" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="just-do-it-profile" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="nigga-crying" class="img-carousel" src="img/58967e8c0803320bf17c2fb7.png">
						</div>
						<div class="icon-wrapper">
							<i id="nigga-crying" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="nigga-crying" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="pepe-white" class="img-carousel" src="img/5896f72ecba9841eabab60fe.png">
						</div>
						<div class="icon-wrapper">
							<i id="pepe-white" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="pepe-white" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="think-of-it-nigga" class="img-carousel" src="img/589b4da582250818d81e748f.png">
						</div>
						<div class="icon-wrapper">
							<i id="think-of-it-nigga" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="think-of-it-nigga" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="imac" class="img-carousel" src="img/59401c27bd0e8b4eeeb603c3.png">
						</div>
						<div class="icon-wrapper">
							<i id="imac" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="imac" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="napoleon-hat" class="img-carousel" src="img/5984a0f14ca2e7219dcbe493.png">
						</div>
						<div class="icon-wrapper">
							<i id="napoleon-hat" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="napoleon-hat" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="little-plant" class="img-carousel" src="img/59cfce69d3b1936210a5ddf6.png">
						</div>
						<div class="icon-wrapper">
							<i id="little-plant" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="little-plant" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div>
					<div class="carousel-container-wrapper">
						<div class="img-wrapper">
							<img id="bay-leaf" class="img-carousel" src="img/59cfce7ad3b1936210a5ddf7.png">
						</div>
						<div class="icon-wrapper">
							<i id="bay-leaf" class="far fa-arrow-alt-circle-right size-icon rotated-icon-230"></i>
							<i id="bay-leaf" class="far fa-arrow-alt-circle-right size-icon rotated-icon-40"></i>
						</div>
					</div> <!-- carousel-container -->
				</div>
			</div> <!-- webcam-container-left -->
			<div id="webcam-container-right">
				<div class="user-gallery-container">
					<!-- User pictures will fill this container from database -->
				</div>
			</div> <!-- webcam-container-right -->
		</div> <!-- webcam-container -->

		<?php require_once "footer.php"; ?>
		<script src="js/camera_setup.js"> </script>
		<script src="js/draggable.js"> </script>
		<script src="js/print_user_gallery.js"> </script>
		<script src="js/user_gallery_options.js"> </script>
	</body>
</html>
