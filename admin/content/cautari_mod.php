<?

$id_keyword=$_GET[id_keyword];
$Usr = new UserManagement($DBF['erad_keywords']);  
 
$vldb=$Usr->get01($id_keyword);
$vl=$Usr->DbToForm($vldb);

if(isset($_POST['s_mod_cautare'])  ) {
 
 
   	$vldb = $Usr->FormToDb($vl);
 
 
	$ins = mysql_query("update erad_keywords set keyword='".$_POST[keyword]."', activ='".$_POST[activ]."' where id_keyword='".$id_keyword."' ");


	if($ins) {
	
	 echo js_redirect($src.'?section='.$mnp1.'_7');
	// echo print_r($ins);
			
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
 
}

 
?>



 
<? //////////////form validation
$form_name="cautari_mod";
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

 

<fieldset class="" style="width:94%;">
    <legend class="titlu"><b>Date cautare</b></legend>     
 

<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>&id_keyword=<?=$id_keyword?>" method="post"   onSubmit="return validate_form_<?=$form_name?> ( );">
 <input type="hidden" name="zone" value="cautari" />
 
 <table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  <tr>
  <td align="right" width="12%" bgcolor="#ffffff">Secventa cautare: </td>
  <td width="88%" bgcolor="#ffffff"><input type="text" name="keyword" size="50" maxlength="255" value="<?=$vl[keyword]?>"></td>
 </tr>
  
 
 
 <tr>
   <td align="right" bgcolor="#ffffff">Activa:
       <?=$error['activ']?></td>
   <td bgcolor="#ffffff"><input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?> />
       <font style="font-size:9px; font-family:tahoma;">(apare pe site)</font> </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_mod_cautare" value="Salveaza" class="but" /></td>
 </tr>
</table>
 
 
</form>
