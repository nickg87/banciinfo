<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';
 $id_produs=$_GET[id_produs];
$today=date('Y-m-d');

#print_r($_FILES['poza']);

if($_SESSION[tab]=='') $_SESSION[tab]=1; else  $_SESSION[tab]=$_GET[tab];

$Usr = new UserManagement($DBF['erad_produse']);  

 
if(isset($_POST['s_add_produs'])) {
	$vl = array();
	$vl = $_POST;

 
if (isset($vl[produs_nou])) $vl[produs_nou]=1; else $vl[produs_nou]=0;
if (isset($vl[oferta_speciala])) $vl[oferta_speciala]=1; else $vl[oferta_speciala]=0;
if (isset($vl[activ])) $vl[activ]=1; else $vl[activ]=0;
if (isset($vl[in_curand])) $vl[in_curand]=1; else $vl[in_curand]=0;

   	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);

$id_produs=get_last_mysql_id('erad_produse');
	 

foreach ($_POST[id_tematica] as $id_tematica) 
		{
		if($id_tematica<>'') mysql_query("INSERT into erad_produse_tematici set id_produs='".$id_produs."', id_tematica='".$id_tematica."' ");
		}
foreach ($_POST[id_autor] as $id_autor) 
		{
		if($id_autor<>'') mysql_query("INSERT into erad_produse_autori set id_produs='".$id_produs."', id_autor='".$id_autor."' ");
		}


 
foreach ($vl['valoare'] as $camp=>$val) 
		{
		 
		foreach ($val as $xx=>$valoare) {
		 if($valoare<>'') mysql_query("INSERT into erad_produse_valori set id_produs='".$id_produs."', id_camp='".$camp."' , id_valoare='".$valoare."'"); 
			}
		
		}
	if($ins) {
 
  
$pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$_GET[id_produs_old]."' order by prim desc, id_pic desc");

for($j=0; $j<count($pics); $j++){ 
	$next_pic=get_next_mysql_id("erad_galerie");  
	  if(is_file(PICS_DIR_THUMB . $pics[$j]['pic'])) { 
	  $ext = pathinfo(PICS_DIR_THUMB . $pics[$j]['pic'], PATHINFO_EXTENSION);
 			 
		if(copy(PICS_DIR_THUMB . $pics[$j]['pic'], PICS_DIR_THUMB . $next_pic.'_'.$id_produs.'_prd.'.$ext)) 
		mysql_query(" insert into erad_galerie set pic='". $next_pic.'_'.$id_produs.'_prd.'.$ext."',id_produs='".$id_produs."',prim='".$pics[$j]['prim']."', titlu='".$pics[$j]['titlu']."', descriere='".$pics[$j]['descriere']."' ");  
		}
		
		if(is_file(PICS_DIR_MEDIU . $pics[$j]['pic'])) { 
		 copy(PICS_DIR_MEDIU . $pics[$j]['pic'], PICS_DIR_MEDIU .  $next_pic.'_'.$id_produs.'_prd.'.$ext);  
 		}
		if(is_file(PICS_DIR_LARGE . $pics[$j]['pic'])) { 
		 copy(PICS_DIR_LARGE . $pics[$j]['pic'], PICS_DIR_LARGE .  $next_pic.'_'.$id_produs.'_prd.'.$ext);  
 		}
		if(is_file(PICS_DIR_SMALL . $pics[$j]['pic'])) { 
		 copy(PICS_DIR_SMALL . $pics[$j]['pic'], PICS_DIR_SMALL .  $next_pic.'_'.$id_produs.'_prd.'.$ext);  
 		}
 	}
	
	
	$files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$_GET[id_produs_old]."'");
		for($j=0; $j<count($files); $j++){ 
		 if(is_file(FILE_DIR . $files[$j]['file'])) 
			 if(copy(FILE_DIR . $files[$j]['file'], FILE_DIR . $id_produs.'_'.$files[$j]['file'])) 
				mysql_query(" insert into erad_fisiere set file='".$id_produs.'_'.$files[$j]['file']."',id_produs='".$id_produs."', file_desc='".$files[$j]['file_desc']."', ord='".$files[$j]['ord']."' ");  
				} 
	 	
	
   update_order('erad_produse', 'id_produs', 'ord',' and id_categorie='.$vl[id_categorie] ); 
 unset ($_SESSION[tab]);
 
  
