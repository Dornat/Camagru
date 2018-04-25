const constraints = {
	video: true
};

const video = document.querySelector("video");
//console.log(video);

if (hasGetUserMedia()) {
	navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
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
