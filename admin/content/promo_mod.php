  <?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';
$invalid = '<br><font color=red style="font-size: 9px;">camp invalid</font>';

 $id_promotie=$_GET[id_promotie];
$Usr = new UserManagement($DBF['erad_promotii']);  

if(is_numeric($_GET['id_promotie']) && $_GET['act'] == 'del_pic') {
	//delete
 if(is_file(PICS_DIR_PROMO . $_GET['pic'])) 
			unlink(PICS_DIR_PROMO . $_GET['pic']);
  
	mysql_query("UPDATE  erad_promotii set pic='' WHERE id_promotie = '".$_GET['id_promotie']."'");
 	echo js_redirect($scr.'?section='.$section.'&id_promotie='.$id_promotie);
}

if(is_numeric($_GET['id_promotie']) && $_GET['act'] == 'del_gal') {
	//delete
 if(is_file(PICS_DIR_PROMO . $_GET['pic'])) 
			unlink(PICS_DIR_PROMO . $_GET['pic']);
  
	mysql_query("UPDATE  erad_promotii set poza'".$_GET[j]."'='' WHERE id_promotie = '".$_GET['id_promotie']."'");
 	echo js_redirect($scr.'?section='.$section.'&id_promotie='.$id_promotie);
}





$vldb=$Usr->get01($id_promotie);
$vl=$Usr->DbToForm($vldb);
 
 $categ=mysql_query_assoc("select * from erad_produse where id_produs='".$vl[id_produs]."' ");
 
$id_categorie=$categ[0][id_categorie];

if(isset($_POST['s_add_promo'])  ) {
	$vl = array();
	$vl = $_POST;

if ($vl[tip_promotie]==1) {$vl[tip_promotie]=1; $vl[id_produs]=''; $vl[id_categorie]='';}  
if ($vl[tip_promotie]==2) {$vl[tip_promotie]=2;  } 
if ($vl[tip_promotie]==3) {$vl[tip_promotie]=3; $vl[id_produs]='';  } 
 
if (isset($vl[activ])) $vl[activ]=1; else $vl[activ]=0;

 
 
   	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)  ) {
$ins = $Usr->update($vldb, $id_promotie);


if ( strlen($_FILES['pic']['tmp_name']))  { 	 
 
 $u = upload_poza2_peste('pic', PICS_DIR, PICS_DIR_PROMO, PICS_PROMO, BANNER_PROMO, 'erad_promotii', 'pic', 'id_promotie', 'promo'.$id_promotie, $id_promotie);
$q=mysql_query_assoc("select * from erad_promotii where id_promotie='".$id_promotie."'");
if(is_file(PICS_DIR.$q[0][pic])) 	unlink(PICS_DIR . $q[0][pic]);  
}
 
	for($i = 1; $i <= 4; $i++) {
			if($ins && strlen($_FILES['poza'.$i]['tmp_name'])) {
				$n_poza = url_shape($vl[nume_promotie], 200).'_';
			//	upload_poza2('pic'.$i, PICS_DIR_SIZE1, PICS_DIR_SIZE2, PICS_SIZE1, PICS_SIZE2, 'valus_imobile', 'pic'.$i, 'id_imobil', 'pic'.$i);
				$u = upload_poza2_peste('poza'.$i,  PICS_DIR, PICS_DIR_PROMO, PICS_PROMO, PICS_PROMO, 'erad_promotii', 'poza'.$i, 'id_promotie', $n_poza.$i, $id_promotie);
	$q=mysql_query_assoc("select * from erad_promotii where id_promotie='".$id_promotie."'");
if(is_file(PICS_DIR.$q[0]['poza'.$i])) 	unlink(PICS_DIR . $q[0]['poza'.$i]);  
			
			}
		}

	if($ins) {
 	
	
			echo js_redirect($src.'?section='.$mnp1.'_0');
			
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		

	}
	//*/
}

 
?>



 
<? //////////////form validation
$form_name="promo_mod";
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

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:800px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>

<fieldset class="" style="width:94%;">
    <legend class="titlu"><b>Date promotie</b></legend>     
 

<form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>&id_promotie=<?=$id_promotie?>" method="post" enctype="multipart/form-data" onSubmit="return validate_form_<?=$form_name?> ( );">
 <input type="hidden" name="zone" value="promotii" />
 
 <table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  <tr>
  <td align="right" width="12%" bgcolor="#ffffff">Nume oferta :<?=$error['produs']?></td>
  <td width="88%" bgcolor="#ffffff"><input type="text" name="nume_promotie" size="50" maxlength="255" value="<?=$vl[nume_promotie]?>"></td>
 </tr><tr>
   <td align="right" bgcolor="#ffffff">Banner:
       <?=$error['activ']?></td>
   <td bgcolor="#ffffff">
   <input type="file" name="pic" size="20" > <font style="font-size:9px; font-family:tahoma;">Dimensiuni maxime:<strong> <?=BANNER_PROMO?> x <?=BANNER_PROMO_H?> pixeli</strong>)</font>
  <br />
   <br />
   <? if(is_file(PICS_DIR_PROMO .$vl[pic])) { ?>
   <img src="<?=PICS_URL_PROMO?><?=$vl[pic]?>"   />
   <a href="#" onClick="confirm_del('<?=$vl[pic]?>', '<?=$scr?>?section=<?=$section?>&act=del_pic&id_promotie=<?=$vl['id_promotie']?>&pic=<?=$vl[pic]?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
   <? }?>      <br />
   <br />  </td>
 </tr>
 </table>


<table width="95%" align="center"  id="desc"   cellpadding="5" cellspacing="1" bgcolor="#cccccc">  
 <tr>
  <td align="right" bgcolor="#ffffff" width="12%">Link:</td>
  <td bgcolor="#ffffff"><input type="text" name="link_promo" size="100" maxlength="255" value="<?=$vl[link_promo]?>" /></td>
 </tr>
 
<tr>
   <td align="right" bgcolor="#FFFFFF"> Tip link</td>
   <td bgcolor="#ffffff">
   
  
     <select name="tip_link" >
<? foreach ($open_link as $ol=>$label) {?>
   <option value="<?=$ol?>" <?=selected($vl[tip_link], $ol)?>><?=$label?></option>
   
   <? }?>
   </select>   </td>
 </tr>
 
 <tr>
   <td align="right" bgcolor="#ffffff">Activa:
       <?=$error['activ']?></td>
   <td bgcolor="#ffffff"><input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?> />
       <font style="font-size:9px; font-family:tahoma;">(apare pe site)</font> </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">&nbsp;</td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff"><input type="submit" name="s_add_promo" value="Salveaza" class="but" /></td>
 </tr>
</table>
 
 
 <p>&nbsp;</p>
</form>
</style>