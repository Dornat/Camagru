const constraints = {
	video: true
};

const video = document.querySelector("video");

if (hasGetUserMedia()) {
	navigator.mediaDevices.getUserMedia(constraints)
		.then(handleSuccess).catch(handleError);
	const canvas = document.getElementById("picture-canvas");
	const button = document.getElementById("take-picture-button");
	const imgToPick = document.getElementsByClassName("img-wrapper");
	const rotate230 = document.getElementsByClassName("rotated-icon-230");
	const rotate40 = document.getElementsByClassName("rotated-icon-40");

	for (let i = 0; i < imgToPick.length; i++) {
		imgPickListener(imgToPick[i]);
	}

	function imgPickListener(img) {
		img.addEventListener('click', function() {
			let parentDiv = document.getElementById('webcam-wrapper');
			if (this.style.backgroundColor) {
				this.style.backgroundColor = "";
				parentDiv.removeChild(document.getElementById(
					this.getElementsByTagName('img')[0].id
				));
				this.nextElementSibling.setAttribute("style", "visibility: hidden");
			} else {
				this.style.backgroundColor = "#eef0f1";
				let newImg = document.createElement('img');
				newImg.src = this.getElementsByTagName('img')[0].src;
				newImg.setAttribute("class", "template-img");
				newImg.setAttribute("style", "width: 242px");
				newImg.setAttribute("id", this.getElementsByTagName('img')[0].id);
				parentDiv.appendChild(newImg);
				this.nextElementSibling.setAttribute("style", "visibility: visible");
			}
		});
	}

	for (let i = 0; i < rotate230.length; i++) {
		rotate230Listener(rotate230[i]);
	}

	function rotate230Listener(icon) {
		icon.addEventListener('click', function() {
			let parentDiv = document.getElementById('webcam-wrapper');
			let clickedImg = parentDiv.querySelector("#" + this.id);
			let width = extractNumber(clickedImg.style.width) + 5;
			clickedImg.style.width = width + 'px';
		});
	}

	for (let i = 0; i < rotate40.length; i++) {
		rotate40Listener(rotate40[i]);
	}

	function rotate40Listener(icon) {
		icon.addEventListener('click', function() {
			let parentDiv = document.getElementById('webcam-wrapper');
			let clickedImg = parentDiv.querySelector("#" + this.id);
			let width = extractNumber(clickedImg.style.width) - 5;
			clickedImg.style.width = width + 'px';
		});
	}

	button.onclick = function() {
		takeASnapshot(button, canvas);
	}
} else {
	alert('getUserMedia() is not supported by your browser');
}


function hasGetUserMedia() {
	return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
}

function handleSuccess(stream) {
	video.srcObject = stream;
}

function handleError(error) {
	console.log("Reeeejected", error);
}

function takeASnapshot(button, canvas) {
	const video = document.getElementById("video");

	if (button.innerHTML == "Shoot") {
		canvas.width = video.width;
		canvas.height = video.height;
		canvas.getContext("2d").drawImage(video, 0, 0);
		var drawnImg = document.getElementsByClassName("template-img");
		for (let i = 0; drawnImg[i]; i++) {
			if (window.innerWidth <= 700 && window.innerWidth > 500) {
				let newWidth = drawnImg[i].width * 1.3296703297;
				let newLeft = drawnImg[i].style.left.slice(0, -2) * 1.3296703297;
				let newTop = drawnImg[i].style.top.slice(0, -2) * 1.3296703297;
				canvas.getContext("2d").drawImage(
					drawnImg[i],
					newLeft, newTop,
					newWidth, drawnImg[i].height * 1.3296703297
				);
			} else if (window.innerWidth <= 500 && window.innerWidth > 400) {
				let newWidth = drawnImg[i].width * 1.7794117647;
				let newLeft = drawnImg[i].style.left.slice(0, -2) * 1.7794117647;
				let newTop = drawnImg[i].style.top.slice(0, -2) * 1.7794117647;
				canvas.getContext("2d").drawImage(
					drawnImg[i],
					newLeft, newTop,
					newWidth, drawnImg[i].height * 1.7794117647
				);
			} else if (window.innerWidth <= 400) {
				let newWidth = drawnImg[i].width * 2.0508474576;
				let newLeft = drawnImg[i].style.left.slice(0, -2) * 2.0508474576;
				let newTop = drawnImg[i].style.top.slice(0, -2) * 2.0508474576;
				canvas.getContext("2d").drawImage(
					drawnImg[i],
					newLeft, newTop,
					newWidth, drawnImg[i].height * 2.0508474576
				);
			} else {
				canvas.getContext("2d").drawImage(
					drawnImg[i],
					drawnImg[i].style.left.slice(0, -2), drawnImg[i].style.top.slice(0, -2),
					drawnImg[i].width, drawnImg[i].height
				);
			}
		}

		var resultImgTag = document.getElementById("picture-img");
		resultImgTag.src = canvas.toDataURL("image/png");

		document.getElementById('picture-button-container')
			.setAttribute('style', 'justify-content: space-around;');
		setHrefToDuwnloadButton(resultImgTag.src);
		setDisplayStylesToCanvasAndVideoTags("block", "none");
		setDisplayStyleToButtons('block');
		setOpacityToButtons(1);
		button.innerHTML = "Try again";
	} else if (button.innerHTML == "Try again") {
		document.getElementById('picture-button-container')
			.setAttribute('style', 'justify-content: center;');
		setDisplayStylesToCanvasAndVideoTags("none", "block");
		setDisplayStyleToButtons('none');
		setOpacityToButtons(0);
		setRoutinesToSaveButton('take-picture-button', 'Save to Gallery');
		button.innerHTML = "Shoot";
	}

	function setHrefToDuwnloadButton(href) {
		let downloadBtnHref = document.getElementById('download-button-href');
		downloadBtnHref.href = href;
	}

	function setDisplayStylesToCanvasAndVideoTags(canvasStyle, videoStyle) {
		canvas.style.display = canvasStyle;
		video.style.display = videoStyle;
	}

	function setDisplayStyleToButtons(displayValue) {
		let downloadBtn = document.getElementById('download-button');
		let saveToGalleryBtn = document.getElementById('save-to-gallery-button');
		downloadBtn.setAttribute('style', 'display: ' + displayValue + ';');
		saveToGalleryBtn.setAttribute('style', 'display: ' + displayValue + ';');
	}

	function setOpacityToButtons(opacity) {
		let downloadBtn = document.getElementById('download-button');
		let saveToGalleryBtn = document.getElementById('save-to-gallery-button');
		downloadBtn.style.opacity = opacity;
		saveToGalleryBtn.style.opacity = opacity;
	}

	function setRoutinesToSaveButton(className, text) {
		let btn = document.getElementById('save-to-gallery-button');
		btn.setAttribute('class', className);
		btn.innerHTML = text;
		btn.removeAttribute('disabled');
	}
}

function saveToGalleryRoutine() {
	changeBtnAppearance();
	loadXMLToPhp();

	function changeBtnAppearance() {
		let btn = document.getElementById('save-to-gallery-button');
		btn.setAttribute('class', 'taken-picture-button');
		btn.innerHTML = 'Saved';
		btn.setAttribute('disabled', 'disabled');
	}

	function loadXMLToPhp() {
		let xmlhttp = new XMLHttpRequest();
		let imgSrc = document.getElementById('picture-img').src;

		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				console.log(xmlhttp.responseText);
			}
		}

		let params = 'img_src=' + imgSrc;
		xmlhttp.open('POST', '../collage_image_processing.php', true);
		xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(params);
	}
}
