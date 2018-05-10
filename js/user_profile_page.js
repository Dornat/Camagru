function changeEmailNotification() {
	if (event.target.hasAttribute('checked') == true) {
		var notify = 'notify=false';
		event.target.removeAttribute('checked');
	} else {
		var notify = 'notify=true';
		event.target.setAttribute('checked', 'checked');
	}

	let xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			;
		}
	}

	xmlhttp.open('POST', '../change_email_notification.php', true);
	xmlhttp.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(notify);
}
