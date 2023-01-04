<script language="javascript" type="text/javascript">
 
<? for ($k=1; $k<=1; $k++) {?>
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

function load_taxa(taxa ) {
	xmlhttp1.open("GET", "ajax_taxa.php?taxa=" + taxa  ,true);
	xmlhttp1.onreadystatechange=function() {
	 if (xmlhttp1.readyState==4) {
	  document.getElementById('taxax').innerHTML = xmlhttp1.responseText;
	  
	   
	 }
	}
	xmlhttp1.send(null);
}
 
 
</script>