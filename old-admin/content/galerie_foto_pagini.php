<?

 
$id_page=$_GET["id_page"];

$pgn=mysql_query_assoc("select * from erad_pagini where id_page='".$id_page."'");

//del lost
$xz=mysql_query_assoc("delete  from erad_galerie_pagini where pic=''");

if( $_GET['act'] == 'del_pic') {
	//delete

if(is_file(PICS_DIR_THUMB . $_GET["pic"])) 
			unlink(PICS_DIR_THUMB . $_GET["pic"]);
if(is_file(PICS_DIR_LARGE . $_GET["pic"])) 
		unlink(PICS_DIR_LARGE . $_GET["pic"]);
if(is_file(PICS_DIR_MEDIU . $_GET["pic"])) 
		unlink(PICS_DIR_MEDIU . $_GET["pic"]);
mysql_query("delete from erad_galerie_pagini where id_pic='".$_GET[id_pic]."'");

	 echo js_redirect($src.'?section='.$section.'&id_page='.$_GET['id_page']);


}
 
if($_SESSION[tab]=='') $_SESSION[tab]=2; else  $_SESSION[tab]=$_GET[tab];

if(strlen($_GET['prim'])) {

	mysql_query("UPDATE erad_galerie_pagini SET prim = 0 WHERE id_page = '".$_GET['id_page']."'");
	mysql_query("UPDATE erad_galerie_pagini SET prim = '".$_GET[prim]."' WHERE id_pic = '".$_GET['id_pic']."'");
		 echo js_redirect($src.'?section='.$section.'&id_page='.$id_page);
}


 if(isset($_POST[s_add]) and strlen($_FILES['pic']['tmp_name'])) {
				
$ins = mysql_query("
			INSERT INTO erad_galerie_pagini SET
			id_page = '".$id_page."', 
			titlu='".$_POST[titlu]."',
			descriere='".$_POST[descriere]."'
			");
$id_pic=get_last_mysql_id('erad_galerie_pagini');
$name=$id_page.'_art_'. str_replace(' ','_',rtrim(basename($_FILES['pic']['name'],'.jpg')));

$u = upload_poza2('pic', PICS_DIR_MEDIU, PICS_DIR_LARGE, PICS_SIZE_ART1, PICS_SIZE_ART2, 'erad_galerie_pagini', 'pic', 'id_pic', $name);
 
 $p=mysql_query_assoc("select * from erad_galerie_pagini where id_pic='".$id_pic."'");
		
		$dest_x =  PICS_SIZE_ART3;
		
		
		$size = getimagesize(PICS_DIR_MEDIU.$p[0][pic]);
		if($size[0]>$size[1]) {
			$ratio=$size[0]/$dest_x;
		 	$dest_y=round($size[1]/$ratio); 
				resizeToFile (PICS_DIR_MEDIU.$p[0][pic], $dest_x ,$dest_y, PICS_DIR_THUMB.$p[0][pic], $quality = 90); 
			} else {
			
			$ratio = $size[1] / $dest_x;
 			$dest_y = round($size[0] / $ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][pic], $dest_y ,$dest_x, PICS_DIR_THUMB.$p[0][pic], $quality = 90); 
			}
			

		}

