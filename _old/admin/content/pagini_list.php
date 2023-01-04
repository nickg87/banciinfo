 <? include('menu_sub.php'); ?> 

<?
$id_meniu=$_GET[id_meniu];
if(isset($_GET['move_type']) && isset($_GET['id_page'])) {
	//$extra = " AND id_ziar = '".$_SESSION['id_ziar_cat']."'";
	move_order('erad_pagini', 'id_page', 'ord', $_GET['id_page'], $_GET['move_type'], $extra);
	 update_order('erad_pagini', 'id_page', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&id_meniu='.$id_meniu);
}


if(strlen($_GET['set_lateral'])) {
	mysql_query("UPDATE erad_pagini SET lateral = '".$_GET['set_lateral']."' WHERE id_page = '".$_GET['id_page']."'");
	echo js_redirect($scr.'?section='.$section.'&id_meniu='.$id_meniu);
}

if(strlen($_GET['set_principal'])) {
	mysql_query("UPDATE erad_pagini SET principal = '".$_GET['set_principal']."' WHERE id_page = '".$_GET['id_page']."'");
	echo js_redirect($scr.'?section='.$section.'&id_meniu='.$id_meniu);
}

if(strlen($_GET['set_home'])) {
	mysql_query("UPDATE erad_pagini SET home = '".$_GET['set_home']."' WHERE id_page = '".$_GET['id_page']."'");
	echo js_redirect($scr.'?section='.$section.'&id_meniu='.$id_meniu);
}


if(is_numeric($_GET['id_page']) && $_GET['act'] == 'del_news') {
	//delete
 
$pics=mysql_query_assoc("select * from erad_galerie_pagini where id_page='".$_GET[id_page]."'");

for($j=0; $j<count($pics); $j++){
 if(is_file(PICS_DIR_THUMB . $pics[$j]["pic"])) 
			unlink(PICS_DIR_THUMB . $pics[$j]["pic"]);
if(is_file(PICS_DIR_LARGE . $pics[$j]["pic"])) 
		unlink(PICS_DIR_LARGE . $pics[$j]["pic"]);
if(is_file(PICS_DIR_MEDIU . $pics[$j]["pic"])) 
		unlink(PICS_DIR_MEDIU . $pics[$j]["pic"]);
}
 

$files=mysql_query_assoc("select * from erad_fisiere_pagini where id_page='".$_GET[id_page]."'");
for($j=0; $j<count($files); $j++){
 if(is_file(FILE_DIR . $files[$j]["file"])) 
			unlink(FILE_DIR . $files[$j]["file"]);
 
}
 mysql_query("DELETE FROM erad_fisiere_pagini WHERE id_page = '".$_GET['id_page']."'");
 mysql_query("DELETE FROM erad_galerie_pagini WHERE id_page = '".$_GET['id_page']."'");
 mysql_query("DELETE FROM erad_pagini WHERE id_page = '".$_GET['id_page']."'");
 
		update_order('erad_pagini', 'id_page', 'ord', "AND id_meniu = '".$id_meniu."'");
	echo js_redirect($scr.'?section='.$section.'&id_meniu='.$id_meniu);
}

// $extra= ' AND id_meniu = '.$id_meniu;
// update_order('erad_pagini', 'id_page', 'ord',$extra ); 

if(isset($_GET['new_move']) && isset($_GET['id_move']) ) {
$extra= ' AND id_meniu = '.$id_meniu;
	 
	 new_order('erad_pagini', 'id_page', 'ord', $_GET['id_move'], $_GET['new_move'], $extra);
 // update_order('erad_produse', 'id_produs', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&id_meniu='.$id_meniu);
} 


 
 
$pagini = mysql_query_assoc("
	SELECT erad_pagini.*, erad_pagini.ord as ord, zona_meniu FROM erad_pagini 
	left join erad_meniu_set on erad_pagini.id_meniu=erad_meniu_set.id_meniu  
	where erad_pagini.id_meniu='".$id_meniu."'  ORDER BY  erad_pagini.ord asc
");
//print_r($pagini);


 
 $interval = mysql_query_assoc("	SELECT   min(erad_pagini.ord) as min,  max(erad_pagini.ord) as max from  erad_pagini  where erad_pagini.id_meniu='".$id_meniu."'   ");

  $min=$interval[0]['min'];
  $max=$interval[0]['max'];




?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
 
 </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>



<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef"> 
   Subpagini ale meniului: 
   <?    $meniuri = mysql_query_assoc("select * from erad_meniu_set order by link_meniu");?>

	<select name="id_meniu" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
<option value="<?=$src?>"> --- Alege item meniu ---- </option>
	<? foreach ($meniuri as $mnu) {
	 $pgs = mysql_query_assoc("select id_page from erad_pagini where id_meniu='".$mnu[id_meniu]."'");
	?>
	<option value="<?=$src?>?section=<?=$section?>&id_meniu=<?=$mnu[id_meniu]?>" <?=selected($mnu[id_meniu], $id_meniu);?>><?=$mnu[link_meniu]?> (<?=count($pgs);?>)</option>
	<? }?>
	</select>
	
    </td>
  
  </tr>
</table>
<br />
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
  
 <tr>
  <td width="31" height="20" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header">ID</td>
  <td width="75" background="img/butbk.jpg" bgcolor="#f5f5f5"   class="titlu_header"><strong>Ord</strong></td>
  <td width="82" background="img/butbk.jpg" bgcolor="#f5f5f5"   class="titlu_header"><strong>Poza</strong></td>
  <td width="453" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"><b>Titlu</b></td>
  <td width="112" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"><b>Meniu</b></td>
  <td bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
$k = -1; 
for($i = 0; $i < count($pagini); $i++) {
if(is_array($pagini[$i])) { $k++;
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38"  ><?=$pagini[$i]["id_page"]?>  </td>
  <td height="38" align="center"  > 
 
 
 <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
		 <? for($c=$min; $c<=$max; $c++) {?>
            <option value="<?=$scr?>?section=<?=$section?>&new_move=<?=$c?>&id_move=<?=$pagini[$i]["id_page"]?>&id_meniu=<?=$id_meniu?>" <?=selected($c,$pagini[$i]["ord"])?> ><?=$c?> </option>
        <? }?>
   </select>
 
  </td>
  <td  > 
  <? 
$pic = mysql_query_assoc(" select * from erad_galerie_pagini where id_page='".$pagini[$i]['id_page']."' order by prim desc");

?>
        <? if(is_file(PICS_DIR_THUMB . $pic[0][pic])) {?>
        <img src="<?=PICS_URL_THUMB?><?=$pic[0][pic]?>" border="1"  width="40" height="40"    align="middle" />
        <? } else {?>
      -
      <? }?>  </td>
  <td><?=$pagini[$i]['titlu_stire']?></td>
  <td><?=$meniu_set[$pagini[$i]['zona_meniu']]?></td>
  <td width="76" align="center" nowrap="nowrap">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_5&act=edit&id_page=<?=$pagini[$i]['id_page']?>" title="Edit"><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  		 &nbsp;
  		<a href="#" onClick="confirm_del('', '<?=$scr?>?section=<?=$section?>&act=del_news&id_page=<?=$pagini[$i]['id_page']?>&id_meniu=<?=$id_meniu?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>


