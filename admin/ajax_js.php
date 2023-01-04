
<script language="javascript" type="text/javascript">
var xmlhttp=false;
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
// JScript gives us Conditional compilation, we can cope with old IE versions.
// and security blocked creation of the objects.
 try {
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 } catch (e) {
  try {
   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
   xmlhttp = false;
  }
 }
@end @*/
  
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	try {
		xmlhttp = new XMLHttpRequest();
	} catch (e) {
		xmlhttp=false;
	}
}
if (!xmlhttp && window.createRequest) {
	try {
		xmlhttp = window.createRequest();
	} catch (e) {
		xmlhttp=false;
	}
}

var xmlhttp=false;
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
// JScript gives us Conditional compilation, we can cope with old IE versions.
// and security blocked creation of the objects.
 try {
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 } catch (e) {
  try {
   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
   xmlhttp = false;
  }
 }
@end @*/

<? for ($k==1; $k<=7; $k++) {?>
var xmlhttp<?=$k?>=false;
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
// JScript gives us Conditional compilation, we can cope with old IE versions.
// and security blocked creation of the objects.
try {
  xmlhttp<?=$k?> = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
  try {
   xmlhttp<?=$k?> = new ActiveXObject("Microsoft.XMLHTTP");
  } catch (E) {
   xmlhttp<?=$k?> = false;
  }
}
@end @*/
 


if (!xmlhttp<?=$k?> && typeof XMLHttpRequest!='undefined') {
try {
xmlhttp<?=$k?> = new XMLHttpRequest();
} catch (e) {
xmlhttp<?=$k?>=false;
}
}
if (!xmlhttp<?=$k?> && window.createRequest) {
try {
xmlhttp<?=$k?> = window.createRequest();
} catch (e) {
xmlhttp<?=$k?>=false;
}
} 

<? }?>

function load_produse(x,  val) {
	xmlhttp1.open("GET", "ajax_produse.php?id_categorie=" + x + "&val=" + val,true);
	xmlhttp1.onreadystatechange=function() {
	 if (xmlhttp1.readyState==4) {
	  document.getElementById('produse').innerHTML = xmlhttp1.responseText;
	  
	   
	 }
	}
	xmlhttp1.send(null);
}

 function load_tematici(x, id_produs,  val) {
	xmlhttp2.open("GET", "ajax_tematici.php?id_tematica=" + x + "&id_produs=" + id_produs+ "&val=" + val,true);
	xmlhttp2.onreadystatechange=function() {
	 if (xmlhttp2.readyState==4) {
	  document.getElementById('tematicisp').innerHTML = xmlhttp2.responseText;
	  
	   
	 }
	}
	xmlhttp2.send(null);
}


 function load_certificari(x, id_brand,  val) {
	xmlhttp3.open("GET", "ajax_certificari.php?id_certificare=" + x + "&id_brand=" + id_brand+ "&val=" + val,true);
	xmlhttp3.onreadystatechange=function() {
	 if (xmlhttp3.readyState==4) {
	  document.getElementById('certificarisp').innerHTML = xmlhttp3.responseText;
	  
	   
	 }
	}
	xmlhttp3.send(null);
}


 function load_preturi(x,  val) {
	xmlhttp4.open("GET", "ajax_preturi.php?id_produs=" + x + "&label=pret" + "&val=" + val,true);
	xmlhttp4.onreadystatechange=function() {
	 if (xmlhttp4.readyState==4) {
	  document.getElementById('pr'+x).innerHTML = xmlhttp4.responseText;
	  
	   
	 }
	}
	xmlhttp4.send(null);
}

function load_preturi_oferta(x,  val) {
	xmlhttp5.open("GET", "ajax_preturi.php?id_produs=" + x + "&label=oferta" + "&val=" + val,true);
	xmlhttp5.onreadystatechange=function() {
	 if (xmlhttp5.readyState==4) {
	  document.getElementById('prof'+x).innerHTML = xmlhttp5.responseText;
	  
	   
	 }
	}
	xmlhttp5.send(null);
}


 function load_categorii(x, id_camp,  val) {
	xmlhttp6.open("GET", "ajax_categorii.php?id_categorie=" + x + "&id_camp=" + id_camp+ "&val=" + val,true);
	xmlhttp6.onreadystatechange=function() {
	 if (xmlhttp6.readyState==4) {
	  document.getElementById('categoriisp').innerHTML = xmlhttp6.responseText;
	  
	   
	 }
	}
	xmlhttp6.send(null);
}

function load_orase(x,  val) {
	xmlhttp7.open("GET", "ajax_orase.php?id_judet=" + x + "&val=" + val,true);
	xmlhttp7.onreadystatechange=function() {
	 if (xmlhttp7.readyState==4) {
	  document.getElementById('orase').innerHTML = xmlhttp7.responseText;
	  
	   
	 }
	}
	xmlhttp7.send(null);
}

 </script>