const constraints = {
	video: true
};

const video = document.querySelector("video");
//console.log(video);

if (hasGetUserMedia()) {
	navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
	const canvas = document.getElementById("picture-canvas");
	const button = document.getElementById("take-picture-button");
	const imgToPick = document.getElementsByClassName("img-wrapper");

	for (var i = 0; i < imgToPick.length; i++) {
		imgPickListener(imgToPick[i]);
	}

	function imgPickListener(img) {
		img.addEventListener('click', function() {
			let parentDiv = document.getElementById('webcam-wrapper');
			if (this.style.backgroundColor) {
				this.style.backgroundColor = "";
				parentDiv.removeChild(document.getElementById(this.getElementsByTagName('img')[0].id));
			} else {
				this.style.backgroundColor = "#eef0f1";
				let newImg = document.createElement('img');
				newImg.src = this.getElementsByTagName('img')[0].src;
				newImg.setAttribute("class", "template-img");
				newImg.setAttribute("id", this.getElementsByTagName('img')[0].id);
				parentDiv.appendChild(newImg);
				//console.log(this.getElementsByTagName('img')[0]);
				//canvas.getContext("2d").drawImage(this.innerHtml, 0, 0);
			}
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
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext("2d").drawImage(video, 0, 0);
		//var drownImg = document.getElementById("obama");
		//canvas.getContext("2d").drawImage(drownImg, 0, 0);
		var drawnImg = document.getElementsByClassName("template-img");
		for (let i = 0; drawnImg[i]; i++) {
			canvas.getContext("2d").drawImage(
				drawnImg[i],
				drawnImg[i].style.left.slice(0, -2), drawnImg[i].style.top.slice(0, -2),
				drawnImg[i].width, drawnImg[i].height
			);
		}
		putAssembledImageToSrcOfImgTag();
		setDisplayStylesToCanvasAndVideoTags("block", "none");
		button.innerHTML = "Try again";
	} else if (button.innerHTML == "Try again") {
		setDisplayStylesToCanvasAndVideoTags("none", "block");
		button.innerHTML = "Shoot";
	}

	function putAssembledImageToSrcOfImgTag() {
		const img = document.getElementById("picture-img");
		img.src = canvas.toDataURL("image/webp");
	}

	function setDisplayStylesToCanvasAndVideoTags(canvasStyle, videoStyle) {
		canvas.style.display = canvasStyle;
		video.style.display = videoStyle;
	}
}
