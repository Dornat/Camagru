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
			let divUserImgContainer = document.createElement('div');
			divUserImgContainer.setAttribute('class', 'user-image-container');
			let divIconsContainer = document.createElement('div');
			divIconsContainer.setAttribute('class', 'user-image-icons-container');
			let downloadIcon = document.createElement('i');
			downloadIcon.setAttribute(
				'class', 'fas fa-download download-image-from-gallery'
			);
			let trashIcon = document.createElement('i');
			trashIcon.setAttribute(
				'class', 'fas fa-trash-alt trash-image-from-gallery'
			);
			trashIcon.setAttribute(
				'onClick', 'deleteImgFromDb(\'' + imgArr[i] + '\')'
			);
			divIconsContainer.appendChild(downloadIcon);
			divIconsContainer.appendChild(trashIcon);
			let newImg = document.createElement('img');
			newImg.src = imgArr[i];
			newImg.setAttribute('class', 'user-gallery-img');
			divUserImgContainer.appendChild(newImg);
			divUserImgContainer.appendChild(divIconsContainer);
			parentDiv.appendChild(divUserImgContainer);
		}
	}
}

function resetLatestUserImg() {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var imgPath = xmlhttp.responseText;
			addNewLatestImg(imgPath);
		}
	}

	let randNum = 'num=' + Math.random();
	xmlhttp.open('POST', '../get_latest_user_image.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(randNum);

	function addNewLatestImg(imgPath) {
		let parentDiv = document.getElementsByClassName('user-gallery-container')[0];
		let divUserImgContainer = document.createElement('div');
		divUserImgContainer.setAttribute('class', 'user-image-container');
		let divIconsContainer = document.createElement('div');
		divIconsContainer.setAttribute('class', 'user-image-icons-container');
		let downloadIcon = document.createElement('i');
		downloadIcon.setAttribute(
			'class', 'fas fa-download download-image-from-gallery'
		);
		let trashIcon = document.createElement('i');
		trashIcon.setAttribute(
			'class', 'fas fa-trash-alt trash-image-from-gallery'
		);
		trashIcon.setAttribute(
			'onClick', 'deleteImgFromDb(\'' + imgPath + '\')'
		);
		divIconsContainer.appendChild(downloadIcon);
		divIconsContainer.appendChild(trashIcon);
		let newImg = document.createElement('img');
		newImg.src = imgPath;
		newImg.setAttribute('class', 'user-gallery-img');
		divUserImgContainer.appendChild(newImg);
		divUserImgContainer.appendChild(divIconsContainer);
		parentDiv.insertBefore(divUserImgContainer, parentDiv.childNodes[0]);
	}
}
