 <? include('menu_sub.php'); ?> 

<?
if(is_numeric($_GET['id_campanie']) && $_GET['act'] == 'del_c') {
	//delete

	$fx=mysql_query_assoc("select * from erad_bannere where id_campanie = '".$_GET['id_campanie']."'");
	
	foreach($fx as $fr) {
	 
	if (is_file(BANNERS_DIR.$fr[banner])) unlink (BANNERS_DIR.$fr[banner]);
	
	} 

	mysql_query("DELETE FROM erad_bannere WHERE id_campanie = '".$_GET['id_campanie']."'");
	echo js_redirect($scr.'?section='.$section);
}

if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_bannere SET activ = '".$_GET['set_activ']."' WHERE id_campanie = '".$_GET['id_campanie']."'");
	echo js_redirect($scr.'?section='.$section);
} 

$campanii = mysql_query_assoc("
	SELECT * FROM  erad_bannere  
		order by id_campanie desc
	");

$today=date('Y-m-d');
$nr_pg = 100;
if(is_numeric($_GET['cnt']) && $_GET['cnt'] >= 0)
	$_SESSION['judet_cnt'] = $_GET['cnt'];
else 
	$_SESSION['judet_cnt'] = $_SESSION['judet_cnt'] != 0 ? $_SESSION['judet_cnt'] : 0;
$cnt = $_SESSION['judet_cnt'];
$prev = $cnt - $nr_pg;
if($prev >= 0) $prev = $prev < 0 ? 0 : $prev;
else $prev = -1;
$next = $cnt + $nr_pg;
$next = $next > count($campanii) ? count($campanii) : $next;

?>


<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="73%" height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
 
   
 </tr>
</table>

<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
 
 <tr>
  <td width="3%" align="right" background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header"><strong>ID</strong></td>
  <td width="65%" bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"><strong>Denumire</strong></td>
  <td width="5%" bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"><strong>Activ</strong></td>
  <td width="80" bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"><strong>Poza</strong></td>
  <td width="108" bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"><strong>Tip banner </strong></td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
$k = -1;
for($i=$cnt; $i<$cnt+$nr_pg; $i++) { 
if(is_array($campanii[$i])) { $k++;
?>

 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'">
  <td height="20" align="right"  style="border-bottom:1px solid #ccc;  <? if($campanii[$i]['activ']==0) { ?>  color:#ccc; <? }?> "><?=$campanii[$i]['id_campanie']?></td>
  <td style="border-bottom:1px solid #ccc;">
  <a style="text-decoration:none" href="<?=$scr?>?section=<?=$mnp1?>_2&id_campanie=<?=$campanii[$i]['id_campanie']?>" title="Edit">
  <?=$campanii[$i]['denumire_campanie']?></a>
  </td>

<td height="20" align="center"  style="border-bottom:1px solid #ccc;   "  >
  <? if($campanii[$i]['activ'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_campanie=<?=$campanii[$i]['id_campanie']?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_campanie=<?=$campanii[$i]['id_campanie']?>">nu</a>
        <? } ?> 
</td>
  
  
    <td align="center" style="border-bottom:1px solid #ccc;">
	  <? if(is_file(BANNERS_DIR .$campanii[$i][banner])) { ?>
      <? if ($campanii[$i]['tip_fisier']<>1) { ?>
   <img src="<?=BANNERS_URL?><?=$campanii[$i][banner]?>" height="50" style="max-width:100px; overflow:hidden"     />
   <? } else { ?>
   <img src="<?=SITE_URL?>admin/img/flash.png" height="50"     />
   <? } } else {?>
   <img src="<?=SITE_URL?>admin/img/2parale.jpg" height="25"     />
   <? } ?>

    </td>
  <td align="center" style="border-bottom:1px solid #ccc;"><b><?=$pozitii_banner[$campanii[$i]['tip_banner']]?></b></td>
  <? if (strtotime($campanii[$i][data_stop])<strtotime($today) )  $expirat=1; else $expirat=0; ?>
  <td style="border-bottom:1px solid #ccc;" width="144" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&id_campanie=<?=$campanii[$i]['id_campanie']?>" title="Edit"><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  		&nbsp;&nbsp;&nbsp;
			<a href="#" onClick="confirm_del('<?=$campanii[$i]['denumire_firma']?>', '<?=$scr?>?section=<?=$section?>&act=del_c&id_campanie=<?=$campanii[$i]['id_campanie']?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>


