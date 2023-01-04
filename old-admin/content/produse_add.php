<?
$today = getdate();

$empty = '<br /><font color=red style="font-size: 9px;">camp lipsa</font>';
$invalid = '<br /><font color=red style="font-size: 9px;">camp invalid</font>';

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
	 

 mysql_query("delete from erad_produse_tematici where id_produs='".$id_produs."'");
foreach ($_POST[id_tematica] as $id_tematica) 
		{
		if($id_tematica<>'') mysql_query("INSERT into erad_produse_tematici set id_produs='".$id_produs."', id_tematica='".$id_tematica."' ");
		}

 
foreach ($vl['valoare'] as $camp=>$val) 
		{
		 
		foreach ($val as $xx=>$valoare) {
		 if($valoare<>'') mysql_query("INSERT into erad_produse_valori set id_produs='".$id_produs."', id_camp='".$camp."' , id_valoare='".$valoare."'"); 
			}
		
		}
	if($ins) {
 
   update_order('erad_produse', 'id_produs', 'ord',' and id_categorie='.$vl[id_categorie] );
   update_order('erad_produse', 'id_produs', 'ord_oferta',' and oferta_speciala=1' );  
 unset ($_SESSION[tab]);
 
  
echo js_redirect($src.'?section='.$mnp1.'_3&tab=2&id_produs='.$id_produs);
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		

	}
	//*/
}
else {

unset ($_SESSION[szs]);
unset ($_SESSION[aut]);
}
 

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

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data"> 
 

 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
 <td bgcolor="#FFFFFF"><input type="hidden" name="zone" value="produse" /> 
  <fieldset class="">
    <legend class="titlu"><b>Coordonate</b></legend> 
	
	
		<table cellpadding="5" cellspacing="1" bgcolor="#cccccc">
		
		 <tr>
		  <td align="right" width="220" bgcolor="#ffffff">Titlu SEO H1:    </td>
		  <td colspan="2" width="600" bgcolor="#ffffff"><input type="text" class="content" name="produs_cod" size="100" maxlength="255" value="<?=$vl[produs_cod]?>" /></td>
		 </tr>
		
		 <tr>
		  <td align="right" bgcolor="#ffffff">Titlu pe larg H2:</td>
		  <td colspan="2" bgcolor="#ffffff"><input type="text" class="content" name="produs" size="100" maxlength="255" value="<?=$vl[produs]?>"></td>
		 </tr>
         <tr>
           <td align="right" bgcolor="#FFFFFF">Data aparitie:</td>
           <td colspan="2" bgcolor="#FFFFFF"><input name="data_aparitie" type="text"   value="<?=$today?>"    size="12"    />
            &nbsp;aaaa-ll-zz </td>
             <!--<a href="#data_aparitie"  onclick="displayCalendar(document.forms[0].data_aparitie,'yyyy-mm-dd',this)"><img src="img/b_calendar.png" border="0" /></a> -->
         </tr>
		 <tr>
		   <td align="right" bgcolor="#ffffff">Categorie:			 </td>
		   <td colspan="2" bgcolor="#ffffff">
		   <?  $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0); ?>
			 <select name="id_categorie" class="content" style="width:300px;"  >  
	 
	<? for($j = 0; $j < count($cat); $j++) { 
		$copii=mysql_query_scalar("select count(id_categorie) from erad_categorii where id_parinte='".$cat[$j][id_categorie]."'");
				?>
				<? if ($copii>0) {?>
					   <optgroup label="<?=$cat[$j][link]?>"></optgroup>
				<? } else {?>
						<option value="<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$vl[id_categorie]) echo "selected"; ?>>   <?=$cat[$j][link]?>   </option>
				<? }?>
    <? }?>