echo js_redirect($src.'?section='.$mnp1.'_3&tab=2&id_produs='.$id_produs);
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		

	}
	//*/
}else {

unset ($_SESSION[szs]);
 
}
 
 
$vldb=$Usr->get01($_GET[id_produs]);
 
$vl=$Usr->DbToForm($vldb);


?>




 <? include('menu_sub.php'); ?> 


<? //////////////form validation
$form_name="produse_add";
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

<? include "tabs.php";?>

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_produs_old=<?=$id_produs?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data"> 
 

 <table cellpadding="5" cellspacing="1"  width="95%" >

 <tr>
 <td bgcolor="#FFFFFF">
 
 
  <fieldset class="">
    <legend class="titlu"><b>Coordonate</b></legend> 
	
	
	  <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
		
		 <tr>
		  <td align="right" width="150" bgcolor="#ffffff">Denumire:    </td>
		  <td width="1027" colspan="2" bgcolor="#ffffff"><input type="text" name="produs" size="50" maxlength="255" value="<?=$vl[produs]?>"></td>
		 </tr>
		 <tr>
           <td align="right" bgcolor="#ffffff">Cod: </td>
		   <td colspan="2" bgcolor="#ffffff"><input type="text" name="produs_cod" size="50" maxlength="255" value="<?=$vl[produs_cod]?>" /></td>
	    </tr>
		 <tr>
		   <td align="right" bgcolor="#ffffff">Categorie:			 </td>
		   <td colspan="2" bgcolor="#ffffff">
		   <?  $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0); ?>
			 <select name="id_categorie"    >  
	 
	<? for($j = 0; $j < count($cat); $j++) {?>
	<option value="<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$vl[id_categorie]) echo "selected"; ?>>   <?=$cat[$j][link]?>   </option>
	<? }?>
</select>	       </td>
		 </tr>
		
        <?  $brd =mysql_query_assoc("select * from erad_brands order by denumire_brand"); ?>
        <? if (count($brd)>0) {?>
         <tr>
           <td align="right" bgcolor="#ffffff">Brand: </td>
		   <td colspan="2" bgcolor="#ffffff">
		   
               <select name="id_brand"    >
                 <? for($j = 0; $j < count($brd); $j++) {?>
                 <option value="<?=$brd[$j][id_brand]?>"  <? if ($brd[$j][id_brand]==$vl[id_brand]) echo "selected"; ?>>
                 <?=$brd[$j][denumire_brand]?>
                 </option>
                 <? }?>
               </select>           </td>
	    </tr>
        
        <? }?>


 <? $tematici = get_cat_list_rec('erad_tematici', 'id_parinte', 'id_tematica', 'denumire_tematica', 'ord', $tematici, 0,0);  ?>
 <? if (count($tematici)>0) {?>
		 <tr>
		   <td align="right"bgcolor="#ffffff"  nowrap>Tip produs</td>
		   <td width="409" bgcolor="#ffffff"  >

			  
  <select name="tem"   style="width:200px;"   >  
	 
	<? for($j = 0; $j < count($tematici); $j++) {?>
	<option value="<?=$tematici[$j][id_tematica]?>"  <? if ($tematici[$j][id_tematica]==$vl[id_tematica]) echo "selected"; ?>>   <?=$tematici[$j][denumire_tematica]?>   </option>
	<? }?>
</select>		
<input type="button" value="Adauga" class="but" onclick="load_tematici(tem.options[tem.selectedIndex].value,0, 'add')" />	   </td>
		   <td width="563" bgcolor="#ffffff"  >
	 Tematici selectate:<br />
	 <span id="tematicisp"></span>	   
	
	
		 <? if($id_produs) { ?>
     <script>load_tematici(0,<?=$id_produs?>, 'show');</script>
     <? } ?>		   </td>
	    </tr>

 <? }?>

		</table>
	  </fieldset> 
