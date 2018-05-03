printUserGallery();

function printUserGallery() {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var imgArr = JSON.parse(xmlhttp.responseText);
			fillUserGallery(imgArr);
		}
	}

	let randNum = 'num=' + Math.random();
	xmlhttp.open('POST', '../get_user_gallery.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(randNum);

	function fillUserGallery(imgArr) {
		let parentDiv = document.getElementsByClassName('user-gallery-container')[0];
		for (let i = 0; i < imgArr.length; i++) {
			let newImg = document.createElement('img');
			newImg.src = imgArr[i];
			newImg.setAttribute('class', 'user-gallery-img');
			parentDiv.appendChild(newImg);
		}
	}
}

function resetLatestUserImg() {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var imgPath = xmlhttp.responseText;
			console.log(imgPath);
			addNewLatestImg(imgPath);
		}
	}

	console.log('resetLatestUserImg');
	let randNum = 'num=' + Math.random();
	xmlhttp.open('POST', '../get_latest_user_image.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(randNum);

	function addNewLatestImg(imgPath) {
		let parentDiv = document.getElementsByClassName('user-gallery-container')[0];
		let newImg = document.createElement('img');
		newImg.src = imgPath;
		newImg.setAttribute('class', 'user-gallery-img');
		//parentDiv.appendChild(newImg);
		parentDiv.insertBefore(newImg, parentDiv.childNodes[0]);
	}
}
