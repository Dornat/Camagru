printUserGallery();

function printUserGallery() {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var arrayOfImgSources = JSON.parse(xmlhttp.responseText);
			fillUserGallery(arrayOfImgSources);
		}
	}

	let randNum = 'num=' + Math.random();
	xmlhttp.open('POST', '../get_user_gallery.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(randNum);

	function fillUserGallery(arrayOfImgSources) {
		let parentDiv = document.getElementsByClassName('user-gallery-container')[0];
		for (let i = 0; i < arrayOfImgSources.length; i++) {
			let divUserImgContainer = document.createElement('div');
			divUserImgContainer.setAttribute('class', 'user-image-container');

			let divIconsContainer = document.createElement('div');
			divIconsContainer.setAttribute('class', 'user-image-icons-container');

			let downloadIconHref = document.createElement('a');
			downloadIconHref.setAttribute(
				'href', arrayOfImgSources[i]
			);
			downloadIconHref.setAttribute(
				'download', 'awesome_pic.png'
			);

			let downloadIcon = document.createElement('i');
			downloadIcon.setAttribute(
				'class', 'fas fa-download download-image-from-gallery'
			);

			downloadIconHref.appendChild(downloadIcon);

			let trashIcon = document.createElement('i');
			trashIcon.setAttribute(
				'class', 'fas fa-trash-alt trash-image-from-gallery'
			);
			trashIcon.setAttribute(
				'onClick', 'deleteImgFromDb(\'' + arrayOfImgSources[i] + '\')'
			);
			divIconsContainer.appendChild(downloadIconHref);
			divIconsContainer.appendChild(trashIcon);

			let newImg = document.createElement('img');
			newImg.src = arrayOfImgSources[i];
			newImg.setAttribute('class', 'user-gallery-img');
			newImg.setAttribute(
				'id', arrayOfImgSources[i]
			);
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
			var imgSrc = xmlhttp.responseText;
			addNewLatestImg(imgSrc);
		}
	}

	let randNum = 'num=' + Math.random();
	xmlhttp.open('POST', '../get_latest_user_image.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(randNum);

	function addNewLatestImg(imgSrc) {
		let parentDiv = document.getElementsByClassName('user-gallery-container')[0];
		let divUserImgContainer = document.createElement('div');
		divUserImgContainer.setAttribute('class', 'user-image-container');
		let divIconsContainer = document.createElement('div');
		divIconsContainer.setAttribute('class', 'user-image-icons-container');

		let downloadIconHref = document.createElement('a');
		downloadIconHref.setAttribute(
			'href', imgSrc
		);
		downloadIconHref.setAttribute(
			'download', 'awesome_pic.png'
		);

		let downloadIcon = document.createElement('i');
		downloadIcon.setAttribute(
			'class', 'fas fa-download download-image-from-gallery'
		);

		downloadIconHref.appendChild(downloadIcon);
		let trashIcon = document.createElement('i');
		trashIcon.setAttribute(
			'class', 'fas fa-trash-alt trash-image-from-gallery'
		);
		trashIcon.setAttribute(
			'onClick', 'deleteImgFromDb(\'' + imgSrc + '\')'
		);
		divIconsContainer.appendChild(downloadIconHref);
		divIconsContainer.appendChild(trashIcon);
		let newImg = document.createElement('img');
		newImg.src = imgSrc;
		newImg.setAttribute('class', 'user-gallery-img');
		newImg.setAttribute(
			'id', imgSrc
		);
		divUserImgContainer.appendChild(newImg);
		divUserImgContainer.appendChild(divIconsContainer);
		parentDiv.insertBefore(divUserImgContainer, parentDiv.childNodes[0]);
	}
}
