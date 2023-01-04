 <? include('menu_sub.php'); ?> 

<?

// update_order('erad_brands', 'id_brand', 'ord',$extra ); 

if(is_numeric($_GET['id_brand']) && $_GET['act'] == 'del') {
	//delete
	$brd=mysql_query_assoc("select logo_brand from erad_brands where id_brand='".$_GET['id_brand']."'");
	//delete
 if(is_file(PICS_DIR_THUMB . $brd[0]['logo_brand'])) 
			unlink(PICS_DIR_THUMB . $brd[0]['logo_brand']);
  if(is_file(PICS_DIR_MEDIU .$brd[0]['logo_brand'])) 
			unlink(PICS_DIR_MEDIU . $brd[0]['logo_brand']); 
			
	mysql_query("DELETE FROM erad_brands WHERE id_brand = '".$_GET['id_brand']."'");
	mysql_query("DELETE FROM erad_brands_certificari WHERE id_brand = '".$_GET['id_brand']."'"); 
	 update_order('erad_brands', 'id_brand', 'ord',$extra ); 
 	echo js_redirect($scr.'?section='.$section);
}


if(isset($_GET['new_move']) && isset($_GET['id_move'])) {
	 
 
	new_order('erad_brands', 'id_brand', 'ord', $_GET['id_move'], $_GET['new_move'], '');
	 // update_order('erad_brands', 'id_brand', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&coloana='.$_GET["coloana"]);
}


if(strlen($_GET['set_activb'])) {
	mysql_query("UPDATE erad_brands SET activb = '".$_GET['set_activb']."' WHERE id_brand = '".$_GET['id_brand']."'");
	echo js_redirect($scr.'?section='.$section);
}
 

 
 $brands = mysql_query_assoc("select * from erad_brands order by ord");


$it=$brands;

$interval = mysql_query_assoc("
	SELECT   min(erad_brands.ord) as min,  max(erad_brands.ord) as max from  erad_brands  
	 
");
$min=$interval[0]['min'];
$max=$interval[0]['max'];


if(!$_GET['cnt'] )$_SESSION['fact_cnt']=0; 
$nr_pg = 25;
if(is_numeric($_GET['cnt']) && $_GET['cnt'] >= 0)
	$_SESSION['fact_cnt'] = $_GET['cnt'];
else 
	$_SESSION['fact_cnt'] = $_SESSION['fact_cnt'] != 0 ? $_SESSION['fact_cnt'] : 0;
$cnt = $_SESSION['fact_cnt'];
$prev = $cnt - $nr_pg;
if($prev >= 0) $prev = $prev < 0 ? 0 : $prev;
else $prev = -1;
$next = $cnt + $nr_pg;
$next = $next > count($it) ? count($it) : $next;
 
 
?>


 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  <td height="30" bgcolor="#efefef">
    </td>
  </tr>
</table>

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:800px; height:20px; border:2px solid #ccc; background-color:#efefef; padding:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>

 <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="10" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Nr.</b></td>
  <td width="11" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><strong>Ord</strong></td>
  <td colspan="2" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Denumire</b></td>
  <td width="63" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 

<?
$k = -1;
for($i=$cnt; $i<$cnt+$nr_pg; $i++) { 
if(is_array($it[$i])) { $k++;
 
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="25" align="center" nowrap="nowrap" >
<?=$i+1?></td>
  <td align="center" nowrap="nowrap" >
  
  <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
		 <? for($c=$min; $c<=$max; $c++) {?>
            <option value="<?=$scr?>?section=<?=$section?>&new_move=<?=$c?>&id_move=<?=$it[$i]["id_brand"]?>" <?=selected($c,$it[$i]["ord"])?> ><?=$c?></option>
        <? }?>
   </select>
  
  </td>
  <td width="630" valign="middle"    style="margin-top:-4px;  " >
 &nbsp;&nbsp;<?=$it[$i]['denumire_brand']?> </td>
  <td width="318" valign="middle"    style="margin-top:-4px;  " >
  <? if(is_file(PICS_DIR_THUMB .$it[$i][logo_brand])) { ?>
   <img src="<?=PICS_URL_THUMB?><?=$it[$i][logo_brand]?>" height="40"     />
  
   <? }?>  </td>
  <td align="center"  >
<? /*
<? if($it[$i]['activb'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activb=0&id_brand=<?=$it[$i]['id_brand']?><?=$xtras?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activb=1&id_brand=<?=$it[$i]['id_brand']?><?=$xtras?>">nu</a>
    <? } ?>
*/?>
  </td>
  <td   width="93" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_1&cmd=edit&id_brand=<?=$it[$i]['id_brand']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('', '<?=$scr?>?section=<?=$section?>&act=del&id_brand=<?=$it[$i]['id_brand']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } }?>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="0"  bgcolor="#B5C6CF">
   <tr>
     <td bgcolor="#CCCCCC" width="25%" valign="middle" align="right" height="30">
	 <? if($prev >= 0) { ?>
         <a href="<?=$scr?>?section=<?=$section?>&cnt=<?=$prev?>&keyword=<?=$keyword?>&<?=$nex?>" class="but">&laquo;&laquo; previous</a>
       <? }else{ echo '&nbsp;'; } ?></td>
     <td bgcolor="#CCCCCC" width="10%" align="center" valign="middle">
	 
	 Pagina:	
	   <select onchange="window.open(this.options[this.selectedIndex].value,'_self')">
	
	 <? for($i=0; $i<count($it); $i+=$nr_pg) { ?>
<option value="<?=$scr?>?section=<?=$section?>&cnt=<?=$i?>&keyword=<?=$keyword?>" <?=selected($i,$cnt );?>>

           <?=(($cnt==$i)?'<font color="#0B6ABF">':'')?>
           <?=$i/$nr_pg+1?>
           <?=(($cnt==$i)?'</font>':'')?>
</option>
         <? } ?>
	 </select>
     </td>
     <td bgcolor="#CCCCCC" width="25%" valign="middle" align="left"><? if($next < count($it)) { ?>
         <a href="<?=$scr?>?section=<?=$section?>&cnt=<?=$next?>&keyword=<?=$keyword?>" class="but">next &raquo;&raquo;</a>
       <? }else{ echo '&nbsp;'; } ?></td>
   </tr>
</table>

