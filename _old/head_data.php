<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title> <?=$title?>   </title>

<?=$hf[0][gw];?> 

<!--[if lte IE 6]>
	<script type="text/javascript" src="supersleight-min.js"></script>
<![endif]--> 

<!-- start favicon -->

<link href="<?=SITE_URL?>favicon.ico" rel="SHORTCUT ICON">
<link rel="icon" href="<?=SITE_URL?>favicon.ico" type="image/x-icon" />

<!-- end of favicon -->
 
<link href="<?=SITE_URL?>rss.php" rel="alternate" type="application/rss+xml" title="<?=SITE_NAME?> RSS FEED" /> 

<meta name="keywords" content="<?=$keywords?>">
<meta name="description" content="<?=$description?>">
 
 
<style type="text/css">
@import "style/style.css";
</style>

 
  
 
<? if (  $_GET[gal]==1) {?>
<script type="text/javascript" src="<?=SITE_URL?>js/prototype.js"></script>
<script type="text/javascript" src="<?=SITE_URL?>js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="<?=SITE_URL?>js/lightbox.js"></script>
<link rel="stylesheet" href="<?=SITE_URL?>style/lightbox.css" type="text/css" media="screen" />

<? }?>


<script  type="text/javascript" language="javascript">

function show_x(x) {
 
document.getElementById(x).disabled=false; 
 document.getElementById(x).style.display = '';
 
 }
function hide_x(x) {
 document.getElementById(x).disabled=true; 
 document.getElementById(x).style.display = 'none';
 
  
}


function hide_all() {

<?  
 for ($j=0; $j<count($pic_p_c); $j++) {?>
 	hide_x('px<?=$pic_p_c[$j][id_pic]?>');
  <? 	} ?>
 
}
 

 function show_promo(x) {

<? for ($i=0;$i<count($promo); $i++) {?>
hide_x('promos<?=$i?>');
<? }?>
show_x(x);

}
  
</script>


 <!--///////////////////////////             Start Promo SLIDER  NOU            ///////////////////////////--> 

<script language="javascript" type="text/javascript" src="js/jquery.js"></script> 
 <? if (  $index==1 ) {?>

<link rel="stylesheet" type="text/css" href="style/style_slide.css" />
<script language="javascript" type="text/javascript" src="js/jquery.easing.js"></script>
<script language="javascript" type="text/javascript" src="js/script.js"></script>
    
<script type="text/javascript">
 $(document).ready( function(){	
		var buttons = { previous:$('#jslidernews3 .button-previous') ,
						next:$('#jslidernews3 .button-next') };
  
		var _complete = function(slider, index){ 
								$('#jslidernews3 .slider-description').animate({height:0});
								slider.find(".slider-description").animate({height:100}) 
						};							;
	 	$('#jslidernews3').lofJSidernews( { interval : 2000,
												direction		: 'opacity',	
											 	easing			: 'easeOutBounce',
												duration		: 1200,
												auto		 	: 'true',
												mainWidth:990,
												buttons			: buttons,
												onComplete:_complete } );	
	});
</script>


<!-- hover slide -->

<script type="text/javascript" language="JavaScript">
<!-- Copyright 2006,2007 Bontrager Connection, LLC
// http://bontragerconnection.com/ and http://www.willmaster.com/
// Version: July 28, 2007
var cX = 0; var cY = 0; var rX = 0; var rY = 0;
function UpdateCursorPosition(e){ cX = e.pageX; cY = e.pageY;}
function UpdateCursorPositionDocAll(e){ cX = event.clientX; cY = event.clientY;}
if(document.all) { document.onmousemove = UpdateCursorPositionDocAll; }
else { document.onmousemove = UpdateCursorPosition; }
function AssignPosition(d) {
if(self.pageYOffset) {
	rX = self.pageXOffset;
	rY = self.pageYOffset;
	}
else if(document.documentElement && document.documentElement.scrollTop) {
	rX = document.documentElement.scrollLeft;
	rY = document.documentElement.scrollTop;
	}
else if(document.body) {
	rX = document.body.scrollLeft;
	rY = document.body.scrollTop;
	}
if(document.all) {
	cX += rX; 
	cY += rY;
	}
d.style.left = (cX+10) + "px";
d.style.top = (cY+10) + "px";
}
function HideContent(d) {
if(d.length < 1) { return; }
document.getElementById(d).style.display = "none";
}
function ShowContent(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
dd.style.display = "block";
}
function ReverseContentDisplay(d) {
if(d.length < 1) { return; }
var dd = document.getElementById(d);
AssignPosition(dd);
if(dd.style.display == "none") { dd.style.display = "block"; }
else { dd.style.display = "none"; }
}
//-->
</script>




<? }?>

	 
 
 <!--///////////////////////////             END Promo SLIDER  NOU            ///////////////////////////-->  

 
