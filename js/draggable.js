var startX = 0;
var startY = 0;
var offsetX = 0;
var offsetY = 0;
var dragElement = 0;



initDragDrop();

function initDragDrop() {
	document.onmousedown = onMouseDown;
	document.onmouseup = onMouseUp;
}

function onMouseDown(e) {
	var target = e.target;

	if ((e.button == 1 && window.event != null ||
		e.button == 0) && target.className == 'template-img') {
		startX = e.clientX;
		startY = e.clientY;
		offsetX = extractNumber(target.style.left);
		offsetY = extractNumber(target.style.top);
		oldZIndex = target.style.zIndex;
		dragElement = target;
		document.onmousemove = onMouseMove;
		document.body.focus();
		document.onselectstart = function () { return false; };
		target.ondragstart = function() { return false; };
		return false;
	}
}

function extractNumber(value) {
	var n = parseInt(value);

	return n == null || isNaN(n) ? 0 : n;
}

function onMouseMove(e) {
	if (e == null) {
		var e = window.event;
	}
	dragElement.style.left = (offsetX + e.clientX - startX) + 'px';
	//console.log('e.clientX: ' + e.clientX);
	dragElement.style.top = (offsetY + e.clientY - startY) + 'px';
	//console.log('e.clientY: ' + e.clientY);
}

function onMouseUp(e) {
	if (dragElement != null) {
		document.onmousemove = null;
		document.onselectstart = null;
		dragElement.ondragstart = null;
		dragElement = null;
	}
}
