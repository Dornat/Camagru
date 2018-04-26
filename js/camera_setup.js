const constraints = {
	video: true
};

const video = document.querySelector("video");
//console.log(video);

if (hasGetUserMedia()) {
	navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
	const button = document.getElementById("take-picture-button");
	const img = document.getElementById("picture-img");
	const video = document.getElementById("video");

	const canvas = document.getElementById("picture-canvas");

	canvasTest = canvas.getContext("2d");

	button.onclick = function() {
		if (button.innerHTML == "Shoot") {
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext("2d").drawImage(video, 0, 0);
			img.src = canvas.toDataURL("image/webp");
			img.style.display = "none";
			canvas.style.display = "block";
			var img2 = document.getElementById("firstimg");
			canvasTest.drawImage(img2, 100, 100, 100, 100);
			video.style.display = "none";
			button.innerHTML = "Try again";
		} else if (button.innerHTML == "Try again") {
			img.style.display = "none";
			canvas.style.display = "none";
			video.style.display = "block";
			button.innerHTML = "Shoot";
		}
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