</select>	       </td>
		 </tr>
		
        <?  $brd =mysql_query_assoc("select * from erad_brands order by denumire_brand"); ?>
        <? if (count($brd)>0) {?>
        
     <?php /*?>    <tr>
           <td align="right" bgcolor="#ffffff">Autor: </td>
		   <td colspan="2" bgcolor="#ffffff">
		 
               <select name="id_brand" class="content" style="width:300px;"  >
                <option value="">-- Alegeti autorul --</option>
                 <? for($j = 0; $j < count($brd); $j++) {?>
                 <option value="<?=$brd[$j][id_brand]?>"  <? if ($brd[$j][id_brand]==$vl[id_brand]) echo "selected"; ?>>
                 <?=$brd[$j][denumire_brand]?>
                 </option>
                 <? }?>
               </select>           </td>
	      </tr><?php */?>
          <? }?>
        
        
        <? $tematici =mysql_query_assoc("select * from erad_tematici");  ?>
 <? if (count($tematici)>0) {?>
          
		 <tr>
		   <td align="right"bgcolor="#ffffff"  nowrap>Institutii: </td>
		   <td width="490" bgcolor="#ffffff"  >
		    
			  
  <select name="tem"   style="width:300px;" class="content"   >  
	 
	<? for($j = 0; $j < count($tematici); $j++) {?>
	<option value="<?=$tematici[$j][id_tematica]?>"  <? if ($tematici[$j][id_tematica]==$vl[id_tematica]) echo "selected"; ?>>   <?=$tematici[$j][denumire_institutie]?>   </option>
	<? }?>
</select>	
<input type="button" value="Adauga" class="but" onclick="load_tematici(tem.options[tem.selectedIndex].value,0, 'add')" />	   </td>
		   <td width="420" bgcolor="#ffffff" class="content" >
		      Tematici selectate:<br />
			   <span id="tematicisp"><input type="hidden" name="id_tematica[]" id="tematica"   />
               <span style="color: #FF0000;"> Nu aveti nicio tematica asignata acestui articol</span>
               </span>		   
               
               
               </td>
		 </tr>
         
         <? }?>
         
		</table>
	  </fieldset> 
</td>
</tr>

 <tr>



 <td bgcolor="#FFFFFF">

<!--
  <fieldset class="">
    <legend class="titlu"><b>Detalii oferta </b></legend> 

    <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
  <td width="98" align="right" nowrap bgcolor="#ffffff">Pret:</td>
  <td width="1029" bgcolor="#ffffff"><input name="pret" type="text" value="<?=$vl[pret]?>" size="10" >
  
  <?  $um = mysql_query_assoc("select * from erad_um");?>
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
</select>
        
         </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Pret oferta:</td>
   <td bgcolor="#ffffff"><input name="pret_oferta" type="text" value="<?=$vl[pret_oferta]?>" size="10" />
     &nbsp;(daca e 0 nu apare pe site)</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Greutate:</td>
   <td bgcolor="#ffffff"><input name="greutate" type="text" value="<?=$vl[greutate]?>" size="10" /> 
   Kg
     &nbsp;(afecteaza pretul de transport)</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>

 <? /////////////////////////////////////// specs extra?>


<? $specs=mysql_query_assoc("select * from erad_campuri where activ=1");

foreach ($specs as $campuri) {?>
 
 
 <? }?>
 
 
 
 <? /////////////////////////////////////// ?>
 </table>
 </fieldset>

-->


 <fieldset class="">
    <legend class="titlu"><b>Descriere articol </b></legend> 


 <table cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
   <td width="150" align="right" bgcolor="#ffffff">Sapou (articol pe scurt)      </td>
   <td width="800" bgcolor="#ffffff">
	<textarea name="descriere_scurta" class="content" rows="3" style="width: 700; height: 150;"><?=$vl[descriere_scurta]?></textarea>
   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">&nbsp;Pe larg:     </td>
   <td bgcolor="#ffffff"><textarea name="descriere" class="content" rows="20" style="width: 700; "><?=$vl[descriere]?></textarea>
   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#D4D0C8">&nbsp;</td>
   <td bgcolor="#D4D0C8">&nbsp;</td>
 </tr>
 
  </table>
 </fieldset>

 <fieldset class="">
    <legend class="titlu"><b>Detalii publicare </b></legend> 


 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
<!--

 <tr>
   <td align="right" bgcolor="#ffffff">Nu e pe stoc :</td>
   <td bgcolor="#ffffff"><input type="checkbox" name="in_curand" value="1" <?=checked($vl[in_curand], 1)?> /></td>
 </tr>

 <tr>
  <td align="right" bgcolor="#ffffff" nowrap>Oferta speciala:    </td>
  <td bgcolor="#ffffff">
  	<input type="checkbox" name="oferta_speciala" value="1" <?=checked($vl[oferta_speciala], 1)?>></td>
 </tr>
 -->
  <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Apare pe prima pagina: </td>
   <td   bgcolor="#ffffff"><input type="checkbox" name="produs_nou" value="1" <?=checked($vl[produs_nou], 1)?> />
       <font style="font-size:9px; font-family:tahoma;">&nbsp; </font> </td>
 </tr>



 <tr>
  <td align="right" width="150px" bgcolor="#ffffff">Activ:</td>
  <td bgcolor="#ffffff">
  	<input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?>>
  	<font style="font-size:9px; font-family:tahoma;">(apare pe site)</font>  </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff"></td>
   <td bgcolor="#ffffff">      </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff"><div id="inp"><input type="submit" name="s_add_produs" class="but" value="Salveaza"> <?=$_GET['msg']?></div></td>
 </tr>
</table>
</fieldset>

</form>
