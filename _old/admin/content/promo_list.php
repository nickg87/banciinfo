<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
 <? include('menu_sub.php'); ?> 

<?
 update_order('erad_promotii', 'id_promotie', 'ord','' );
if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_promotii SET activ = '".$_GET['set_activ']."' WHERE id_promotie = '".$_GET['id_promotie']."'");
	echo js_redirect($scr.'?section='.$section);
}

if(is_numeric($_GET['id_promotie']) && $_GET['act'] == 'del') {
	//delete

$q=mysql_query_assoc("select * FROM erad_promotii WHERE id_promotie = '".$_GET['id_promotie']."'");

 if(is_file(PICS_DIR_PROMO . $q[0]['pic'])) 
			unlink(PICS_DIR_PROMO . $q[0]['pic']);
 for ($j==1; $j<5; $j++) { 
if(is_file(PICS_DIR_PROMO . $q[0]['poza'.$j])) 
			unlink(PICS_DIR_PROMO . $q[0]['poza'.$j]);
}

 	mysql_query("DELETE FROM erad_promotii WHERE id_promotie = '".$_GET['id_promotie']."'");
	update_order('erad_promotii', 'id_promotie', 'ord','' ); 
	echo js_redirect($scr.'?section='.$section);
}

if(isset($_GET['new_move']) && isset($_GET['id_move']) ) {
	 new_order('erad_promotii', 'id_promotie', 'ord', $_GET['id_move'], $_GET['new_move'], '');
	 // update_order('erad_produse', 'id_produs', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&id_categorie='.$_GET["id_categorie"]);
}


//update_order('erad_promotii', 'id_promotie', 'ord','' ); 

 $promotii=mysql_query_assoc("select * from erad_promotii order by ord");
 
 $interval = mysql_query_assoc("	SELECT   min(erad_promotii.ord) as min,  max(erad_promotii.ord) as max from  erad_promotii   ");

$min=$interval[0]['min'];
$max=$interval[0]['max'];


?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
  <td height="30" bgcolor="#efefef">
     </td>
  </tr>
</table> 

<br />

<table width="95%">
 <tr>
  <td width="18" height="25" align="center"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>ID </b></td>
  <td width="20" height="25" align="center"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;</td>
  <td width="447"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;&nbsp;<b>Promotie</b></td>
  <td width="80"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;&nbsp;<b>Imagine</b></td>
  <td width="70" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;&nbsp;<strong>Activ</strong></td>
  <td  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"></td>
 </tr>


<?
for($i = 0; $i < count($promotii); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td  height="36" align="center"> <?=$promotii[$i]['id_promotie']?>  </td>
  <td align="center">
  
 
     <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
		 <? for($c=$min; $c<=$max; $c++) {?>
            <option value="<?=$scr?>?section=<?=$section?>&new_move=<?=$c?>&id_move=<?=$promotii[$i]['id_promotie']?>" <?=selected($c,$promotii[$i]["ord"])?> ><?=$c?></option>
        <? }?>
   </select>
 
  
  </td>
  <td >
  &nbsp;&nbsp;
  <a style="text-decoration:none;" href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_promotie=<?=$promotii[$i]['id_promotie']?>" title="Edit">
    <strong><?=$promotii[$i]['nume_promotie']?></strong></a>  </td>
  <td align="center" >
	  <? if(is_file(PICS_DIR_PROMO .$promotii[$i][pic])) { ?>
   <img src="<?=PICS_URL_PROMO?><?=$promotii[$i][pic]?>" height="50" style="max-width:100px; overflow:hidden"     />
   <? }  ?>
  </td>
  <td align="center" >
  <? if($promotii[$i]['activ'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_promotie=<?=$promotii[$i]['id_promotie']?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_promotie=<?=$promotii[$i]['id_promotie']?>">nu</a>
        <? } ?>  </td>
  <td  width="117" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_promotie=<?=$promotii[$i]['id_promotie']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$promotii[$i]['nume_promotie']?>', '<?=$scr?>?section=<?=$section?>&act=del&id_promotie=<?=$promotii[$i]['id_promotie']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


