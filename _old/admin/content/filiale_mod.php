<?

$empty = '<br /><font color=red style="font-size: 9px;">camp lipsa</font>';
$id_filiala=$_GET[id_filiala];


if(isset($_POST['s_mod_cat'])) {
$empty = '<br /><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_filiale']);  


	$vl = array();
	$vl = $_POST;

 
   	$vldb = $Usr->FormToDb($vl);

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
	$ins = $Usr->update($vldb, $id_filiala);
 
		if($ins) {
		update_order('erad_filiale', 'id_filiala', 'ord');
 			echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Modificare efectuata.');
		} 
	}
}


$Usr = new UserManagement($DBF['erad_filiale']);  
$vldb=$Usr->get01($_GET[id_filiala]);
 
$vl=$Usr->DbToForm($vldb);

?>
 
 
<? //////////////form validation
$form_name="filiale_mod";
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

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_filiala=<?=$id_filiala?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );"> 

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
   <td width="100%" height="30" bgcolor="#efefef">
  
 <fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Denumire filiala </td>
  <td bgcolor="#ffffff"><input type="text"  id="denumire_filiala" name="denumire_filiala" size="50"   value="<?=$vl[denumire_filiala]?>"></td>
 </tr>
  <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>

 <tr>
   <td align="right" bgcolor="#ffffff">Descriere filiala</td>
   <td bgcolor="#ffffff">
   <textarea name="descriere_filiala" class="content" rows="3" style="width: 700; height: 150;"><?=$vl[descriere_filiala]?></textarea></td>
 </tr>

 <? $tematici =mysql_query_assoc("select id_tematica, denumire_institutie from erad_tematici "); ?>
 <? if (count($tematici)>0) {?>
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Institutia de care apartine</td>
  <td bgcolor="#ffffff">
		 
               <select name="id_institutie" class="content" style="width:300px;">
                <option value="">-- Alegeti institutia --</option>
                 <? for($j = 0; $j < count($tematici); $j++) {?>
                 <option value="<?=$tematici[$j][id_tematica]?>"  <? if ($tematici[$j][id_tematica]==$vl[id_institutie]) echo "selected"; ?>>
                 <?=$tematici[$j][denumire_institutie]?>
                 </option>
                 <? }?>
               </select>
  </td>
 </tr>
 <? } ?>
 
 
<? $judete = mysql_query_assoc ("select * from erad_judete order by judet asc");  ?>
 <? if (count($judete)>0) {?>

 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Judet:</td>
  <td bgcolor="#ffffff">
		 
               <select name="id_judet" class="content" style="width:300px;"   onchange="load_orase(this.options[this.selectedIndex].value, 0)"   >
                <option value="">-- Alegeti judetul --</option>
                 <? for($j = 0; $j < count($judete); $j++) {?>
                 <option value="<?=$judete[$j][id_judet]?>"  <? if ($judete[$j][id_judet]==$vl[id_judet]) echo "selected"; ?>>
                 <?=$judete[$j][judet]?>
                 </option>
                 <? }?>
               </select>
  </td>
 </tr>
 <? } ?>
 
 
 
  <tr>
   <td align="right" bgcolor="#ffffff">Oras:</td>
   <td bgcolor="#ffffff"> <span id="orase"></span>&nbsp;<br/>
   <? $ors=mysql_query_assoc("select id_oras from erad_orase where id_oras='".$vl[id_oras]."' "); ?>
   <script>load_orase(<?=$vl[id_judet]?>, <?=$ors[0][id_oras]?>);</script>
   </td>
 </tr>
 

 
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Adresa: </td>
  <td bgcolor="#ffffff"><input type="text"  id="adresa" name="adresa" size="50"   value="<?=$vl[adresa]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Telefon: </td>
  <td bgcolor="#ffffff"><input type="text"  id="telefon" name="telefon" size="50"   value="<?=$vl[telefon]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Fax: </td>
  <td bgcolor="#ffffff"><input type="text"  id="fax" name="fax" size="50"   value="<?=$vl[fax]?>"></td>
 </tr>
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Email: </td>
  <td bgcolor="#ffffff"><input type="text"  id="email" name="email" size="50"   value="<?=$vl[email]?>"></td>
 </tr>
 
 <tr>
 <td align="right" width="150" bgcolor="#ffffff">Activ: </td>
  <td bgcolor="#ffffff">
  	<input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?>>
  	<font style="font-size:9px; font-family:tahoma;">(apare pe site)</font>  </td>
 </tr>
 
 <tr>
 
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_mod_cat" value="Salveaza" class="but" /></td>
 </tr>
 </table>
 </fieldset>
 
 
</form>   </td>
   </tr>
 <tr>
   <td height="30" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  