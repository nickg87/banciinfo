function confirm_del(item, redirect_url) {
	if(confirm('Confirmati stergerea ' + item + '?')) {
		document.location.href = redirect_url;
	}
}

function confirm_del_multi(item, redirect_url) {
	if(confirm('Confirmati stergerea ' + item + '?')) {
	document.getElementById('sterge').value = 1;
	  document.multi.submit();
	} else{
	 
	}

}



function show_large_pic(elem_id, pic_url, w, h) {
	var c;
	dis = "document.getElementById('" + elem_id + "').style.display = 'none'";
	c = '<a href="#" onClick="' + dis + '">';
	c += '<img src="' + pic_url + '" border="0">';
	c += '</a>';
	document.getElementById(elem_id).style.display = '';
	document.getElementById(elem_id).style.width = w;
	document.getElementById(elem_id).style.height = h;
	//document.getElementById(elem_id).display = '';
	document.getElementById(elem_id).innerHTML = c;
	//document.getElementById(elem_id).innerHTML = 'dasdsad';
}


 