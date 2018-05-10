if (!parseInt(window.location.search.substr(1).replace(/^\D+/g, ''))) {
	var currentPage = 1;
} else {
	var currentPage = parseInt(window.location.search.substr(1).replace(/^\D+/g, ''));
}

var numberOfJunkThatIAddToEndOfArray = 2;

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function () {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var arrayOfImgSources = JSON.parse(xmlhttp.responseText);
		let indexOfPageCell = arrayOfImgSources.findIndex(function (item) {
			return item.number_of_pages;
		});
		let numOfPages = arrayOfImgSources[indexOfPageCell]['number_of_pages'];
		fillPageWithGlobalGallery(arrayOfImgSources);
		if (numOfPages > 1) {
			document.getElementById('pagination-container').appendChild(
				createPagination(currentPage, numOfPages)
			);
		}

		let likes = document.getElementsByClassName('like');
		for (let i = 0; i < likes.length; i++) {
			likesListener(likes[i], arrayOfImgSources);
		}
	}
}

let randNum = 'num=' + Math.random();
xmlhttp.open('POST', '../print_global_gallery.php?page=' + currentPage, true);
xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
xmlhttp.send(randNum);

function fillPageWithGlobalGallery(arrayOfImgSources) {
	let galleryContainer = document.getElementsByClassName('global-gallery-container')[0];
	let galleryWrapper = document.getElementById('global-gallery-wrapper');
	for (let i = 0; i < arrayOfImgSources.length - numberOfJunkThatIAddToEndOfArray; i++) {
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

			let commentHref = document.createElement('a');
			commentHref.setAttribute(
				'href',
				'comment_page.php?image_id=' + imgArr.id
			);
			let commentIcon = document.createElement('i');
			commentIcon.setAttribute('class', 'fas fa-comments comments');
			let commentsCount = document.createElement('span');
			commentsCount.setAttribute('class', 'like-count');
			commentsCount.innerHTML = imgArr.comments_count;
			commentIcon.appendChild(commentsCount);

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


function createPagination(currentPage, numberOfPages) {
	let paginationDiv = document.createElement('div');
	paginationDiv.setAttribute('class', 'pagination');

	let leftArrowHref = createLeftArrow();
	let rightArrowHref = createRightArrow();

	paginationDiv.appendChild(leftArrowHref);

	let paginationArray = pagination(currentPage, numberOfPages);

	for (let i of paginationArray) {
		let href = document.createElement('a');
		if (i == 1) {
			href.setAttribute('href', 'index.php');
			if (i == currentPage) {
				href.setAttribute('class', 'active');
			}
			href.innerHTML = i;
		} else if (i == '...') {
			href.setAttribute('href', '#');
			href.innerHTML = i;
		} else {
			href.setAttribute('href', 'index.php?page=' + i);
			if (i == currentPage) {
				href.setAttribute('class', 'active');
			}
			href.innerHTML = i;
		}
		paginationDiv.appendChild(href);
	}

	paginationDiv.appendChild(rightArrowHref);
	return paginationDiv;

	function createLeftArrow() {
		let leftArrowHref = document.createElement('a');
		if (currentPage == 1) {
			leftArrowHref.setAttribute('class', 'disabled');
		}
		if (currentPage != 1) {
			leftArrowHref.setAttribute('href', 'index.php?page=' + (currentPage - 1));
		}
		leftArrowHref.innerHTML = '&laquo;';
		return leftArrowHref;
	}

	function createRightArrow() {
		let rightArrowHref = document.createElement('a');
		if (currentPage != numberOfPages) {
			rightArrowHref.setAttribute('href', 'index.php?page=' + (currentPage + 1));
		}
		if (currentPage == numberOfPages) {
			rightArrowHref.setAttribute('class', 'disabled');
		}
		rightArrowHref.innerHTML = '&raquo;';
		return rightArrowHref;
	}
}

function pagination(currentPage, numberOfPages) {
	var delta = 1,
		range = [],
		rangeWithDots = [],
		l;

	range.push(1)
	for (let i = currentPage - delta; i <= currentPage + delta; i++) {
		if (i < numberOfPages && i > 1) {
			range.push(i);
		}
	}
	range.push(numberOfPages);

	for (let i of range) {
		if (l) {
			if (i - l === 2) {
				rangeWithDots.push(l + 1);
			} else if (i - l !== 1) {
				rangeWithDots.push('...');
			}
		}
		rangeWithDots.push(i);
		l = i;
	}

	return rangeWithDots;
}