</td>
</tr>



 <tr>
 <td bgcolor="#FFFFFF">
  <fieldset class="">
    <legend class="titlu"><b>Detalii tehnice </b></legend> 

    <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
  <td width="103" align="right" nowrap bgcolor="#ffffff">Pret:</td>
  <td width="1024" bgcolor="#ffffff"><input name="pret" type="text" value="<?=$vl[pret]?>" size="10" >
  		  <?  $um = mysql_query_assoc("select * from erad_um");?>
		
		<? if (count($um)>0){?>
		<select name="id_um">
		<option value="0"> Unitate masura</option>
		<?  for($i=0; $i<count($um); $i++){  ?>
		<option value="<?=$um[$i][id_um]?>" <?=selected($um[$i][id_um], $vl[id_um])?>><?=$um[$i][um]?></option>
		  <? }?>
		  </select>
		<? }?> 
        
 <? $valute=mysql_query_assoc("select * from erad_curs_monede where activ=1");?>

<select name="id_moneda" >
<option value="0" <?=selected(0, $vl[id_moneda])?>>LEI</option>
<? foreach ($valute as $v) {?>
<option value="<?=$v[id_moneda]?>"  <?=selected($v[id_moneda], $vl[id_moneda])?>><?=$v[moneda]?></option>
<? }?>
</select>         </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Pret oferta:</td>
   <td bgcolor="#ffffff"><input name="pret_oferta" type="text" value="<?=$vl[pret_oferta]?>" size="10" />
     &nbsp;(daca e 0 nu apare pe site)</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Greutate:</td>
   <td bgcolor="#ffffff">
   
   <input name="greutate" type="text" value="<?=$vl[greutate]?>" size="10" />
     Kg &nbsp;(afecteaza pretul de transport)
   </td>
 </tr>
  <? /////////////////////////////////////// specs extra?>


<? $specs=mysql_query_assoc("select * from erad_campuri where activ=1");

