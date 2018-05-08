var xmlhttp = new XMLHttpRequest();

console.log(window.location.search.substr(1));
xmlhttp.onreadystatechange = function () {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		//console.log(xmlhttp.responseText);
		var arrayOfImgSources = JSON.parse(xmlhttp.responseText);
		console.log(arrayOfImgSources);
		fillPageWithGlobalGallery(arrayOfImgSources);

		let likes = document.getElementsByClassName('like');
		for (let i = 0; i < likes.length; i++) {
			likesListener(likes[i], arrayOfImgSources);
		}
	}
}

let randNum = 'num=' + Math.random();
xmlhttp.open('POST', '../print_global_gallery.php', true);
xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
xmlhttp.send(randNum);

function fillPageWithGlobalGallery(arrayOfImgSources) {
	let galleryContainer = document.getElementsByClassName('global-gallery-container')[0];
	let galleryWrapper = document.getElementById('global-gallery-wrapper');
	for (let i = 0; i < arrayOfImgSources.length - 1; i++) {
		galleryWrapper.appendChild(
			assambleImageContainer(
				createImage(arrayOfImgSources[i]['img_path']), arrayOfImgSources[i]
			)
		);
		galleryContainer.appendChild(galleryWrapper);
	}

	function assambleImageContainer(image, imgArr) {
		let imgContainer = document.createElement('div');
		imgContainer.setAttribute('class', 'global-gallery-img-container');
		imgContainer.appendChild(image);
		imgContainer.appendChild(createLikeAndCommentContainer());
		return imgContainer;

		function createLikeAndCommentContainer() {
			let container = document.createElement('div');
			container.setAttribute('class', 'like-and-comment-container');
			var is_liked = '';

			let like = document.createElement('i');
			like.setAttribute('class', 'fas fa-thumbs-up like');
			let likeCount = document.createElement('span');
			likeCount.setAttribute('class', 'like-count');
			if (imgArr.liked_user_ids[0] != null) {
				let userIds = imgArr.liked_user_ids;
				let currentUserId = getCurrentUserId(arrayOfImgSources);
				let currentUserIdIsInLikedUserIds =
					userIds.findIndex(function (item) {
						return item.user_id === currentUserId;
					});
				if (currentUserIdIsInLikedUserIds != -1) {
					like.classList.add('liked');
				}
			}
			likeCount.innerHTML = imgArr.like_count;
			like.appendChild(likeCount);
			console.log(imgArr.img_path);

			let commentHref = document.createElement('a');
			commentHref.setAttribute(
				'href',
				'comment_page.php?image_id=' + imgArr.id
			);
			let commentIcon = document.createElement('i');
			commentIcon.setAttribute('class', 'fas fa-comments comments');
			commentHref.appendChild(commentIcon);

			container.appendChild(like);
			container.appendChild(commentHref);
			return container;
		}
	}
	function createImage(imgSrc) {
		let newImg = document.createElement('img');
		newImg.src = imgSrc;
		newImg.setAttribute('class', 'global-gallery-img');
		newImg.setAttribute(
			'id', imgSrc
		);
		return newImg;
	}
}

function likesListener(like, imgArr) {
	like.addEventListener('click', function () {
		if (getCurrentUserId(imgArr) === null) {
			alert('Please Login or Sign up to do stuff');
			return ;
		}
		var imgSrc = like.parentNode.parentNode
			.getElementsByTagName('img')[0]
			.getAttribute('src');
		let index = imgArr.findIndex(function (item, i) {
			return item.img_path == imgSrc;
		});

		if (like.classList.contains('liked') === false) {
			let likeCount = like.getElementsByTagName('span')[0].innerHTML;
			like.getElementsByTagName('span')[0].innerHTML = parseInt(likeCount) + 1;
			like.classList.add('liked');
			likeImage(imgArr[index].id, getCurrentUserId(imgArr));
		} else {
			let likeCount = like.getElementsByTagName('span')[0].innerHTML;
			like.getElementsByTagName('span')[0].innerHTML = parseInt(likeCount) - 1;
			like.classList.remove('liked');
			unlikeImage(imgArr[index].id, getCurrentUserId(imgArr));
		}
	});
}

function likeImage(imageId, currentUserId) {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			;
		}
	}

	let ids = 'image_id=' + imageId + '&current_user_id=' + currentUserId;
	xmlhttp.open('POST', '../like_image.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(ids);
}

function unlikeImage(imageId, currentUserId) {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			;
		}
	}

	let ids = 'image_id=' + imageId + '&current_user_id=' + currentUserId;
	xmlhttp.open('POST', '../unlike_image.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(ids);
}

function getCurrentUserId(arrayOfImgSources) {
	let indexOfUserId = arrayOfImgSources.findIndex(function (item) {
		return item.user_id;
	});
	if (indexOfUserId === -1) {
		return null;
	} else {
		let currentUserId = arrayOfImgSources[indexOfUserId].user_id;
		return currentUserId;
	}
}
