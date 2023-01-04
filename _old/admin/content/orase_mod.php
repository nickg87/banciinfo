<?

$id_oras=$_GET[id_oras];

 if(isset($_POST['s_mod_cat'])) {
$Usr = new UserManagement($DBF['erad_orase']);  

	$vl = array();
	$vl = $_POST;
 
   	$vldb = $Usr->FormToDb($vl);

	$error = array();
	$Usr->vld($vldb, $error);

	$ins = $Usr->update($vldb, $id_oras);
 
		if($ins) {
	 
 			echo js_redirect($scr.'?section='.$mnp1.'_0&id_judet='.$_POST[id_parinte].'&msg=Modificare efectuata.');
		} 
}

$Usr = new UserManagement($DBF['erad_orase']);  
$vldb=$Usr->get01($_GET[id_oras]);
 
$vl=$Usr->DbToForm($vldb);

?>
 
 
<? //////////////form validation
$form_name="orase_mod";
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


<br />

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_oras=<?=$id_oras?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );"> 

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
   <td width="100%" height="30" bgcolor="#efefef">
  
 <fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Denumire oras </td>
  <td bgcolor="#ffffff"><input type="text"  id="oras" name="oras" size="50"   value="<?=$vl[oras]?>"></td>
 </tr>
  <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
 
<? $judete = mysql_query_assoc ("select * from erad_judete order by judet asc");  ?>
 <? if (count($judete)>0) {?>

 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Judet:</td>
  <td bgcolor="#ffffff">
		 
               <select name="id_parinte" class="content" style="width:300px;"  >
                <option value="">-- Alegeti judetul --</option>
                 <? for($j = 0; $j < count($judete); $j++) {?>
                 <option value="<?=$judete[$j][id_judet]?>"  <? if ($judete[$j][id_judet]==$vl[id_parinte]) echo "selected"; ?>>
                 <?=$judete[$j][judet]?>
                 </option>
                 <? }?>
               </select>
  </td>
 </tr>
 <? } ?>
 
  

 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
 
 <tr>
 <td align="right" width="150" bgcolor="#ffffff">Principal: </td>
  <td bgcolor="#ffffff">
  	<input type="checkbox" name="principal" value="1" <?=checked($vl[principal], 1)?>>
  	<font style="font-size:9px; font-family:tahoma;">(apare pe site in footer)</font>  </td>
 </tr>
 
 <tr>
 
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_mod_cat" value="Salveaza" class="but" /></td>
 </tr>
 </table>
 </fieldset>
 
 
   </td>
   </tr>
   </table>
</form>