foreach ($specs as $campuri) {?>
 
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">
   <?=$campuri[denumire_camp]?>
   <input type="hidden" name="id_camp" value="<?=$campuri[id_camp]?>" />   </td>
   <td bgcolor="#ffffff">
   <?   $valori = mysql_query_assoc("select * from erad_campuri_valori where id_camp='".$campuri[id_camp]."'");?>
       
         <? for($j = 0; $j < count($valori); $j++) {
		 
		 $vlprd=mysql_query_assoc("select * from erad_produse_valori 
		 where id_produs='".$id_produs."' 
		 and id_camp='".$campuri[id_camp]."' 
		 and id_valoare='".$valori[$j][id_valoare]."'
		 ");
	 
		 ?>
         <input type="checkbox" name="valoare[<?=$campuri[id_camp]?>][]" value="<?=$valori[$j][id_valoare]?>" <? if (count($vlprd)>0) echo "checked";?>    >
         <?=$valori[$j][valoare_camp]?> 

         <? }?></td>
   </tr>
 
 
 <? }?>
 
 
 
 <? /////////////////////////////////////// ?>
 </table>
 </fieldset>

 <fieldset class="" >
    <legend class="titlu"><b>Descriere produs </b></legend> 


 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
   <td width="150" align="right" bgcolor="#ffffff">&nbsp;Pe scurt:      </td>
   <td width="771" bgcolor="#ffffff"><textarea name="descriere_scurta" rows="3" style="width: 80%; height: 150px;"><?=$vl[descriere_scurta]?></textarea></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">&nbsp;Pe larg:     </td>
   <td bgcolor="#ffffff"><textarea name="descriere" rows="20" style="width: 80%; "><?=$vl[descriere]?></textarea></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#D4D0C8">&nbsp;</td>
   <td bgcolor="#D4D0C8">&nbsp;</td>
 </tr>
 
  </table>
 </fieldset>

 <fieldset class="">
    <legend class="titlu"><b>Detalii oferta si publicare </b></legend> 


 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
   <td width="150" align="right" bgcolor="#ffffff">&nbsp;</td>
   <td colspan="2" bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Nu e pe stoc :</td>
   <td colspan="2" bgcolor="#ffffff"><input type="checkbox" name="in_curand" value="1" <?=checked($vl[in_curand], 1)?> /></td>
 </tr>

 <tr>
  <td align="right" bgcolor="#ffffff" nowrap>Prima pagina:    </td>
  <td colspan="2" bgcolor="#ffffff">
  <input type="checkbox" name="oferta_speciala" value="1" <?=checked($vl[oferta_speciala], 1)?>>
  	<font style="font-size:9px; font-family:tahoma;">(apare pe prima pagina)</font>  </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff">Produs nou: </td>
   <td colspan="2" bgcolor="#ffffff"><input type="checkbox" name="produs_nou" value="1" <?=checked($vl[produs_nou], 1)?> /></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff">Activ:</td>
  <td colspan="2" bgcolor="#ffffff">
  	<input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?>>
  	<font style="font-size:9px; font-family:tahoma;">(apare pe site)</font>  </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td colspan="2" bgcolor="#ffffff">      </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td colspan="2" bgcolor="#ffffff">   </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td width="263" bgcolor="#ffffff"><input type="submit" name="s_add_produs" class="but" value="Salveaza"> <?=$_GET['msg']?></td>
  <td width="703" bgcolor="#ffffff">  </td>
 </tr>
</table>
</fieldset>

</form>

<? include "tabs.php";?>

   <fieldset class=""  style="width:94%;" >
    <legend class="titlu"><b>Galerie foto</b></legend>     
 
	<? 
$pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$id_produs."' order by prim desc, id_pic desc");

for($j=0; $j<count($pics); $j++){?>


<? if(is_file(PICS_DIR_THUMB . $pics[$j]['pic'])) {?>
	
	
	<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #ccc; margin:5px;">
  <tr>
    <td width="150" align="center" valign="middle" bgcolor="#efefef">
	 <a href="#" onClick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$pics[$j]['pic']?>', '<?=$s[0]?>', '<?=$s[1]?>')">
	    <img src="<?=PICS_URL_THUMB?><?=$pics[$j]['pic']?>" border="1"    align="middle"   width="50" ></a>	</td>
    <td bgcolor="#efefef">
	<strong>Titlu:</strong> 
	<?=$pics[$j]['titlu']?>
	<br />
	<br />

    <strong>Descriere:</strong>    <?=$pics[$j]['descriere']?>	</td>
    </tr>
</table>

	 <? }?>
 	<? }?> 
</fieldset>	


<fieldset class=""  style="width:94%;">
    <legend class="titlu"><b>Lista fisiere</b></legend> 
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#EFEFEF">
<tr>
<td width="150">
Denumire</td>
<td>
Descriere</td>	 
<td width="95">&nbsp;</td>	 
</tr>
<? 
$files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$id_produs."'");

for($j=0; $j<count($files); $j++){?>


<? if(is_file(FILE_DIR . $files[$j]['file'])) {?>
<tr>
<td height="20" nowrap="nowrap" bgcolor="#FFFFFF"><a href="<?=FILE_URL?><?=$files[$j]['file']?>">
  <strong><?=$files[$j]['file']?></strong>
</a></td>
<td bgcolor="#FFFFFF">
&nbsp;
<?=$files[$j]['file_desc']?> </td>
<td bgcolor="#FFFFFF">&nbsp;</td>
</tr>
 <? }?>

<? }?>
</table>
 </fieldset>
