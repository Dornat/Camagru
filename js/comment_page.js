function deleteComment() {
	event.target.parentNode.parentNode.removeChild(event.target.parentNode);
	deleteCommentFromDb(event.target.id);

	function deleteCommentFromDb(commentId) {
		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				;
			}
		}

		let postMessage = 'comment_id=' + commentId;
		xmlhttp.open('POST', '../delete_comment_from_db.php', true);
		xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(postMessage);
	}
}

function likeClick() {
	let imageId = event.target.id.split('/')[0];
	let currentUserId = event.target.id.split('/')[1];
	let likeCount = parseInt(
		event.target.getElementsByTagName('span')[0].innerHTML
	);

	if (currentUserId == 0) {
		alert('Please Login or Sign up to do stuff');
		return ;
	}

	if (event.target.classList.contains('liked') === true) {
		event.target.classList.remove('liked');
		event.target.getElementsByTagName('span')[0].innerHTML = likeCount - 1;
		unlikeImageFromDb(imageId, currentUserId);
	} else {
		event.target.classList.add('liked');
		event.target.getElementsByTagName('span')[0].innerHTML = likeCount + 1;
		likeImageInDb(imageId, currentUserId);
	}
}

function likeImageInDb(imageId, currentUserId) {
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

function unlikeImageFromDb(imageId, currentUserId) {
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
