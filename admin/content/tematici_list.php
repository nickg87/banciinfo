 <? include('menu_sub.php'); ?> 

<?
if(is_numeric($_GET['id_tematica']) && $_GET['act'] == 'del') {
	//delete
 $catx = get_cat_list_rec('erad_tematici', 'id_tematica', 'denumire_institutie', 'ord', $catx, $_GET['id_tematica'], 0);
 

 $catx[][id_tematica]=$_GET[id_tematica];
// print_r($catx);
 
for ($i=0;$i<count($catx); $i++) {
   
mysql_query("DELETE FROM erad_produse_tematici WHERE id_tematica = '".$catx[$i]['id_tematica']."'");
mysql_query("DELETE FROM erad_tematici WHERE id_tematica = '".$catx[$i]['id_tematica']."'");
	 
	}

 
	
 	  echo js_redirect($scr.'?section='.$section);
}
 
 
if(strlen($_GET['set_footer'])) {
	mysql_query("UPDATE erad_tematici SET footer = '".$_GET['set_footer']."' WHERE id_tematica = '".$_GET['id_tematica']."'");
	echo js_redirect($scr.'?section='.$section);
}
 
if(isset($_GET['new_move']) && isset($_GET['id_move'])) {
	 
 
	new_order('erad_tematici', 'id_tematica', 'ord', $_GET['id_move'], $_GET['new_move'], '');
	 // update_order('erad_brands', 'id_brand', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section);
}

 
$interval = mysql_query_assoc("
	SELECT   min(erad_tematici.ord) as min,  max(erad_tematici.ord) as max from  erad_tematici  
	 
");
$min=$interval[0]['min'];
$max=$interval[0]['max'];

 


 $tematici = mysql_query_assoc("select * from erad_tematici
 order by ord asc");

 // $tematici = get_cat_list_rec('erad_tematici',  'id_tematica', 'denumire_institutie', 'ord', $tematici, 0,0);
?>





 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  
   
   </td>
 
  
  </tr>
</table>
 
 
 <br />
 
 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>

 <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td align="center" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>ID</b></td>
  <td align="center" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Ordonare</b></td>
  <td width="653" background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Tematica</b></td>
  <td align="center" width="55" background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Logo</b></td>
  <td align="center" width="128" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"><b>Filiale</b></td>
  <td align="center" width="171" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Articole</b></td>
  <td align="center" width="171" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Apare in footer</b></td>
  <td align="center" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"><b>Actiuni</b></td>
 </tr>
 

<?
for($i = 0; $i < count($tematici); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td width="21" height="25" align="center" nowrap="nowrap" >
<?=$tematici[$i]["id_tematica"]?></td>
  <td width="70" align="center" nowrap="nowrap" >
  <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
		 <? for($c=$min; $c<=$max; $c++) {?>
            <option value="<?=$scr?>?section=<?=$section?>&new_move=<?=$c?>&id_move=<?=$tematici[$i]["id_tematica"]?>" <?=selected($c,$tematici[$i]["ord"])?> ><?=$c?></option>
        <? }?>
   </select>
   </td>
  <td valign="middle" >
  <a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_tematica=<?=$tematici[$i]['id_tematica']?>"    style="text-decoration:none;"><img src="img/cat.jpg" hspace="5" border="0" align="top" style="margin-top:-4px;" />
  <?=str_replace('&nbsp;','',$tematici[$i]['denumire_institutie'])?></a>
  
  <div id="<?=$tematici[$i][id_tematica]?>_titlu" style=" position:absolute; background-color:#FFFFFF; padding:10px; color:#000066; display:none; border:1px solid #999999;    width:200px; height:auto;">
<?=str_replace('&nbsp;','',$tematici[$i]['categorie'])?>
  </div>  </td>
  
  <td>
  <? if(is_file(PICS_DIR_THUMB .$tematici[$i][logo_institutie])) { ?>
   <img src="<?=PICS_URL_THUMB?><?=$tematici[$i][logo_institutie]?>" width="50"     />
   <? }?>
  </td>
  
  <td align="center"  >
  <? $nr_children=mysql_query_assoc("select id_institutie from erad_filiale where id_institutie='".$tematici[$i][id_tematica]."'");
  if(count($nr_children)>0) echo count($nr_children); else echo "-";  
  ?>    </td>
  <td align="center"  >
  <? $nr_prds=mysql_query_assoc("select id_produs from erad_produse_tematici where id_tematica='".$tematici[$i][id_tematica]."'");
  if(count($nr_prds)>0) echo count($nr_prds); else echo "-";  ?>  </td>
  
        <td align="center"   ><? if($tematici[$i]['footer'] == 1) { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_footer=0&id_tematica=<?=$tematici[$i]['id_tematica']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>"><font color="#FF5A00">da</font></a>
            <? } else { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_footer=1&id_tematica=<?=$tematici[$i]['id_tematica']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>">nu</a>
            <? } ?></td>

  
  
  <td  width="93" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_tematica=<?=$tematici[$i]['id_tematica']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$tematici[$i]['categorie']?> ', '<?=$scr?>?section=<?=$section?>&act=del&id_tematica=<?=$tematici[$i]['id_tematica']?>&id_parinte=<?=$tematici[$i]['id_parinte']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


