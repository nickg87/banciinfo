<?
  $id_page=$_GET[id_page];
$pgn=mysql_query_assoc("select * from erad_pagini where id_page='".$id_page."'");

if( $_GET['act'] == 'del') {
	//delete
$filsel=mysql_query_assoc("select * from erad_fisiere where id_file='".$_GET[id_file]."'");

if(is_file(FILE_DIR . $filsel[0]["file"])) 
			unlink(FILE_DIR . $filsel[0]["file"]);
 
mysql_query("delete from erad_fisiere_pagini where id_file='".$_GET[id_file]."'");

	 echo js_redirect($src.'?section='.$section.'&id_page='.$_GET['id_page']);


}
 if($_SESSION[tab]=='') $_SESSION[tab]=1; else  $_SESSION[tab]=$_GET[tab];


 if(isset($_POST[s_add]) and strlen($_FILES['file']['tmp_name'])) {
$next=get_next_mysql_id('erad_fisiere_pagini');	 
		   $target_path = FILE_DIR;
		//$target_path = "d:/_php/www/_private/ssm/admin/factura/";
		$target_path = $target_path .$id_page.'_'.'a_'.$next. basename($_FILES['file']['name']);
		$name=$id_page.'_'.'a_'.$next. basename($_FILES['file']['name']);

		if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
$ins = mysql_query("
			INSERT INTO erad_fisiere_pagini SET
			id_page = '".$id_page."',
			file='".$name."',
			file_desc='".$_POST['file_desc']."'
			");
			
		     $msg= "Fisierul ". basename($_FILES['file']['name']). " a fost uploadat";
		} else{
		     $msg= "There was an error uploading the file, please try again!";
		}
	 
  echo js_redirect($src.'?section='.$section.'&id_page='.$_GET['id_page'].'&msg='.$msg);
}


  if(isset($_POST[s_mod]) ) {
				
$upd = mysql_query("
			UPDATE  erad_fisiere_pagini SET
			file_desc='".$_POST[file_desc]."' 
			where id_file = '".$_GET[id_file]."' 
				");
 

if($upd) {
 			echo js_redirect($src.'?section='.$section.'&id_page='.$id_page.'&cmd=add&msg=Modificare efectuata');
		} else {
		//echo js_redirect($src.'?csm=content/galerie_foto.php&id_page='.$id_page.'&cmd=no&msg=Mai incercati');
		}
}
$filsel=mysql_query_assoc("select * from erad_fisiere_pagini where id_file='".$_GET[id_file]."'");


?>
 
 <? include('menu_sub.php'); ?> 
 <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="221" height="30" bgcolor="#efefef" class="titlu"><b>
   
  <? 
  if(strlen($_SESSION['cm_title']) > 0) echo '   '.$_SESSION['cm_title']; 
  ?> / Editeaza Articol </b></td>
 
  <td width="716" height="30" bgcolor="#efefef" class="titlu">Arhiva fisiere articol ID: <?=$id_page?> /<strong> <?=$pgn[0][titlu_stire]?></strong></td>
 </tr>
</table>
<br />

 
<? include "tabs_pagini.php";?>

<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="24"  >
<fieldset class="">
    <legend class="titlu"><b>Upload fisier</b></legend> 
<br />
<br />
	<? if ($_GET[edit]==1) {?>
	<form action="<?=$scr?>?section=<?=$section?>&id_page=<?=$id_page?>&id_file=<?=$_GET[id_file]?>" method="post" enctype="multipart/form-data">
 
 
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

	<form action="<?=$scr?>?section=<?=$section?>&id_page=<?=$id_page?>" method="post" enctype="multipart/form-data">
 
 
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
$files=mysql_query_assoc("select * from erad_fisiere_pagini where id_page='".$id_page."'");

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
<a href="<?=$scr?>?section=<?=$section?>&edit=1&id_page=<?=$id_page?>&id_file=<?=$files[$j]['id_file']?>" title="Edit"    ><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>	

<a href="#" onclick="confirm_del('', '<?=$src?>?section=<?=$section?>&act=del&id_file=<?=$files[$j]['id_file']?>&id_page=<?=$id_page?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle" /></a></td>
</tr>
 <? }?>

<? }?>
</table>
 </fieldset>