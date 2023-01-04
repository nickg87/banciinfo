<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';
 $id_produs=$_GET[id_produs];
$today=date('Y-m-d');

#print_r($_FILES['poza']);

if($_SESSION[tab]=='') $_SESSION[tab]=1; else  $_SESSION[tab]=$_GET[tab];

$Usr = new UserManagement($DBF['erad_produse']);  

$vldb=$Usr->get01($_GET[id_produs]);
 
$vl=$Usr->DbToForm($vldb);

if(isset($_POST['s_add_produs'])) {
	$vl = array();
	$vl = $_POST;

 $vl[added_on]=date('Y-m-d H:i:s');

 if (isset($vl[oferta_speciala])) $vl[oferta_speciala]=1; else $vl[oferta_speciala]=0;
  if (isset($vl[produs_nou])) $vl[produs_nou]=1; else $vl[produs_nou]=0;
if (isset($vl[activ])) $vl[activ]=1; else $vl[activ]=0;
 if (isset($vl[in_curand])) $vl[in_curand]=1; else $vl[in_curand]=0;
   	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->update($vldb, $id_produs);

  

	if($ins) {
  	 
mysql_query("delete from erad_produse_tematici where id_produs='".$id_produs."'");
foreach ($_POST[id_tematica] as $id_tematica) 
		{
		if($id_tematica<>'') mysql_query("INSERT into erad_produse_tematici set id_produs='".$id_produs."', id_tematica='".$id_tematica."' ");
		}

 
 
 unset ($_SESSION[tab]);
 
  
echo js_redirect('main.php?'.$_SESSION[url]);
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		

	}
	//*/
}else {

unset ($_SESSION[szs]);
 
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
  <td height="30" bgcolor="#efefef" class="titlu">
  
  <b><?=get_section_name($section)?> &raquo; <?=htmlspecialchars($vl[produs])?> | id <?=$vl[id_produs]?></b>   </td>
 
  <td width="31%" align="right" bgcolor="#efefef" class="titlu">
    <form action="<?=$scr?>" method="get" style="margin:0px;">
  Cauta   <input name="keyword" type="text" size="25" value="<?=$keyword?>"  />
  <input type="hidden" name="section" value="<?=$mnp1?>_0"  />
  <input type="submit"   class="but" value="Cauta"   />
    </form>  </td>
 </tr>
 <tr>
   <td height="30" bgcolor="#efefef"  >
    Mergi la:
<? $nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $vl[id_categorie],0);  ?>

<? foreach ($nav as $n) {?>
<? if ($n[lvl]>1){ ?>
&raquo; <a href="<?=$scr?>?section=<?=$mnp1?>_0&id_categorie=<?=$n[id_categorie]?>" ><strong><?=$n[link]?></strong></a>  
<? } else {?> 
 <strong><?=$n[link]?></strong>
<? }?>
<? }?>     </td>
   <td align="right" bgcolor="#efefef" class="titlu">
   
    <a href="<?=get_link_produs($id_produs, $vl[produs_cod])?>" target="_blank"  > <strong> <img src="img/magnifier.png" alt="vezi produsul" border="0" align="top" />Vezi articolul pe site</strong></a>   </td>
 </tr>
</table>
<br />

<? include "tabs.php";?>

 <form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_produs=<?=$id_produs?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data"> 
 

 <table cellpadding="5" cellspacing="1"  width="95%"  >

 <tr>
 <td bgcolor="#FFFFFF">
 
 
  <fieldset class="">
    <legend class="titlu"><b>Coordonate</b></legend> 
	
	
	  <table cellpadding="5" cellspacing="1" bgcolor="#cccccc">
		
		 <tr>
		  <td align="right" width="220" bgcolor="#ffffff">Titlu SEO H1:    </td>
		  <td width="600" bgcolor="#ffffff" colspan="2">
			<input type="text" class="content" name="produs_cod" size="100" maxlength="255" value="<?=$vl[produs_cod]?>" /></td>
		 </tr>
		
		 <tr>
		  <td align="right" width="220" bgcolor="#ffffff">Titlu pe larg H2:</td>
		  <td width="600" bgcolor="#ffffff" colspan="2"><input type="text" class="content" name="produs" size="100" maxlength="255" value="<?=htmlspecialchars($vl[produs])?>"></td>
		 </tr>
 
         <tr>
           <td align="right" bgcolor="#FFFFFF">Data aparitie:</td>
           <td  colspan="2" bgcolor="#FFFFFF"><input name="data_aparitie" type="text"   value="<? if($vl[data_aparitie]<>'0000-00-00') echo $vl[data_aparitie];?>"    size="12"    />
              &nbsp;aaaa-ll-zz  </td>
         </tr>
		 <tr>
		   <td align="right" bgcolor="#ffffff">Categorie:			 </td>
		   <td colspan="2" bgcolor="#ffffff">
		   <?  $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0); ?>
			 <select name="id_categorie" class="content" style="width:300px;"     >  
	 
	<? for($j = 0; $j < count($cat); $j++) { 
	
    	$copii=mysql_query_scalar("select count(id_categorie) from erad_categorii where id_parinte='".$cat[$j][id_categorie]."'");
				?>
				<? if ($copii>0) {?>
					   <optgroup label="<?=$cat[$j][link]?>" style="color:#000000;"></optgroup>
				<? } else {?>
						<option value="<?=$cat[$j][id_categorie]?>"  <? if ($cat[$j][id_categorie]==$vl[id_categorie]) echo "selected"; ?>>   <?=$cat[$j][link]?>   </option>
				<? }?>
    
	<? }?>
