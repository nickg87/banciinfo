 <? include('menu_sub.php'); ?> 
<?
 

$id_produs=$_GET["id_produs"];

$prd=mysql_query_assoc("select * from erad_produse where id_produs='".$id_produs."'");

//del lost
$xz=mysql_query_assoc("delete  from erad_galerie where pic=''");

if( $_GET['act'] == 'del_pic') {
	//delete

if(is_file(PICS_DIR_THUMB . $_GET["pic"])) 
			unlink(PICS_DIR_THUMB . $_GET["pic"]);
if(is_file(PICS_DIR_LARGE . $_GET["pic"])) 
		unlink(PICS_DIR_LARGE . $_GET["pic"]);
if(is_file(PICS_DIR_MEDIU . $_GET["pic"])) 
		unlink(PICS_DIR_MEDIU . $_GET["pic"]);
if(is_file(PICS_DIR_SMALL . $_GET["pic"])) 
		unlink(PICS_DIR_SMALL . $_GET["pic"]);
mysql_query("delete from erad_galerie where id_pic='".$_GET[id_pic]."'");

	 echo js_redirect($src.'?section='.$section.'&id_produs='.$_GET['id_produs']);


}
 
if($_SESSION[tab]=='') $_SESSION[tab]=2; else  $_SESSION[tab]=$_GET[tab];

if(strlen($_GET['prim'])) {

	mysql_query("UPDATE erad_galerie SET prim = 0 WHERE id_produs = '".$_GET['id_produs']."'");
	mysql_query("UPDATE erad_galerie SET prim = '".$_GET[prim]."' WHERE id_pic = '".$_GET['id_pic']."'");
		 echo js_redirect($src.'?section='.$section.'&id_produs='.$id_produs);
}


 if(isset($_POST[s_add]) and strlen($_FILES['pic']['tmp_name'])) {


if (isset($_POST[wm])) $wm=1; else $wm=0;
 
				
$ins = mysql_query("
			INSERT INTO erad_galerie SET
			id_produs = '".$id_produs."', 
			titlu='".$_POST[titlu]."',
			descriere='".$_POST[descriere]."'
			");
$id_pic=get_last_mysql_id('erad_galerie');
$name=$id_produs.'_prd';

$u = upload_poza2('pic', PICS_DIR_MEDIU, PICS_DIR_LARGE, PICS_SIZE1, PICS_SIZE2, 'erad_galerie', 'pic', 'id_pic', $name);



 $p=mysql_query_assoc("select * from erad_galerie where id_pic='".$id_pic."'");
		
		$dest_x =  PICS_SIZE3;
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
			
			
			$dest_x =  PICS_SIZE4;
		
		
		
		$size = getimagesize(PICS_DIR_MEDIU.$p[0][pic]);
		
		
			if($size[0]>$size[1]) {
			$ratio=$size[0]/$dest_x;
			$dest_y=round($size[1]/$ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][pic], $dest_x ,$dest_y, PICS_DIR_SMALL.$p[0][pic], $quality = 90); 
			} else {
			
			$ratio = $size[1] / $dest_x;
 			$dest_y = round($size[0] / $ratio);
				resizeToFile (PICS_DIR_MEDIU.$p[0][pic], $dest_y ,$dest_x, PICS_DIR_SMALL.$p[0][pic], $quality = 90); 
			}
	
/////////////

if($wm==0) {
 
 
$SourceFile = PICS_DIR_MEDIU.$p[0][pic];
$DestinationFile = PICS_DIR_MEDIU.$p[0][pic];
watermarkImagePic ($SourceFile, SITE_DIR.'watermark_mediu.png',    $DestinationFile);


$SourceFile = PICS_DIR_LARGE.$p[0][pic];
$DestinationFile = PICS_DIR_LARGE.$p[0][pic];
watermarkImagePic ($SourceFile, SITE_DIR.'watermark_large.png',    $DestinationFile);

}
//////////////





		}

