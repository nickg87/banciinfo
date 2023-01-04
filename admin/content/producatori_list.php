 <? include('menu_sub.php'); ?> 

<?

if(isset($_GET['move_type']) && isset($_GET['id_producator'])) {
	//$extra = " AND id_ziar = '".$_SESSION['id_ziar_cat']."'";
	move_order('erad_producatori', 'id_producator', 'ord', $_GET['id_producator'], $_GET['move_type'], $extra);
	 update_order('erad_producatori', 'id_producator', 'ord',$extra ); 
	 echo js_redirect($scr.'?id_producator='.$_GET["id_producator"]);
}


if(is_numeric($_GET['id_producator']) && $_GET['act'] == 'del_categ') {
	//delete
$pr = mysql_query_assoc("SELECT * FROM erad_producatori where id_producator= '".$_GET['id_producator']."'");
 if(is_file(PICS_DIR_THUMB . $pr[0]["pic"])) 
			unlink(PICS_DIR_THUMB . $pr[0]["pic"]);
 if(is_file(PICS_DIR_LARGE . $pr[0]["pic"])) 
			unlink(PICS_DIR_LARGE . $pr[0]["pic"]);			

	mysql_query("DELETE FROM erad_producatori WHERE id_producator = '".$_GET['id_producator']."'");
 	echo js_redirect($scr);
}

$categ = mysql_query_assoc("SELECT * FROM erad_producatori ORDER BY `ord` ASC");

$nr_pg = 44;
if(is_numeric($_GET['cnt']) && $_GET['cnt'] >= 0)
	$_SESSION['judet_cnt'] = $_GET['cnt'];
else 
	$_SESSION['judet_cnt'] = $_SESSION['judet_cnt'] != 0 ? $_SESSION['judet_cnt'] : 0;
$cnt = $_SESSION['judet_cnt'];
$prev = $cnt - $nr_pg;
if($prev >= 0) $prev = $prev < 0 ? 0 : $prev;
else $prev = -1;
$next = $cnt + $nr_pg;
$next = $next > count($categ) ? count($categ) : $next;

?>

<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 <tr>
  <td bgcolor="#E5E9EB" colspan="5" height="30"><b>Liseaza categ</b></td>
 </tr>
 <tr>
  <td width="143" align="right" bgcolor="#EFEFEF">ord</td>
  <td width="421" align="right" bgcolor="#EFEFEF"><b>Domenii</b></td>
  <td width="321" bgcolor="#EFEFEF">&nbsp;</td>
  <td width="145" bgcolor="#EFEFEF">&nbsp;</td>
  <td bgcolor="#EFEFEF"></td>
 </tr>
<?
$k = -1;
for($i=$cnt; $i<$cnt+$nr_pg; $i++) { 
if(is_array($categ[$i])) { $k++;
?>
 <tr>
  <td height="20" align="right" bgcolor="<?=($k%2==1?'#EFEFEF':'#ffffff')?>">
   <a href="<?=$scr?>?move_type=up&id_producator=<?=$categ[$i]["id_producator"]?>" title="move up"><img src="img/up.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle" /></a> 
   <a href="<?=$scr?>?move_type=down&id_producator=<?=$categ[$i]["id_producator"]?>" title="move down"><img src="img/down.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle" /></a> 
  </td>
  <td height="20" align="right" bgcolor="<?=($k%2==1?'#EFEFEF':'#ffffff')?>"><?=$categ[$i]['producator']?></td>
  <td bgcolor="<?=($k%2==1?'#EFEFEF':'#ffffff')?>">&nbsp;</td>
  <td bgcolor="<?=($k%2==1?'#EFEFEF':'#ffffff')?>">&nbsp;</td>
  <td bgcolor="<?=($k%2==1?'#EFEFEF':'#ffffff')?>" width="143" align="center">
  		<a href="<?=$scr?>?csm=content/producatori_mod.php&act=edit&id_producator=<?=$categ[$i]['id_producator']?>" title="Edit"><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$categ[$i]['producator']?>', '<?=$scr?>?act=del_categ&id_producator=<?=$categ[$i]['id_producator']?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>


<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
 <tr>
  <td bgcolor="#EFEFEF" width="293" valign="middle" align="left" height="30"><? if($prev >= 0) { ?><a href="<?=$scr?>?cnt=<?=$prev?>">&laquo;&laquo; previous</a><? }else{ echo '&nbsp;'; } ?></td>
  <td bgcolor="#EFEFEF" width="613" align="center" valign="middle">
  <? for($i=0; $i<count($categ); $i+=$nr_pg) { ?>
  	<a href="<?=$scr?>?cnt=<?=$i?>"><?=(($cnt==$i)?'<font color="#0B6ABF">':'')?><?=$i/$nr_pg+1?><?=(($cnt==$i)?'</font>':'')?></a>
  <? } ?>  </td>
  <td bgcolor="#EFEFEF" width="26%" valign="middle" align="right"><? if($next < count($categ)) { ?><a href="<?=$scr?>?cnt=<?=$next?>">next &raquo;&raquo;</a><? }else{ echo '&nbsp;'; } ?></td>
 </tr>
</table>
