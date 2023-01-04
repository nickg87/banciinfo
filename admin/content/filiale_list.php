 <? include('menu_sub.php'); ?> 

<?
if(is_numeric($_GET['id_filiala']) && $_GET['act'] == 'del') {
	//delete
 
 
// mysql_query("DELETE FROM erad_produse_tematici WHERE id_filiala = '".$catx[$i]['id_filiala']."'");
mysql_query("DELETE FROM erad_filiale WHERE id_filiala = '".$_GET[id_filiala]."'");
	  update_order('erad_filiale', 'id_filiala', 'ord',$extra );
 

 


	
 	  echo js_redirect($scr.'?section='.$section);
}
 
 /*if(strlen($_GET['move']) && strlen($_GET['id_filiala'])) {
	move_order('erad_filiale', 'id_filiala', 'ord', $_GET['id_filiala'], $_GET['move'] );
	echo js_redirect($scr.'?section='.$section);
}*/


if(isset($_GET['new_move']) && isset($_GET['id_move'])) {
	 
 
	new_order('erad_filiale', 'id_filiala', 'ord', $_GET['id_move'], $_GET['new_move'], "AND id_institutie = '".$_GET['id_institutie']."'");
	 // update_order('erad_brands', 'id_brand', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section.'&id_institutie='.$_GET[id_institutie]);
}


if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_filiale SET activ = '".$_GET['set_activ']."' WHERE id_filiala = '".$_GET['id_filiala']."'");
	echo js_redirect($scr.'?section='.$section.'&id_institutie='.$_GET[id_institutie]);
}
 
 
 
$xtras='&id_institutie='.$_GET[id_institutie];
 
$id_institutie=$_GET[id_institutie];

 
$interval = mysql_query_assoc("
	SELECT   min(erad_filiale.ord) as min,  max(erad_filiale.ord) as max from  erad_filiale 
	where id_institutie= '".$id_institutie."'
	 
");
$min=$interval[0]['min'];
$max=$interval[0]['max'];



 $filiale = mysql_query_assoc("select * from erad_filiale 
	where id_institutie='".$id_institutie."'  ORDER BY  erad_filiale.ord asc
 ");

// $filiale = get_cat_list_rec('erad_filiale', 'id_filiala', 'denumire_filiala', 'ord', $filiale, 0,0);
?>





 

 
 
<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  &nbsp; &nbsp; &nbsp;
 
   
		<?  $inst = mysql_query_assoc ("
		select id_tematica from erad_tematici
		group by id_tematica
		") ?>
        
	 	<select name="id_institutie" onchange="window.open(this.options[this.selectedIndex].value,'_self')"    >  

               <option value="<?=$src?>?section=<?=$section?>">--- Alege institutia ---</option>
             
              <? for($j = 0; $j < count($inst); $j++) { ?>
              <?
			 $cat_car = mysql_query_scalar ("select denumire_institutie from erad_tematici where id_tematica='".$inst[$j][id_tematica]."'") 
			  ?>
              <option value="<?=$src?>?section=<?=$section?>&id_institutie=<?=$inst[$j][id_tematica]?>" <? if ($inst[$j][id_tematica]==$id_institutie) echo "selected"; ?>  >
              <?=$cat_car?>
              </option>
              <? }?>
            </select>
            
	 <a style="float:right" href="#" onclick="javascript:popUp('export_filiale.php');"   class="but">Importa filiale</a>

   
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
  <td   width="4%" align="center" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Nr.</b></td>
  <td width="50%" background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Filiala</b></td>
  <td width="20%" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header">Institutie</td>
  <td width="10%" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">Activ</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 
 
 
 

<?
for($i = 0; $i < count($filiale); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td width="21" height="25" align="center" nowrap="nowrap" >
<?=$i+1?></td>
 
  
  <td valign="middle"    style="margin-top:-4px;" >
  <a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_filiala=<?=$filiale[$i]['id_filiala']?>" style="text-decoration:none;">&nbsp;<?=str_replace('&nbsp;','',$filiale[$i]['denumire_filiala'])?></a>
  
  <div id="<?=$filiale[$i][id_filiala]?>_titlu" style=" position:absolute; background-color:#FFFFFF; padding:10px; color:#000066; display:none; border:1px solid #999999;    width:200px; height:auto;">
<?=str_replace('&nbsp;','',$filiale[$i]['categorie'])?>
  </div>  </td>
  <td align="left"  >
  <? $institutie=mysql_query_assoc("select id_tematica, denumire_institutie from erad_tematici where id_tematica='".$filiale[$i][id_institutie]."'");
  if(count($institutie)>0) echo $institutie[0][denumire_institutie]; else echo "-";  
  ?>    </td>

<td align="center" ><? if($filiale[$i]['activ'] == 1) { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_filiala=<?=$filiale[$i]['id_filiala']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>"><font color="#FF5A00">da</font></a>
            <? } else { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_filiala=<?=$filiale[$i]['id_filiala']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>">nu</a>
            <? } ?>
</td>

  <td  width="93" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_filiala=<?=$filiale[$i]['id_filiala']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$filiale[$i]['denumire_filiala']?> ', '<?=$scr?>?section=<?=$section?>&act=del&id_filiala=<?=$filiale[$i]['id_filiala']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