if($ins) {
 			echo js_redirect($src.'?section='.$section.'&id_produs='.$id_produs.'&cmd=add&msg=Poza adaugata');
		} else {
		//echo js_redirect($src.'?csm=content/galerie_foto.php&id_produs='.$id_produs.'&cmd=no&msg=Mai incercati');
		}


 if(isset($_POST[s_mod]) ) {
				
$upd = mysql_query("
			UPDATE  erad_galerie SET
			titlu='".$_POST[titlu]."',
			descriere='".$_POST[descriere]."'
			where 			id_pic = '".$_GET[id_pic]."' 
			
			");
 

if($upd) {
 			echo js_redirect($src.'?section='.$section.'&id_produs='.$id_produs.'&cmd=add&msg=Modificare efectuata');
		} else {
		//echo js_redirect($src.'?csm=content/galerie_foto.php&id_produs='.$id_produs.'&cmd=no&msg=Mai incercati');
		}
}
$picsel=mysql_query_assoc("select * from erad_galerie where id_pic='".$_GET[id_pic]."'");



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
   <td height="30" bgcolor="#efefef"  >
    Mergi la:
<? $nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $prd[0][id_categorie],0);  ?>

<? foreach ($nav as $n) {?>
<? if ($n[lvl]>1){ ?>
&raquo; <a href="<?=$scr?>?section=<?=$mnp1?>_0&id_categorie=<?=$n[id_categorie]?>" ><strong><?=$n[link]?></strong></a>  
<? } else {?> 
 <strong><?=$n[link]?></strong>
<? }?>
<? }?> 
   </td>
   <td align="right" bgcolor="#efefef" class="titlu">
   
    <a href="<?=get_link_produs($prd[0][id_produs], $prd[0][produs_cod])?>" target="_blank"  > <strong> <img src="img/magnifier.png" alt="vezi produsul" border="0" align="top" />Vezi articolul pe site</strong></a>   </td>
 </tr>
</table>

<br />

 
<? include "tabs.php";?>

 

 <table width="950" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
     <td height="129" align="center" valign="top">
	 
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="24"  >
	<fieldset class="">
    <legend class="titlu"><b>Upload foto</b></legend>     

	<? if ($_GET[edit]==1) {?>
	<form action="<?=$scr?>?section=<?=$section?>&id_produs=<?=$id_produs?>&id_pic=<?=$_GET[id_pic]?>" method="post" enctype="multipart/form-data">
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
<?php /*?> <tr>
   <td height="20" colspan="2" bgcolor="#efefef"  >
   <input name="descriere" type="text" size="50" value="<?=$picsel[0][descriere]?>" /> 
   Descriere foto   </td>
   </tr><?php */?>
 <tr>
   <td height="20" colspan="2" align="center" bgcolor="#efefef"  >
   <input type="submit" name="s_mod" value="Salveaza" class="but" /></td>
   </tr>
</table>
</form>	
<? } else {?>
	<form action="<?=$scr?>?section=<?=$section?>&id_produs=<?=$id_produs?>" method="post" enctype="multipart/form-data">
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
   <?php /*?> <tr>
 <tr>
   <td height="20" colspan="2" bgcolor="#efefef"  >
   <input name="descriere" type="text" size="50" /> 
   Descriere foto   </td>
   </tr>

   <td height="20" colspan="2" align="center" bgcolor="#efefef"  >
   
   <input type="checkbox" name="wm" value="0"  checked="checked"  /> Nu doresc watermark
   </td>
 </tr><?php */?>
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
$pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$id_produs."' order by prim desc, id_pic desc");

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
	 <a href="<?=$scr?>?section=<?=$section?>&prim=0&id_produs=<?=$id_produs?>&id_pic=<?=$pics[$j]['id_pic']?>"><font color="#FF5A00">Default pic </font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&prim=1&id_produs=<?=$id_produs?>&id_pic=<?=$pics[$j]['id_pic']?>">Default pic</a>
        <? } ?>	 </td>
    <td width="78" align="center" bgcolor="#efefef">
<a href="<?=$scr?>?section=<?=$section?>&edit=1&id_produs=<?=$id_produs?>&id_pic=<?=$pics[$j]['id_pic']?>" title="Edit"    ><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>	
	<a href="#" onClick="confirm_del('', '<?=$scr?>?section=<?=$section?>&act=del_pic&pic=<?=$pics[$j]['pic']?>&id_pic=<?=$pics[$j]['id_pic']?>&id_produs=<?=$id_produs?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>	</td>
  </tr>
</table>

	 <? }?>
 	<? }?> 
</fieldset>	
	</td>
   </tr>
</table>
