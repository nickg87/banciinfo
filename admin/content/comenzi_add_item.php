<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';
$invalid = '<br><font color=red style="font-size: 9px;">camp invalid</font>';
$id_comanda=$_GET[id_comanda];

$id_categorie=$_GET[id_categorie];
 
if (isset ($_POST[s_add])) {

		if ($_POST[id_produs]<>'')  {
		
		$prd=mysql_query_assoc("select * from erad_produse where id_produs='".$_POST[id_produs]."'");
	
	if($prd[0][pret_oferta]>0) $pret=$prd[0][pret_oferta]; else  $pret=$prd[0][pret];
		 
		$ins=mysql_query("insert into erad_cart set 
		id_comanda='".$id_comanda."',
		id_produs='".$id_produs."',
		cant='".$_POST[cant1]."',
		pret_unitar='".$pret."',
		pret_total='".$pret*$_POST[cant1]."',	
		
		produs= '".$prd[0][produs]."'
		
		");
		 
		 
		 } else {
	
		 
		$ins=mysql_query("insert into erad_cart set 
		id_comanda='".$id_comanda."',
		id_produs='0',
		cant='".$_POST[cant2]."',
		pret_unitar='".$_POST[pret_unitar]."',
		pret_total='".$_POST[pret_unitar]*$_POST[cant2]."',	
		produs= '".$_POST[produs]."'
		
		");
		 
		 }		 

if ($ins) {
$tc=0;

$pret_total_comanda = mysql_query_assoc("SELECT SUM(pret_total) as total FROM erad_cart WHERE id_comanda = '".$id_comanda."'");
		# calcul total comanda
		  $tc += $pret_total_comanda[0][total]; 
		 
		
	# update pret comanda
	 
	$upd = mysql_query("UPDATE erad_comenzi SET total_comanda = '".$tc."' WHERE id_comanda = '".$id_comanda."'");

echo js_redirect($scr .'?section='.$mnp1.'_1&id_comanda=' . $id_comanda . '&msg=Comanda a fost modificata');
}

}

?>




<? include('menu_sub.php'); ?>


 


 
<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
 
  </tr>
</table>
<br />

 

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data"> 
 

 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
 <td bgcolor="#FFFFFF"><input type="hidden" name="zone" value="produse" /> 
  <fieldset class="">
    <legend class="titlu"><b>Produs din lista </b></legend> 
	
	
		<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
		  <tr>
            <td align="right" bgcolor="#ffffff">Colectia: </td>
		    <td width="966" bgcolor="#ffffff">
			<?  $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0); ?>
                <select name="id_categorie" onchange="window.open(this.options[this.selectedIndex].value,'_self')"    >
                 <option value="<?=$src?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>">---------------------</option>
				  <? for($j = 0; $j < count($cat); $j++) {?>
                  <option value="<?=$src?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>&id_categorie=<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$_GET[id_categorie]) echo "selected"; ?>>
                  <?=$cat[$j][link]?>
                  </option>
                  <? }?>
                </select>            </td>
	      </tr>
		
		 <tr>
		  <td align="right" width="120" bgcolor="#ffffff">Produs:    </td>
		  <td bgcolor="#ffffff">
		  
 <?  
 
  
 if ($id_categorie<>0) { 
 
 $catsub = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catsub, $id_categorie,0); 
 $all[]='';
  for($j = 0; $j < count($catsub); $j++) 
   $all[]=$catsub[$j][id_categorie];
	 

 $p[] = " erad_produse.id_categorie = '".$id_categorie."'" .implode(' OR  erad_produse.id_categorie=', $all) ;
  $p[]=" activ=1 ";
$produse=mysql_query_assoc("select * from erad_produse where ".implode(' AND ', $p)."   ");  }
  ?>
			
  <select name="id_produs"     >  
	<? for($j = 0; $j < count($produse); $j++) {?>
 	<option value="<?=$produse[$j][id_produs]?>"  <? if ($produse[$j][id_produs]==$vl[id_produs]) echo "selected"; ?>>   <?=$produse[$j][produs]?></option>
	<? }?>
</select>	  </td>
		 </tr>
		 <tr>
           <td align="right" bgcolor="#ffffff" nowrap="nowrap">Cantitate: </td>
		   <td bgcolor="#ffffff"><input name="cant1" type="text" value="<?=$vl[cant1]?>" size="5" /></td>
	      </tr>
		 <tr>
		   <td align="right" bgcolor="#ffffff">&nbsp;</td>
		   <td bgcolor="#ffffff"><input name="s_add" type="submit" class="but" value="Adauga" /></td>
	      </tr>
		</table>
	  </fieldset> 
</td>
</tr>

 <tr>
 <td bgcolor="#FFFFFF">
 
 Sau adauga camp nou: <br />
<br />

 
  <fieldset class="">
    <legend class="titlu"><b>Camp nou </b></legend> 

    <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
  <td width="120" align="right" nowrap bgcolor="#ffffff">Denumire:</td>
  <td bgcolor="#ffffff"><input name="produs" type="text" value="<?=$vl[produs]?>" size="80" > </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Cantitate:       </td>
   <td bgcolor="#ffffff"><input name="cant2" type="text" value="<?=$vl[cant2]?>" size="5"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Pret unitar :     </td>
   <td bgcolor="#ffffff"><input name="pret_unitar" type="text" value="<?=$vl[pret_unitar]?>" size="5" />
     Lei</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input name="s_add" type="submit" class="but" value="Adauga" /></td>
 </tr>
 </table>
 </fieldset>

 </form>
