<? include('a_settings.php');
 $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0);
//$categorie_sel=mysql_query_assoc("select * from erad_categorii where id_categorie='".$_GET[id_categorie]."'");

$Usr = new UserManagement($DBF['erad_categorii']);  
$vldb=$Usr->get01($_GET[id_categorie]);
$vl=$Usr->DbToForm($vldb);
?>

<div id="mod"  >
<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="90%" height="30" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header"><b>Editare categorie </b></td>
  <td width="10%" height="30" nowrap="nowrap" bgcolor="#efefef" background="img/butbk.jpg"><a href="#" onClick="hide('mod');" class="but">[X] Inchide</a></td>
 </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  

<input type="hidden" name="id_categorie" value="<?=$_GET[id_categorie]?>">
 
 <fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     
<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#efefef">
  <tr>
    <td align="right" bgcolor="#ffffff">Categorie (link):</td>
    <td bgcolor="#ffffff"><input type="text" name="link" size="50" maxlength="255" value="<?=$vl[link]?>" />
      - Apare in meniu. Scurt. Concis. </td>
  </tr>

 <tr>
  <td align="right" width="18%" bgcolor="#ffffff">Denumire categorie (titlu):</td>
  <td width="82%" bgcolor="#ffffff"><input type="text"  id="categorie" name="categorie" size="50" maxlength="255" value="<?=$vl[categorie]?>">
    - Titlul pe larg </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Subcategorie a: </td>
   <td bgcolor="#ffffff">

 
   
<select name="id_parinte"    >  
	<option value="0"> -- Categorie Radacina -- </option>
	<? for($j = 0; $j < count($cat); $j++) {?>
	<option value="<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$vl[id_parinte]) echo "selected"; ?>>   <?=$cat[$j][link]?>   </option>
	<? }?>
</select>	</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 </table>
 </fieldset>
 
 <fieldset class="">
    <legend class="titlu"><b>Optimizare SEO</b></legend> 

<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#efefef">

 <tr>
   <td width="18%" align="right" bgcolor="#ffffff">Description:       </td>
   <td bgcolor="#ffffff"><input type="text" name="description" size="100" value="<?=$vl[description]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Keywords:      </td>
   <td bgcolor="#ffffff"><input type="text" name="keywords" size="100" value="<?=$vl[keywords]?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff"><div id="inp"><input type="submit" name="s_mod_cat" value="Salveaza" class="but"> </div></td>
 </tr>
</table>
 </fieldset>
 
</td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 </div>

