 <? include('menu_sub.php'); ?> 
<?
$id_brand=$_GET[id_brand];

if(is_numeric($_GET['id_brand']) && $_GET['act'] == 'del_pic') {

$brd=mysql_query_assoc("select logo_brand from erad_brands where id_brand='".$id_brand."'");
	//delete
 if(is_file(PICS_DIR_THUMB . $brd[0]['logo_brand'])) 
			unlink(PICS_DIR_THUMB . $brd[0]['logo_brand']);
  if(is_file(PICS_DIR_MEDIU .$brd[0]['logo_brand'])) 
			unlink(PICS_DIR_MEDIU . $brd[0]['logo_brand']); 
	
	mysql_query("UPDATE  erad_brands set logo_brand='' WHERE id_brand = '".$id_brand."'");
 	echo js_redirect($scr.'?section='.$section.'&cmd=edit&id_brand='.$id_brand);
}


if(isset($_POST['s_add'])) {
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_brands']);  


	$vl = array();
	$vl = $_POST;
if (isset($vl[activb])) $vl[activb]=1; else $vl[activb]=0;

    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
  
		if($ins) {
		
$id_brand=get_last_mysql_id('erad_brands');
 $name=$id_brand.'_brand';
 
$u = upload_poza2('logo_brand', PICS_DIR_THUMB, PICS_DIR_MEDIU, PICS_SIZE3, PICS_SIZE1, 'erad_brands', 'logo_brand', 'id_brand',  $name);
 
    update_order('erad_brands', 'id_brand', 'ord',$extra ); 
		
		
 			echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Adaugare efectuata.');
		}
	}
}

$Usr = new UserManagement($DBF['erad_brands']);  
$vldb=$Usr->get01($_GET[id_brand]);
 
$vl=$Usr->DbToForm($vldb);

if(isset($_POST['s_mod'])) {



$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$Usr = new UserManagement($DBF['erad_brands']);  


	$vl = array();
	$vl = $_POST;
if (isset($vl[activb])) $vl[activb]=1; else $vl[activb]=0;

    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->update($vldb, $id_brand);
 
		if($ins) {

 
  $name=$id_brand.'_brand';
 
$u = upload_poza2_peste('logo_brand', PICS_DIR_THUMB, PICS_DIR_MEDIU, PICS_SIZE3, PICS_SIZE1, 'erad_brands', 'logo_brand', 'id_brand',  $name, $id_brand);

mysql_query("delete from erad_brands_certificari where id_brand='".$id_brand."'");
foreach ($_POST[id_certificare] as $id_certificare) 
		{
		if($id_certificare<>'') mysql_query("INSERT into erad_brands_certificari set id_brand='".$id_brand."', id_certificare='".$id_certificare."' ");
		}
 
	
 			echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Modificare efectuata.');
		}
	}
}
 else {

unset ($_SESSION[crt]);
 
}

?>


<? //////////////form validation
$form_name="brands_add";
include('validari_formulare.php');
include('validari_js.php');
?>

 
 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
 
  </tr>
</table>
 
 <? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:800px; height:20px; border:2px solid #ccc; background-color:#efefef; padding:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>
 <br />
 
 
 <? if ($_GET[cmd]<>'edit') {?>
			
			<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
			 <tr>
			   <td height="30" bgcolor="#efefef">
			  
			   <form name="<?=$form_name?>" action="<?=$scr?>?section=<?=$section?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data">
			<fieldset class="">
				<legend class="titlu"><b>Date</b></legend>     
			
			
			<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
			 
			 
			 <tr>
			  <td align="right" width="150" bgcolor="#ffffff">Nume </td>
			  <td bgcolor="#ffffff"><input type="text"  id="denumire_brand" name="denumire_brand" size="50"   value="<?=$denumire_brand?>"></td>
			 </tr>
			 <tr>
			   <td align="right" bgcolor="#ffffff">Logo</td>
			   <td bgcolor="#ffffff"><input type="file" name="logo_brand" size="20" /></td>
			 </tr>
			 <tr>
               <td align="right" bgcolor="#ffffff">Descriere </td>
			   <td bgcolor="#ffffff"><textarea name="descriere_brand" cols="120" rows="10"></textarea></td>
		      </tr>
			<? /*
             <tr>
               <td align="right" bgcolor="#ffffff">Activ:</td>
			   <td bgcolor="#ffffff"><input type="checkbox" name="activb" value="1" <?=checked($vl[activb], 1)?> />
                   <font style="font-size:9px; font-family:tahoma;">(apare pe site)</font> </td>
		      </tr>
			  */?>
			 <tr>
			   <td align="right" bgcolor="#ffffff">&nbsp;</td>
			   <td bgcolor="#ffffff"><input type="submit" name="s_add" value="Salveaza" class="but" /></td>
		      </tr>
			 </table>
			 </fieldset>
			 
			   </form>   </td>
			   </tr>
			 <tr>
			   <td height="30" bgcolor="#efefef">&nbsp;</td>
			 </tr>
			 </table>  
 <? } else {?>
 
			<form name="<?=$form_name?>" action="<?=$src?>?section=<?=$section?>&id_brand=<?=$id_brand?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );" enctype="multipart/form-data"> 
			
			<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
			 <tr>
			   <td height="30" bgcolor="#efefef">
			  
			 <fieldset class="">
				<legend class="titlu"><b>Date</b></legend>     
			
			
			<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
			 
			 
			 <tr>
			  <td align="right" width="150" bgcolor="#ffffff">Nume autor  </td>
			  <td bgcolor="#ffffff"><input type="text"  id="denumire_brand" name="denumire_brand" size="50"   value="<?=$vl[denumire_brand]?>"></td>
			 </tr>
			 <tr>
			   <td align="right" bgcolor="#ffffff">Logo</td>
			   <td bgcolor="#ffffff"><input type="file" name="logo_brand" size="20">
			   
			   <br />
<? if(is_file(PICS_DIR_THUMB .$vl[logo_brand])) { ?>
   <img src="<?=PICS_URL_THUMB?><?=$vl[logo_brand]?>"     />
   <a href="#" onClick="confirm_del('<?=$vl[PICS_DIR_SIZE1]?>', '<?=$scr?>?section=<?=$section?>&act=del_pic&id_brand=<?=$vl['id_brand']?>&pic=<?=$vl[logo_brand]?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
   <? }?>			   </td>
			 </tr>
			 <tr>
               <td align="right" bgcolor="#ffffff">Descriere </td>
			   <td bgcolor="#ffffff"><textarea name="descriere_brand" cols="120" rows="10"><?=$vl[descriere_brand]?></textarea></td>
		      </tr>
			 <tr>
			   <td align="right" bgcolor="#ffffff">&nbsp;</td>
			   <td bgcolor="#ffffff"><input type="submit" name="s_mod" value="Salveaza" class="but" /></td>
		      </tr>
			 </table>
			 </fieldset>			   </td>
			 </tr>
			 <tr>
			   <td height="30" bgcolor="#efefef">&nbsp;</td>
			 </tr>
			 </table>  
</form>
 <? }?>

 