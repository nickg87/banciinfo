function saveContent() {
	tinyMCE.setContent(document.getElementById('htmlSource').value);
	tinyMCE.closeWindow(window);
}

function onLoadInit() {
	tinyMCEPopup.resizeToInnerSize();

	document.getElementById('htmlSource').value = tinyMCE.getContent(tinyMCE.getWindowArg('editor_id'));

	resizeInputs();

	if (tinyMCE.getParam("theme_advanced_source_editor_wrap", true)) {
		setWrap('soft');
		document.getElementById('wraped').checked = true;
	}
}

function setWrap(val) {
	var s = document.getElementById('htmlSource');

	s.wrap = val;

	if (tinyMCE.isGecko) {
		var v = s.value;
		var n = s.cloneNode(false);
		n.setAttribute("wrap", val);
		s.parentNode.replaceChild(n, s);
		n.value = v;
	}
}

function toggleWordWrap(elm) {
	if (elm.checked)
		setWrap('soft');
	else
		setWrap('off');
}

var wHeight=0, wWidth=0, owHeight=0, owWidth=0;

function resizeInputs() {
	var el = document.getElementById('htmlSource');

	if (!tinyMCE.isMSIE) {
		 wHeight = self.innerHeight-80;
		 wWidth = self.innerWidth-16;
	} else {
		 wHeight = document.body.clientHeight - 80;
		 wWidth = document.body.clientWidth - 16;
	}

	el.style.height = Math.abs(wHeight) + 'px';
	el.style.width  = Math.abs(wWidth) + 'px';
}

