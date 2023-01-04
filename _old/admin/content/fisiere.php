 <? include('menu_sub.php'); ?> 
<? 
  $id_produs=$_GET[id_produs];
$prd=mysql_query_assoc("select * from erad_produse where id_produs='".$id_produs."'");

if( $_GET['act'] == 'del') {
	//delete
$filsel=mysql_query_assoc("select * from erad_fisiere where id_file='".$_GET[id_file]."'");
if(is_file(FILE_DIR . $filsel[0]["file"])) 
			unlink(FILE_DIR . $filsel[0]["file"]);
 
mysql_query("delete from erad_fisiere where id_file='".$_GET[id_file]."'");

	 echo js_redirect($src.'?section='.$section.'&id_produs='.$_GET['id_produs']);


}
 if($_SESSION[tab]=='') $_SESSION[tab]=1; else  $_SESSION[tab]=$_GET[tab];


 if(isset($_POST[s_add]) and strlen($_FILES['file']['tmp_name'])) {
$next=get_next_mysql_id('erad_fisiere');	 
		   $target_path = FILE_DIR;
		//$target_path = "d:/_php/www/_private/ssm/admin/factura/";
		 
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		
		$target_path = $target_path .$id_produs.'_'.'_'.$next.'.'.$ext ;
		$name=$id_produs.'_'.'_'.$next.'.'.$ext;
		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
$ins = mysql_query("
			INSERT INTO erad_fisiere SET
			id_produs = '".$id_produs."',
			file='".$name."',
			file_desc='".$_POST['file_desc']."'
			");
			
		     $msg= "Fisierul ". basename($_FILES['file']['name']). " a fost uploadat";
		} else{
		     $msg= "There was an error uploading the file, please try again!";
		}
	 
  echo js_redirect($src.'?section='.$section.'&id_produs='.$_GET['id_produs'].'&msg='.$msg);
}


  if(isset($_POST[s_mod]) ) {
				
$upd = mysql_query("
			UPDATE  erad_fisiere SET
			file_desc='".$_POST[file_desc]."' 
			where id_file = '".$_GET[id_file]."' 
				");
 

if($upd) {
 			echo js_redirect($src.'?section='.$section.'&id_produs='.$id_produs.'&cmd=add&msg=Modificare efectuata');
		} else {
		//echo js_redirect($src.'?csm=content/galerie_foto.php&id_produs='.$id_produs.'&cmd=no&msg=Mai incercati');
		}
}
$filsel=mysql_query_assoc("select * from erad_fisiere where id_file='".$_GET[id_file]."'");


?>
 
 
<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" bgcolor="#efefef" class="titlu">
  
  <b><?=get_section_name($section)?> &raquo; <?=htmlspecialchars($prd[0][produs])?> | id <?=$prd[0][id_produs]?></b>   </td>
 
  <td width="31%" align="right" bgcolor="#efefef" class="titlu">
    <form action="<?=$scr?>" method="get" style="margin:0px;">
  Cauta   <input name="keyword" type="text" size="25" value="<?=$keyword?>"  />
  <input type="hidden" name="section" value="<?=$mnp1?>_0"  />
  <input type="submit"   class="but" value="Cauta"   />
    </form>  </td>
 </tr>
 <tr>
   <td height="30" bgcolor="#efefef">
    Mergi la:
<? $nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $prd[0][id_categorie],0);  ?>

<? foreach ($nav as $n) {?>
<? if ($n[lvl]>1){ ?>
&raquo; <a href="<?=$scr?>?section=<?=$mnp1?>_0&id_categorie=<?=$n[id_categorie]?>" ><strong><?=$n[link]?></strong></a>  
<? } else {?> 
 <strong><?=$n[link]?></strong>
<? }?>
<? }?>     </td>
   <td align="right" bgcolor="#efefef" class="titlu">
   
    <a href="<?=get_link_produs($prd[0][id_produs], $prd[0][produs_cod])?>" target="_blank"  > <strong> <img src="img/magnifier.png" alt="vezi produsul" border="0" align="top" />Vezi articolul pe site</strong></a>   </td>
 </tr>
</table>
<br />

 
<? include "tabs.php";?>

<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="24"  >
<fieldset class="">
    <legend class="titlu"><b>Upload fisier</b></legend> 
<br />
<br />
	<? if ($_GET[edit]==1) {?>
	<form action="<?=$scr?>?section=<?=$section?>&id_produs=<?=$id_produs?>&id_file=<?=$_GET[id_file]?>" method="post" enctype="multipart/form-data">
 
 
  <table width="515" align="center" cellpadding="5">
 
 
 <tr>
   <td height="20" bgcolor="#efefef"  >
   <input name="file_desc" type="text" size="50" value="<?=$filsel[0][file_desc]?>"  />
   Descriere fisier </td>
   </tr>
 <tr>
   <td height="20" align="center" bgcolor="#efefef"  ><input type="submit" name="s_mod" value="Salveaza" class="but" /></td>
   </tr>
</table>
</form>	

<? } else {?>

	<form action="<?=$scr?>?section=<?=$section?>&id_produs=<?=$id_produs?>" method="post" enctype="multipart/form-data">
 
 
  <table width="515" align="center" cellpadding="5">
 
 <tr>
  <td height="34" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header">
	<input type="file" name="file" size="20"></td>
  </tr>
 <tr>
   <td height="20" bgcolor="#efefef"  >
   <input name="file_desc" type="text" size="50"  />
   Descriere fisier </td>
   </tr>
 <tr>
   <td height="20" align="center" bgcolor="#efefef"  ><input type="submit" name="s_add" value="Salveaza" class="but" /></td>
   </tr>
</table>
</form>	
<? }?>
 <div align="center" class="titlu">
    <?=$_GET[msg];?>
    <br />
  
  </div>
 </fieldset>

	</td>
  </tr>
</table>

<fieldset class=""  style="width:700px;">
    <legend class="titlu"><b>Lista fisiere</b></legend> 
<table width="700" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#EFEFEF">
<tr>
<td width="95">
Denumire</td>
<td width="348">
Descriere</td>	 
<td width="42">&nbsp;</td>	 
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
<td bgcolor="#FFFFFF">
<a href="<?=$scr?>?section=<?=$section?>&edit=1&id_produs=<?=$id_produs?>&id_file=<?=$files[$j]['id_file']?>" title="Edit"    ><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>	

<a href="#" onclick="confirm_del('', '<?=$scr?>?section=<?=$section?>&tab=3&act=del&id_file=<?=$files[$j]['id_file']?>&id_produs=<?=$id_produs?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle" /></a></td>
</tr>
 <? }?>

<? }?>
</table>
</fieldset>