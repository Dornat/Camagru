function deleteImgFromDb(imgSrc) {
	let xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			deleteImgFromUserGallery(imgSrc);
		}
	}

	let params = 'img_src=' + imgSrc;
	xmlhttp.open('POST', '../delete_img_from_db.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(params);
}

function deleteImgFromUserGallery(imgSrc) {
	let img = document.getElementById(imgSrc);
	img.parentNode.parentNode.removeChild(img.parentNode);
}

function previewFile() {
	var newImg = document.createElement('img');
	var parentDiv = document.getElementById('webcam-wrapper');
	var file = document.querySelector('input[type=file]').files[0];
	var reader = new FileReader();

	reader.onloadend = function () {
		let videoTag = document.getElementById('video');
		var savedWidth = videoTag.width;
		var savedHeight = videoTag.height;
		var relativeLeftMargin;
		var relativeTopMargin;
		parentDiv.removeChild(videoTag);
		newImg.setAttribute('src', reader.result);
		newImg.setAttribute('id', 'video');
		parentDiv.appendChild(newImg);
	}

	if (file) {
		reader.readAsDataURL(file);
	} else {
		preview.src = "";
	}


}

//function previewFile1() {
//	var preview = document.getElementById('test-img'); //selects the query named img
//	var file    = document.querySelector('input[type=file]').files[0]; //sames as here
//	var reader  = new FileReader();
//
//	reader.onloadend = function () {
//		preview.setAttribute('src', reader.result);
//	}
//
//	if (file) {
//		reader.readAsDataURL(file); //reads the data as a URL
//		console.log(file);
//	} else {
//		preview.src = "";
//	}
//}
