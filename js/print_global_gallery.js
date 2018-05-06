var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function () {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var arrayOfImgSources = JSON.parse(xmlhttp.responseText);
		console.log(arrayOfImgSources);
		fillPageWithGlobalGallery(arrayOfImgSources);
	}
}

let randNum = 'num=' + Math.random();
xmlhttp.open('POST', '../print_global_gallery.php', true);
xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
xmlhttp.send(randNum);

function fillPageWithGlobalGallery(arrayOfImgSources) {
	let galleryContainer = document.getElementsByClassName('global-gallery-container')[0];
	let galleryWrapper = document.getElementById('global-gallery-wrapper');
	for (let i = 0; i < arrayOfImgSources.length; i++) {
		let divUserImgContainer = document.createElement('div');
		divUserImgContainer.setAttribute('class', 'global-gallery-img-container');

		let newImg = document.createElement('img');
		newImg.src = arrayOfImgSources[i];
		newImg.setAttribute('class', 'global-gallery-img');
		newImg.setAttribute(
			'id', arrayOfImgSources[i]
		);
		divUserImgContainer.appendChild(newImg);
		galleryWrapper.appendChild(divUserImgContainer);
		galleryContainer.appendChild(galleryWrapper);
	}
}
