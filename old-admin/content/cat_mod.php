<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

 $id_categorie=$_GET['id_categorie'];	
 



if(isset($_POST['s_mod_cat'])) {
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
$ins = $Usr->update($vldb, $id_categorie);
 
		if($ins) {
		
			update_order('erad_categorii', 'id_categorie', 'ord', "AND id_parinte = '".$vl[id_parinte]."'");
			echo js_redirect($scr.'?section='.$mnp1.'_0');
		}
	}
}






$Usr = new UserManagement($DBF['erad_categorii']);  
$vldb=$Usr->get01($_GET[id_categorie]);
$vl=$Usr->DbToForm($vldb);




  $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0);

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


 <form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>&id_categorie=<?=$_GET[id_categorie]?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );">

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="90%" height="30" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header"><b>Editare categorie </b></td>
 
 </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  

 
 
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
	<? if ($cat[$j][id_categorie]<>$id_categorie) { ?><option   value="<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$vl[id_parinte]) echo "selected"; ?> >   <?=$cat[$j][link]?>   </option> <? } ?>
	<? }?>
</select>	</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_mod_cat" value="Salveaza" class="but" /></td>
 </tr>
 </table>
 </fieldset>
 
  
 
</td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 
 </form>