</select>	       </td>
		 </tr>


 <? $tematici =mysql_query_assoc("select * from erad_tematici");  ?>
 <? if (count($tematici)>0) {?>
		 <tr>
		   <td align="right"bgcolor="#ffffff"  nowrap>Institutii:</td>
		   <td width="490" bgcolor="#ffffff"  >

			  
  <select name="tem"   class="content" style="width:300px;"    >  
	 
	<? for($j = 0; $j < count($tematici); $j++) {?>
	<option value="<?=$tematici[$j][id_tematica]?>"  <? if ($tematici[$j][id_tematica]==$vl[id_tematica]) echo "selected"; ?>>   <?=$tematici[$j][denumire_institutie]?>   </option>
	<? }?>
</select>		
<input type="button" value="Adauga" class="but" onclick="load_tematici(tem.options[tem.selectedIndex].value,0, 'add')" />	   </td>
		   <td width="420" bgcolor="#ffffff" class="content"  >
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

 

 <fieldset class="" >
    <legend class="titlu"><b>Descriere articol </b></legend> 


 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

 <tr>
   <td width="150" align="right" bgcolor="#ffffff">&nbsp;Pe scurt:      </td>
   <td width="771" bgcolor="#ffffff"><textarea name="descriere_scurta" class="content" rows="3" style="width: 700; height: 150;"><?=$vl[descriere_scurta]?></textarea></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">&nbsp;Pe larg:     </td>
   <td bgcolor="#ffffff"><textarea name="descriere" class="content" rows="20" style="width: 700; "><?=$vl[descriere]?></textarea></td>
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
 <tr>
   <td width="150" align="right" bgcolor="#ffffff">&nbsp;</td>
   <td colspan="2" bgcolor="#ffffff">&nbsp;</td>
 </tr>

<!--

 <tr>
   <td align="right" bgcolor="#ffffff">Nu e pe stoc :</td>
   <td colspan="2" bgcolor="#ffffff"><input type="checkbox" name="in_curand" value="1" <?=checked($vl[in_curand], 1)?> /></td>
 </tr>

 <tr>
  <td align="right" bgcolor="#ffffff" nowrap>Oferta speciala:    </td>
  <td colspan="2" bgcolor="#ffffff">
  <input type="checkbox" name="oferta_speciala" value="1" <?=checked($vl[oferta_speciala], 1)?>></td>
 </tr>
 -->
 <tr>
   <td align="right" bgcolor="#ffffff" nowrap="nowrap">Apare pe prima pagina: </td>
   <td colspan="2" bgcolor="#ffffff"><input type="checkbox" name="produs_nou" value="1" <?=checked($vl[produs_nou], 1)?> />
       <font style="font-size:9px; font-family:tahoma;">&nbsp; </font> </td>
 </tr>


 
 <tr>
  <td align="right" width="200px"  bgcolor="#ffffff">Activ:</td>
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
  <td width="557" bgcolor="#ffffff"><input type="submit" name="s_add_produs" class="but" value="Salveaza"> <?=$_GET['msg']?></td>
  <td width="409" bgcolor="#ffffff">
  
    </td>
 </tr>
</table>
</fieldset>

</form>

</td>
</tr>
</table>

<br />
<br />

<? include "tabs.php";?>

   <fieldset class=""  style="width:94%; text-align:left;" >
    <legend class="titlu"><b>Galerie foto</b></legend>     
 
	<? 
$pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$id_produs."' order by prim desc, id_pic desc");

for($j=0; $j<count($pics); $j++){?>


<? if(is_file(PICS_DIR_THUMB . $pics[$j]['pic'])) {?>
	
	
	 
	 <a href="#" onClick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$pics[$j]['pic']?>', '<?=$s[0]?>', '<?=$s[1]?>')">
	    <img src="<?=PICS_URL_THUMB?><?=$pics[$j]['pic']?>" border="1"    align="middle"   height="50" ></a>	 

	 <? }?>
 	<? }?> 
</fieldset>	

<? 
$files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$id_produs."'");
if (count($files)>0) { 
?>
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

<? for($j=0; $j<count($files); $j++){?>


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
<? }?>