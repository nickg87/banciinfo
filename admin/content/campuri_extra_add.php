<?


if(isset($_POST['s_add'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_campuri']);  


	$vl = array();
	$vl = $_POST;
if (isset($vl[activ])) $vl[activ]=1; else $vl[activ]=0;
   
		$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 
	$id_camp=get_last_mysql_id('erad_campuri');
	 
foreach ($vl['id_categorie'] as $cat=>$val) 
		{
		 
	 
		 if($val<>'') mysql_query("INSERT into erad_campuri_categorii set id_camp='".$id_camp."',   id_categorie='".$val."'"); 
		 
		
		}
	
		if($ins) {
		update_order('erad_campuri', 'id_camp', 'ord', "");
  	echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Adaugare efectuata.');
		}
	}
}
unset ($_SESSION[szs]);
?>
 
 
 

 <? include('menu_sub.php'); ?> 


 
<? //////////////form validation
$form_name="campuri";
include('validari_formulare.php');
include('validari_js.php');
?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  
  </tr>
</table>
<br />

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  
   <form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );">
<fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Denumire camp  </td>
  <td colspan="2" bgcolor="#ffffff">
  <input type="text"  id="denumire_camp" name="denumire_camp" size="50"   value="<?=$denumire_camp?>">  </td>
 </tr>


 
 <? $categorii = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $categorii, 0,0);  ?>
 <? if (count($categorii)>0) {?>
		 <tr>
		   <td align="right"bgcolor="#ffffff"  nowrap >Categorii produse</td>
		   <td width="409" bgcolor="#ffffff"  >

			  
  <select name="categ"   style="width:200px;"   >  
	 
	<? for($j = 0; $j < count($categorii); $j++) {
	
	$copii=mysql_query_scalar("select count(id_categorie) from erad_categorii where id_parinte='".$categorii[$j][id_categorie]."'");
	?>
	
     
    <option value="<?=$categorii[$j][id_categorie]?>"  <? if ($categorii[$j][id_categorie]==$vl[id_categorie]) echo "selected"; ?>>   <?=$categorii[$j][link]?>   </option>
   
    <? }?>
    </select>
    
</select>		
<input type="button" value="Asigneaza" class="but" onclick="load_categorii(categ.options[categ.selectedIndex].value,0, 'add')" />	   </td>
		   <td width="563" bgcolor="#ffffff"  >
	 Categorii selectate:<br />
	 <span id="categoriisp"><input type="hidden" name="id_categorie[]" id="categoria"   /></span>	   
	
	
		 <? if($id_camp) { ?>
     <script>load_categorii(0,<?=$id_camp?>, 'show');</script>
     <? } ?>		   </td>
	    </tr>

 <? }?>
 <tr>
   <td align="right" bgcolor="#ffffff">Activ</td>
   <td colspan="2" bgcolor="#ffffff">
  <input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?>>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td colspan="2" bgcolor="#ffffff"><input type="submit" name="s_add" value="Salveaza" class="but"></td>
 </tr>
 </table>
 </fieldset>
 
   </form>   </td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 
 