<?=$hf[0][headers];?>



<? include "ajax_js.php";?>	



 
<script src="<?=SITE_URL?>AC_RunActiveContent.js" type="text/javascript"></script>
 

<?=$hf[0][ga];?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=137261696349537";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    /*
     * This sample shows how to create a Custom Search Control.  By default, it
     * will allow you to add a search box to your page that searches your site.
     * Optionally, you can give it a CSE ID (http://www.google.com/coop/cse/) to
     * have it search sites you specify
    */
    
    google.load("search", "1", {style: google.loader.themes.MINIMALIST});
    
    function OnLoad() {
      // Create a custom search control that uses a CSE restricted to code.google.com
      var customSearchControl = new google.search.CustomSearchControl('partner-pub-9350127359282666:5211972008');
    
      // Draw the control in content div
      customSearchControl.draw('google_search'); 
      
      // run a query
	  //customSearchControl.execute('credite bancare');
    }
    google.setOnLoadCallback(OnLoad);
    </script>


 

<!-- --------- PopUp News si FB ------ -->
 
 <script type="text/javascript" src="<?=SITE_URL?>js/jqModal.js"></script>
 
<script type="text/javascript">
 
  function showFB()  {
  $("#dialog").hide();
  $("#pop_facebook").show();
  	}
	
  function hidePP()  {
  $("#dialog").fadeOut(400);
  $(".jqmOverlay").fadeOut(400);
  	}
	
	
  function hideFB()  {
  $("#pop_facebook").fadeOut(400);
  $(".jqmOverlay").fadeOut(400);
  location.reload()
  	}
</script> 

 
<script type="text/javascript">
 
$().ready(function() {
  $('#dialog').jqm();
});

</script>

<style media="screen">
/* jqModal base Styling courtesy of;
  Brice Burgess <bhb@iceburg.net> */

/* The Window's CSS z-index value is respected (takes priority). If none is supplied,
  the Window's z-index value will be set to 3000 by default (in jqModal.js). You
  can change this value by either;
    a) supplying one via CSS
    b) passing the "zIndex" parameter. E.g.  (window).jqm({zIndex: 500}); */
  
.jqmWindow {
    display: none;
	position:fixed;
	margin:0 auto;
	margin-top:-300px;
	margin-left:25%;
    width: auto;
	height:auto;
    color: #333;
}

.jqmOverlay { background-color: #000; }

/* Fixed posistioning emulation for IE6
     Star selector used to hide definition from browsers other than IE6
     For valid CSS, use a conditional include instead */
* html .jqmWindow {
     position: absolute;
     top: expression((document.documentElement.scrollTop || document.body.scrollTop) + Math.round(20 * (document.documentElement.offsetHeight || document.body.clientHeight) / 100) + 'px');
}

</style>
 

<?
$prdf = mysql_query_assoc("SELECT * FROM erad_produse 
left join erad_um on erad_um.id_um=erad_produse.id_um
left join erad_brands on erad_brands.id_brand=erad_produse.id_brand
WHERE id_produs = '".$id_produs."'  and erad_produse.activ=1");
$descriereFB=strip_tags(substr($prdf[0][descriere_scurta],0,200));
$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$id_produs."' order by prim desc"); 
?>
 
<!-- Facebook OG -->
<meta property="og:description" content="<?=$descriereFB?>" />
<meta property="og:image" content="<?=PICS_URL_MEDIU.$pic[0][pic]?>" />
<meta property="og:type" content="product"/>
<meta property="og:url" content="<?=curPageURL();?>"/>
<meta property="og:site_name" content="<?=SITE_NAME?>"/>
<!-- END Facebook OG -->
 
</head>

 <?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>