<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_categorii']);  



if(isset($_POST['s_add_cat'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_categorii']);  


	$vl = array();
	$vl = $_POST;

$cat = mysql_query_assoc("SELECT * FROM erad_categorii WHERE id_categorie = '".$vl[id_parinte]."' ");
$vl[lvl]=$cat[0][lvl]+1;

   	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 
		if($ins) {
		
			update_order('erad_categorii', 'id_categorie', 'ord', "AND id_parinte = '".$vl[id_parinte]."'");
			echo js_redirect($scr.'?section='.$mnp1.'_0');
		}
	}
}

?>
 
<? //////////////form validation
$form_name="categorie_add";
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

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="90%" height="30" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header"><b>Adauga categorie </b></td>
  
 </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  
   <form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );">
<fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 <tr>
   <td width="18%" align="right" bgcolor="#ffffff">Categorie (link):</td>
   <td bgcolor="#ffffff"><input type="text" name="link" size="50" maxlength="255" value="<?=$link?>" />
     - Apare in meniu. Scurt. Concis. </td>
 </tr> 
 <tr>
  <td align="right" bgcolor="#ffffff">Denumire categorie (titlu):</td>
  <td width="82%" bgcolor="#ffffff"><input type="text"  id="categorie" name="categorie" size="50" maxlength="255" value="<?=$categorie?>">
    - Titlul pe larg </td>
 </tr>

 <tr>
   <td align="right" bgcolor="#ffffff">Subcategorie a: </td>
   <td bgcolor="#ffffff">

  <? $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0); ?>
   
<select name="id_parinte"    >  
	<option value="0"> -- Categorie Radacina -- </option>
	<? for($j = 0; $j < count($cat); $j++) {?>
	<option value="<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$_POST[id_parinte]) echo "selected"; ?>>   <?=$cat[$j][link]?>   </option>
	<? }?>
</select>	</td>
 </tr>
 <tr bgcolor="#efefef">
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_add_cat" value="Salveaza" class="but" /></td>
 </tr>
 </table>
 </fieldset>
 
<strong> </strong>
   </form>   </td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 