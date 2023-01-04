<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$year = date('Y');
$month = date('m');
$day = date('d');

if($_SESSION[tab]=='') $_SESSION[tab]=1; else  $_SESSION[tab]=$_GET[tab];


if(isset($_POST['s_add'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_pagini']);  



	$vl = array();
	$vl = $_POST;
if (isset($vl[lateral])) $vl[lateral]=1; else $vl[lateral]=0;
if (isset($vl[principal])) $vl[principal]=1; else $vl[principal]=0;
if (isset($vl[home])) $vl[home]=1; else $vl[home]=0;

    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 $id_page=get_last_mysql_id('erad_pagini');

		if($ins) {
		 update_order('erad_pagini', 'id_page', 'ord','and id_meniu='.$vl[id_meniu]); 
 			echo js_redirect($scr.'?section='.$mnp1.'_6&tab=2&gal=2&id_page='.$id_page);
		}
	}
}

?>
 
 <? //////////////form validation
$form_name="news";
include('validari_formulare.php');
include('validari_js.php');
?>


 <? include('menu_sub.php'); ?> 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
  </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>

<table width="500" align="center" cellpadding="5" cellspacing="1"  >
 <tr>
  <td height="30" colspan="2" align="center"    class="titlu_header" style="border-bottom:2px solid #ccc;">
<? if($_SESSION[tab]==1 or $_GET[id_page]<>'') {?> <a href="<?=$scr?>?section=<?=$section?>&tab=1&id_page=<?=$_GET[id_produs]?>" <? if($_SESSION[tab]<>1) {?>class="but" <? } else {?>class="but_pres" <? } ?>  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> <? } else { ?><span class="but_pres"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <? }?> 
<? if($_SESSION[tab]==2 or $_GET[id_page]<>'' ) {?> <a href="<?=$scr?>?section=<?=$section?>&tab=2&id_page=<?=$_GET[id_produs]?>"  <? if($_SESSION[tab]<>2) {?>class="but" <? } else {?>class="but_pres" <? } ?>  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imagini&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> <? } else { ?><span class="but_pres"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imagini&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <? }?> 
<? if($_SESSION[tab]==3 or $_GET[id_page]<>'') {?> <a href="<?=$scr?>?section=<?=$section?>&tab=3&id_page=<?=$_GET[id_produs]?>"  <? if($_SESSION[tab]<>3) {?>class="but" <? } else {?>class="but_pres" <? } ?>  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fisiere&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> <? } else { ?><span class="but_pres"  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fisiere&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <? }?> 
</td>
 </tr>
</table>

<fieldset class="" style="width:94%;">
    <legend class="titlu"><b>Date</b></legend>  
<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post"  onSubmit="return validate_form_<?=$form_name?> ( );">
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF" align="center">
 
 <tr>
  <td align="center" bgcolor="#ffffff" colspan="2">&nbsp;<?=$_GET['msg']?></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Link meniu:</td>
   <td bgcolor="#ffffff">
<?    $meniuri = mysql_query_assoc("select * from erad_meniu_set order by link_meniu");?>

	<select name="id_meniu">
	<? foreach ($meniuri as $mnu) {?>
	<option value="<?=$mnu[id_meniu]?>"><?=$mnu[link_meniu]?></option>
	<? }?>
	</select>   </td>
 </tr>
 <tr>
  <td width="13%" align="right" bgcolor="#ffffff"><strong>Titlu    </strong></td>
  <td bgcolor="#ffffff"><input type="text" name="titlu_stire" size="70" maxlength="255" value="<?=$titlu_stire?>"></td>
 </tr>

 <tr>
 
   <td align="right" bgcolor="#ffffff"><strong>Sapou</strong><br />
     (scurta fraza pt captarea atentiei publicului) </td>
   <td bgcolor="#ffffff"><font style="font-size: 3px;"><br />
     </font>
       <textarea name="sapou"  rows="5" style="width: 80%;"><?=$sapou?></textarea>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"><strong>Body</strong> </td>
   <td bgcolor="#ffffff"><font style="font-size: 3px;"><br />
     </font>
      <textarea name="body"  rows="20" style="width: 80%;"><?=$body?></textarea>   </td>
   </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff">
   <input type="submit" name="s_add" value="Salveaza" class="but">  </td>
 </tr>
</table>
</form>
</fieldset>