function addComment() {
	console.log(event.target.parentNode.getElementsByTagName('textarea')[0].value);
	console.log(event.target.id);
	console.log(getImageId());

	function getImageId() {
		let getString = window.location.search.substr(1);
		let getQueries = getString.split('&');
		return parseInt(getQueries[0].replace(/^\D+/g, ''));
	}
}
