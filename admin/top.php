<?

  function get_link_produs($id, $produs) {
	return SITE_URL . url_shape(strtolower($produs), 200) . '-p' . $id . '.html';
}
function get_link_cat($id, $cat, $page = 0) {
	return SITE_URL . url_shape(strtolower($cat), 200) . '-c' . $id . '-p' . $page . '.html';
}


?>

<!-- TINY MCE -->

<HTML>
<HEAD>
<title>   <?=SITE_NAME?> :: Admin - <?= get_section_name($section)?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style media="all" type="text/css">
	@import "style.css";
</style>
<script language="javascript" type="text/javascript">
   function PopupPic(sPicURL) { 
     window.open( "<?=SITE_URL?>/admin/poza_mare.php?p="+sPicURL, "", "resizable=1,HEIGHT=400,WIDTH=500"); 
   } 
</script>
 
 
<? if ( $section=="1_1" or $section=="1_2"   or $section=="1_5"  or $section=="4_4"   or $section=="4_5"  
or $section=="6_4" or $section=="6_5" 
or $section=="7_1" or $section=="2_1" or $section=="6_2"  or $section=="6_1"  or $section=="7_2" 
or $section=="2_2") 
{?>


 <script language="javaScript" type="text/javascript" src="tinyMCE/tiny_mce.js"></script>
 <script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,autosave,advlist,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,imagemanager,filemanager",

	// Theme options
	theme_advanced_buttons1 : " bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|, fontsizeselect",
	theme_advanced_buttons2 : " search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor ",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "bottom",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Example content CSS (should be your site CSS)
	//content_css : "../style/style.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	},

	autosave_ask_before_unload : false
});
</script>


<? }?>


<SCRIPT LANGUAGE="JavaScript">
function popUp(URL) {
day = new Date();
aid = day.getTime();
 eval("page" + aid + " = window.open(URL, '" + aid + "', 'toolbar=0,scrollbars=1,location=0 ,statusbar=0,menubar=0,resizable=1,width=900 ,left = 100,top = 50');");
 

}
</script>

 
<SCRIPT LANGUAGE="JavaScript">
 
function check_all(x,y)
{
	var chkboxes = document.multi.produse;
	for (i = x; i <=y; i++)
		chkboxes[i].checked = true ;
	return false;
}

function uncheck_all(x,y)
{
	var chkboxes = document.multi.produse;
	for (i = x; i <=y; i++)
		chkboxes[i].checked = false ;
	return false;
}
</script>

 

<script type="text/javascript" src="js_scripts.js"></script>

<link rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

 

<script language="javascript">

function show_x(x) {
 
document.getElementById(x).disabled=false; 
 document.getElementById(x).style.display = '';
 
 }
function hide_x(x) {
 document.getElementById(x).disabled=false; 
 document.getElementById(x).style.display = 'none';
  
}

function hide_all() {

<? $ki = 0;
foreach($MENU2 as $key => $val) {?>
 	hide_x('p<?=$ki?>');
  <? $ki++;	} ?>
 
}
function show_all() {

<? $ki = 0;
foreach($MENU2 as $key => $val) {?>
 	show_x('p<?=$ki?>');
  <? $ki++;	} ?>
 
}

 
</script>

 
 
<? include "ajax_js.php";?>  


 
 
</HEAD>

<body style="padding:0px;margin:0px;" <? //if($_SESSION['csm_title'] == 'Add Page') { echo 'onload="areaedit_init()"'; } ?>>

<div id="div_abs" style="position: absolute; display: none; background-color: #ffffff; width: 80%; height: 80%; padding: 0;">
</div>


<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr style="  border-style: solid; border-width:1px;	  ">
    <td height="27" align="center" valign="middle" bgcolor="#215D8A" class="titlu_header"  style="background-image:url(img/top.jpg); background-repeat: no-repeat;"  >
	<div style="float:left; width:300px; "><b><?=SITE_NAME?></b></div>
	 
  
      <div style="float:right; width:220px; padding-right:40px" class="content_white" >
  <a href="<?=SITE_URL?>" class="white" ><strong>Logout</strong></a> 
  &nbsp;|&nbsp; 
    Current login:   <strong>Administrator</strong>   </div></td>
  </tr>
</table>
