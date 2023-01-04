 <? include('menu_sub.php'); ?> 

<?
if(is_numeric($_GET['id_meniu']) && $_GET['act'] == 'del') {
	//delete
 
 $pagini=mysql_query_assoc("select id_page from erad_pagini where id_meniu='".$_GET['id_meniu']."'");
	
	 foreach ($pagini as $pagina) {
			
			$pics=mysql_query_assoc("select * from erad_galerie_pagini where id_page='".$pagina[id_page]."'");
			
			for($j=0; $j<count($pics); $j++){
			 if(is_file(PICS_DIR_THUMB . $pics[$j]["pic"])) 
						unlink(PICS_DIR_THUMB . $pics[$j]["pic"]);
			if(is_file(PICS_DIR_LARGE . $pics[$j]["pic"])) 
					unlink(PICS_DIR_LARGE . $pics[$j]["pic"]);
			if(is_file(PICS_DIR_MEDIU . $pics[$j]["pic"])) 
					unlink(PICS_DIR_MEDIU . $pics[$j]["pic"]);
			}
	 
	
			$files=mysql_query_assoc("select * from erad_fisiere_pagini where id_page='".$pagina[id_page]."'");
			for($j=0; $j<count($files); $j++){
			 if(is_file(FILE_DIR . $files[$j]["file"])) 
						unlink(FILE_DIR . $files[$j]["file"]);
			 
			}
	
	
	  mysql_query("DELETE FROM erad_fisiere_pagini WHERE id_page = '".$pagina[id_page]."'");
	 mysql_query("DELETE FROM erad_galerie_pagini WHERE id_page = '".$pagina[id_page]."'");
	  mysql_query("DELETE FROM erad_pagini WHERE id_page = '".$pagina[id_page]."'");
	 
	}


 mysql_query("DELETE FROM erad_meniu_set WHERE id_meniu = '".$_GET['id_meniu']."'");
	update_order('erad_meniu_set', 'id_meniu', 'ord', "");
 

	
 	  echo js_redirect($scr.'?section='.$section);
}

 
if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_meniu_set SET activ = '".$_GET['set_activ']."' WHERE id_meniu = '".$_GET['id_meniu']."'");
	echo js_redirect($scr.'?section='.$section);
} 


 if(strlen($_GET['move']) && strlen($_GET['id_meniu'])) {
	   move_order('erad_meniu_set', 'id_meniu', 'ord', $_GET['id_meniu'], $_GET['move'],'');
	echo js_redirect($scr.'?section='.$section);
}



 $meniuri = mysql_query_assoc("select * from erad_meniu_set order by ord ");


?>


 


 

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
  <?=get_section_name($section)?></b>  </td>
 
  </tr>
</table>
 
 
 <br />
<div id="add" style="display:none;">

<table width="95%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="90%" height="30" bgcolor="#efefef" background="img/butbk.jpg" class="titlu_header"><b>Adauga item meniu </b>
  
  </td>
  <td width="10%" height="30" nowrap="nowrap" bgcolor="#efefef" background="img/butbk.jpg"><a href="#" onclick="hide('add');" class="but">[X] Inchide</a></td>
 </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">
  
   <form name="<?=$form_name?>" action="<?=$scr?>" method="post" onSubmit="return validate_form_<?=$form_name?> ( );">
<fieldset class="">
    <legend class="titlu"><b>Date</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 
 <tr>
  <td align="right" width="150" bgcolor="#ffffff">Link meniu  </td>
  <td bgcolor="#ffffff"><input type="text"  id="link_meniu" name="link_meniu" size="50"   value="<?=$link_meniu?>"></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">
   Zona site  </td>
   <td bgcolor="#ffffff">

   <select name="zona_meniu" >
<? foreach ($meniu_set as $mnu=>$label) {?>
   <option value="<?=$mnu?>"><?=$label?></option>
   
   <? }?>
   </select>   </td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Activ</td>
   <td bgcolor="#ffffff">
  <input type="checkbox" name="activ" value="1" <?=checked($vl[activ], 1)?>>
   
   </td>
 </tr>
 </table>
 </fieldset>
 
<fieldset class="">
    <legend class="titlu"><b>Optimizare SEO</b></legend>     


<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">

  
 <tr>
   <td width="150" align="right" bgcolor="#ffffff">Description:       </td>
   <td bgcolor="#ffffff"><input type="text" name="description" size="100" value="<?=$description?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">Keywords:      </td>
   <td bgcolor="#ffffff"><input type="text" name="keywords" size="100" value="<?=$keywords?>" /></td>
 </tr>
 <tr>
   <td align="right" bgcolor="#ffffff">&nbsp;</td>
   <td bgcolor="#ffffff">   </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#ffffff"></td>
  <td bgcolor="#ffffff"><div id="inp"><input type="submit" name="s_add_cat" value="Salveaza" class="but"> </div></td>
 </tr>
</table>
</fieldset>
</form>   </td>
   </tr>
 <tr>
   <td height="30" colspan="2" bgcolor="#efefef">&nbsp;</td>
 </tr>
 </table>  
 
 
  
</div>
 



<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>




 <table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td width="12" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Nr.</b></td>
  <td width="13" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;</td>
  <td width="382" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Denumire link meniu  </b></td>
  <td width="237" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><strong>Zona</strong></td>
  <td width="231" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><strong>Nr. Pagini</strong></td>
  <td width="127" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><strong>Activ</strong></td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 

<?
for($i = 0; $i < count($meniuri); $i++) {
?>
<tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="25" align="center" nowrap="nowrap">
<?=$i+1?></td>
  <td align="center" nowrap="nowrap">
  <a href="<?=$scr?>?section=<?=$section?>&move=up&id_meniu=<?=$meniuri[$i]["id_meniu"]?>" title="move up"><img src="img/up.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
   	<a href="<?=$scr?>?section=<?=$section?>&move=down&id_meniu=<?=$meniuri[$i]["id_meniu"]?>" title="move down"><img src="img/down.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  
  </td>
  <td valign="middle"    style="margin-top:-4px;  " >
&nbsp;&nbsp; <?=$meniuri[$i]['link_meniu']?> </td>
  <td align="left"  >
  <?=$meniu_set[$meniuri[$i]['zona_meniu']]?>  </td>
  <td align="center"  >
  <?  $pgs = mysql_query_assoc("select id_page from erad_pagini where id_meniu='".$meniuri[$i][id_meniu]."'");?>
  <?=count($pgs)?>  </td>
  <td align="center"  >
  <? if($meniuri[$i]['activ'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_meniu=<?=$meniuri[$i]['id_meniu']?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_meniu=<?=$meniuri[$i]['id_meniu']?>">nu</a>
        <? } ?>  </td>
  <td   width="118" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&id_meniu=<?=$meniuri[$i]['id_meniu']?>" title="Edit"  ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$meniuri[$i]['categorie']?>', '<?=$scr?>?section=<?=$section?>&act=del&id_meniu=<?=$meniuri[$i]['id_meniu']?>&id_parinte=<?=$meniuri[$i]['id_parinte']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


