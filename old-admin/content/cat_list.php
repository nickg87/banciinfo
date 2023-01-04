 <? include('menu_sub.php'); ?> 

<?

$tip_item=1; 
if(is_numeric($_GET['id_categorie']) && $_GET['act'] == 'del_cat') {
	//delete
 $catx = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, $_GET['id_categorie'], 0);

 $catx[][id_categorie]=$_GET[id_categorie];
// print_r($catx);
 
for ($i=0;$i<count($catx); $i++) {
  
 
 
 
 
	$produse=mysql_query_assoc("select id_produs from erad_produse where id_categorie='".$catx[$i][id_categorie]."'");
	
			foreach ($produse as $prod) {
			
			$pics=mysql_query_assoc("select * from erad_galerie where id_produs='".$prod[id_produs]."'");
			
			for($j=0; $j<count($pics); $j++){
			 if(is_file(PICS_DIR_THUMB . $pics[$j]["pic"])) 
						unlink(PICS_DIR_THUMB . $pics[$j]["pic"]);
			if(is_file(PICS_DIR_LARGE . $pics[$j]["pic"])) 
					unlink(PICS_DIR_LARGE . $pics[$j]["pic"]);
			if(is_file(PICS_DIR_MEDIU . $pics[$j]["pic"])) 
					unlink(PICS_DIR_MEDIU . $pics[$j]["pic"]);
			 if(is_file(PICS_DIR_SMALL . $pics[$j]["pic"])) 
					unlink(PICS_DIR_SMALL . $pics[$j]["pic"]);
			}
	 
	
			$files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$prod[id_produs]."'");
			for($j=0; $j<count($files); $j++){
			 if(is_file(FILE_DIR . $files[$j]["file"])) 
						unlink(FILE_DIR . $files[$j]["file"]);
			 
			}
	
	
	  mysql_query("DELETE FROM erad_fisiere WHERE id_produs = '".$prod[id_produs]."'");
	 mysql_query("DELETE FROM erad_galerie WHERE id_produs = '".$prod[id_produs]."'");
	  mysql_query("DELETE FROM erad_produse WHERE id_produs = '".$prod[id_produs]."'");
	 
	}


 mysql_query("DELETE FROM erad_categorii WHERE id_categorie = '".$catx[$i]['id_categorie']."'");
  mysql_query("DELETE FROM erad_campuri_categorii WHERE  id_categorie = '".$catx[$i]['id_categorie']."'");
 }


	
 	  echo js_redirect($scr.'?section='.$section);
}

 
if(strlen($_GET['move']) && strlen($_GET['id_categorie'])) {
	move_order('erad_categorii', 'id_categorie', 'ord', $_GET['id_categorie'], $_GET['move'], "AND id_parinte = '".$_GET['id_parinte']."'");
	echo js_redirect($scr.'?section='.$section);
}




if(isset($_GET['new_move']) && isset($_GET['id_move']) ) {
	 new_order('erad_categorii', 'id_categorie', 'ord', $_GET['id_move'], $_GET['new_move'], "AND id_parinte = '".$_GET['id_parinte']."'");
	 // update_order('erad_produse', 'id_produs', 'ord',$extra ); 
	echo js_redirect($scr.'?section='.$section);
}

if(strlen($_GET['set_home'])) {
	mysql_query("UPDATE erad_categorii SET home = '".$_GET['set_home']."' WHERE id_categorie = '".$_GET['id_categorie']."'");
	
if ($_GET['set_home']==1) {
mysql_query("DELETE FROM erad_home WHERE id_item = '".$_GET['id_categorie']."' and tip_item='".$tip_item."'");
mysql_query("INSERT INTO erad_home SET id_item = '".$_GET['id_categorie']."', tip_item='".$tip_item."', activ=1 ");
update_order('erad_home', 'id_item', 'ord', "");
}
else mysql_query("DELETE FROM erad_home WHERE id_item = '".$_GET['id_categorie']."' and tip_item='".$tip_item."'");

 	echo js_redirect($scr.'?section='.$section);
}
 



 $cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0);





?>


 




 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
 
  </tr>
</table>
 
 
 <br />
 


 



<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>
 <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td colspan="2" align="center" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Ordonare</b></td>
  <td background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Categoria</b></td>
  <td width="77" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header">Subcategorii</td>
  <td width="80" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">Articole</td>
  <td width="100" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">Home</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 

<? 
for($i = 0; $i < count($cat); $i++) {

 //update_order('erad_produse', 'id_produs', 'ord',' and id_categorie='.$cat[$i][id_categorie] ); 

?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td width="18" height="25" align="center" nowrap="nowrap" >
<?=$i+1?></td>
  <td width="70" align="left" nowrap="nowrap" >
  <?
  $interval=array(); 
  $interval = mysql_query_assoc("	SELECT   min(erad_categorii.ord) as min,  max(erad_categorii.ord) as max from  erad_categorii where id_parinte='".$cat[$i]["id_parinte"]."'  ");

$min=$interval[0]['min'];
$max=$interval[0]['max'];


?>
 
<select  name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" <? if($cat[$i]['lvl']>1) {?> style="color:#999999; border:0; margin-left:30px;" <? }?> >
		 <? for($c=$min; $c<=$max; $c++) {?>
        <option value="<?=$scr?>?section=<?=$section?>&new_move=<?=$c?>&id_move=<?=$cat[$i]["id_categorie"]?>&id_parinte=<?=$cat[$i]['id_parinte']?>" <?=selected($c,$cat[$i]["ord"])?> ><?=$c?></option>
        <? }?>
   </select>  </td>
  <td width="550" valign="middle"    style="margin-top:-4px; padding-left:<?=$cat[$i]['lvl']*20;?>" >
  <a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_categorie=<?=$cat[$i]['id_categorie']?>"   onmouseover="show_x('<?=$cat[$i][id_categorie]?>_titlu');" onmouseout="hide_x('<?=$cat[$i][id_categorie]?>_titlu');" style="text-decoration:none;"><img src="img/cat.jpg" hspace="5" border="0" align="top" style="margin-top:-4px;" /><?=str_replace('&nbsp;','',$cat[$i]['link'])?></a>
  
  <div id="<?=$cat[$i][id_categorie]?>_titlu" style=" position:absolute; background-color:#FFFFFF; padding:10px; color:#000066; display:none; border:1px solid #999999;    width:200px; height:auto;">
<?=str_replace('&nbsp;','',$cat[$i]['categorie'])?>
  </div>   </td>
  <td align="center"  >
  <? $nr_children=mysql_query_assoc("select id_categorie from erad_categorii where id_parinte='".$cat[$i][id_categorie]."'");
  echo count($nr_children);
  ?>    </td>
  <td align="center"  >
  <? $nr_prds=mysql_query_assoc("select id_produs from erad_produse where id_categorie='".$cat[$i][id_categorie]."'");
  echo count($nr_prds);
  ?>  </td>
  <td align="center"  >
  
  <? if($cat[$i]['home'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_home=0&id_categorie=<?=$cat[$i]['id_categorie']?><?=$xtras?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_home=1&id_categorie=<?=$cat[$i]['id_categorie']?><?=$xtras?>">nu</a>
    <? } ?>  </td>
  <td  width="144" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_categorie=<?=$cat[$i]['id_categorie']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$cat[$i]['categorie']?> si a tuturor subcategoriilor?', '<?=$scr?>?section=<?=$section?>&act=del_cat&id_categorie=<?=$cat[$i]['id_categorie']?>&id_parinte=<?=$cat[$i]['id_parinte']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