if($ins) {
 			echo js_redirect($src.'?section='.$section.'&id_page='.$id_page.'&cmd=add&msg=Poza adaugata');
		} else {
		//echo js_redirect($src.'?csm=content/galerie_foto.php&id_page='.$id_page.'&cmd=no&msg=Mai incercati');
		}


 if(isset($_POST[s_mod]) ) {
				
$upd = mysql_query("
			UPDATE  erad_galerie_pagini SET
			titlu='".$_POST[titlu]."',
			descriere='".$_POST[descriere]."'
			where 			id_pic = '".$_GET[id_pic]."' 
			
			");
 

if($upd) {
 			echo js_redirect($src.'?section='.$section.'&id_page='.$id_page.'&cmd=add&msg=Modificare efectuata');
		} else {
		//echo js_redirect($src.'?csm=content/galerie_foto.php&id_page='.$id_page.'&cmd=no&msg=Mai incercati');
		}
}
$picsel=mysql_query_assoc("select * from erad_galerie_pagini where id_pic='".$_GET[id_pic]."'");



?>
 <? include('menu_sub.php'); ?> 
 <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="221" height="30" bgcolor="#efefef" class="titlu"><b>
   
  <?=get_section_name($section)?> </b></td>
 
  <td width="716" height="30" bgcolor="#efefef" class="titlu">Galerie foto pagina ID: <?=$id_page?> / <strong><?=$pgn[0][titlu_stire]?></strong></td>
 </tr>
</table>
<br />

 
<? include "tabs_pagini.php";?>

 

 <table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="129" align="center" valign="top">
	 
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="24"  >
	<fieldset class="">
    <legend class="titlu"><b>Upload foto</b></legend>     

	<? if ($_GET[edit]==1) {?>
				<form action="<?=$scr?>?section=<?=$section?>&id_page=<?=$id_page?>&id_pic=<?=$_GET[id_pic]?>" method="post" enctype="multipart/form-data">
			  <div align="center" class="titlu">
				<?=$_GET[msg];?>
				<br />
			  
			  </div>
			 
			 <a href="#" onClick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$picsel[0]['pic']?>', '<?=$s[0]?>', '<?=$s[1]?>')">
					<img src="<?=PICS_URL_THUMB?><?=$picsel[0]['pic']?>" border="1"    align="middle" style="float:left;"  ></a>
			  <table width="515" align="center" cellpadding="5">
			 
			 
			 <tr>
			   <td height="20" colspan="2" bgcolor="#efefef"  >
			   <input name="titlu" type="text" size="50" value="<?=$picsel[0][titlu]?>"  /> 
			   Titlu foto   </td>
			   </tr>
			 <tr>
			   <td height="20" colspan="2" bgcolor="#efefef"  >
			   <input name="descriere" type="text" size="50" value="<?=$picsel[0][descriere]?>" /> 
			   Descriere foto   </td>
			   </tr>
			 <tr>
			   <td height="20" colspan="2" align="center" bgcolor="#efefef"  >
			   <input type="submit" name="s_mod" value="Salveaza" class="but" /></td>
			   </tr>
			</table>
			</form>	


<? } else {?>

			
				<form action="<?=$scr?>?section=<?=$section?>&id_page=<?=$id_page?>" method="post" enctype="multipart/form-data">
			  <div align="center" class="titlu">
				<?=$_GET[msg];?>
				<br />
			  
			  </div>
			 
			 
			  <table width="515" align="center" cellpadding="5">
			 
			 <tr>
			  <td height="34" colspan="2" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header">
				<input type="file" name="pic" size="20"> 
				<font style="font-size:9px; font-family:tahoma;">	(1 MB max. & jpg recomandat)</font>  </td>
			  </tr>
			 <tr>
			   <td height="20" colspan="2" bgcolor="#efefef"  >
			   <input name="titlu" type="text" size="50"  /> 
			   Titlu foto   </td>
			   </tr>
			 <tr>
			   <td height="20" colspan="2" bgcolor="#efefef"  >
			   <input name="descriere" type="text" size="50" /> 
			   Descriere foto   </td>
			   </tr>
			 <tr>
			   <td height="20" colspan="2" align="center" bgcolor="#efefef"  ><input type="submit" name="s_add" value="Salveaza" class="but" /></td>
			   </tr>
			</table>
			</form>

<? }?>

</fieldset>
	</td>
  </tr>
</table>
 
 <fieldset class="" style="width:700px;">
    <legend class="titlu"><b>Galerie foto</b></legend>     
 
	<? 
$pics=mysql_query_assoc("select * from erad_galerie_pagini where id_page='".$id_page."' order by prim desc, id_pic desc");

for($j=0; $j<count($pics); $j++){?>


<? if(is_file(PICS_DIR_THUMB . $pics[$j]['pic'])) {?>
	
	
	<table width="700" border="0" align="center" cellpadding="2" cellspacing="2" style="border:1px solid #ccc; margin:5px;">
  <tr>
    <td width="93" align="center" valign="middle" bgcolor="#efefef">
	 <a href="#" onClick="show_large_pic('div_abs', '<?=PICS_URL_LARGE?><?=$pics[$j]['pic']?>', '<?=$s[0]?>', '<?=$s[1]?>')">
	    <img src="<?=PICS_URL_THUMB?><?=$pics[$j]['pic']?>" border="1"    align="middle"   width="50" ></a>	</td>
    <td width="383" bgcolor="#efefef">
	<strong>Titlu:</strong> 
	<?=$pics[$j]['titlu']?>
	<br />
	<br />

    <strong>Descriere:</strong>    <?=$pics[$j]['descriere']?>	</td>
    <td width="106" align="center">
	<? if($pics[$j]['prim'] == 1) { ?>
	 <a href="<?=$scr?>?section=<?=$section?>&prim=0&id_page=<?=$id_page?>&id_pic=<?=$pics[$j]['id_pic']?>"><font color="#FF5A00">Default pic </font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&prim=1&id_page=<?=$id_page?>&id_pic=<?=$pics[$j]['id_pic']?>">Default pic</a>
        <? } ?>	 </td>
    <td width="78" align="center" bgcolor="#efefef">
<a href="<?=$scr?>?section=<?=$section?>&edit=1&id_page=<?=$id_page?>&id_pic=<?=$pics[$j]['id_pic']?>" title="Edit"    ><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>	
	<a href="#" onClick="confirm_del('', '<?=$src?>?section=<?=$section?>&act=del_pic&pic=<?=$pics[$j]['pic']?>&id_pic=<?=$pics[$j]['id_pic']?>&id_page=<?=$id_page?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>	</td>
  </tr>
</table>

	 <? }?>
 	<? }?> 
</fieldset>	
	</td>
   </tr>
</table>
