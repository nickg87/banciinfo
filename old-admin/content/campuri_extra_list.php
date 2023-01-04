 <? include('menu_sub.php'); ?> 

<?



if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_campuri SET activ = '".$_GET['set_activ']."' WHERE id_camp = '".$_GET['id_camp']."'");
	echo js_redirect($scr.'?section='.$section);
} 



if(is_numeric($_GET['id_camp']) && $_GET['act'] == 'del_cat') {
	//delete
  
	 
 mysql_query("DELETE FROM erad_campuri_valori WHERE id_camp = '".$_GET['id_camp']."'");
 mysql_query("DELETE FROM erad_campuri WHERE id_camp = '".$_GET['id_camp']."'");
  mysql_query("DELETE FROM erad_campuri_categorii WHERE id_camp = '".$_GET['id_camp']."'");
   mysql_query("DELETE FROM erad_produse_valori WHERE id_camp = '".$_GET['id_camp']."'");
  	
 	  echo js_redirect($scr.'?section='.$section);
}

 
if(strlen($_GET['move']) && strlen($_GET['id_camp'])) {
	move_order('erad_categorii', 'id_camp', 'ord', $_GET['id_camp'], $_GET['move'], "AND id_parinte = '".$_GET['id_parinte']."'");
	//update_order('erad_categorii', 'id_camp', 'ord', "AND id_parinte = '".$_GET['id_parinte']."'");

	echo js_redirect($scr.'?section='.$section);
}








 $campuri = mysql_query_assoc("select * from erad_campuri");


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
  <td width="653" background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Camp</b></td>
  <td width="128" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header">&nbsp;</td>
  <td width="171" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">Activ</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 

<?
for($i = 0; $i < count($campuri); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td width="21" height="25" align="center" nowrap="nowrap" >
<?=$i+1?></td>
  <td width="70" align="center" nowrap="nowrap" >
  
  <a href="<?=$scr?>?section=<?=$section?>&id_camp=<?=$campuri[$i]['id_camp']?>&move=up&id_parinte=<?=$campuri[$i]['id_parinte']?>" title="move up"><img src="img/up.gif" border="1" style="border-color: #cccccc;" align="absmiddle" hspace="2"></a>
 - 
<a href="<?=$scr?>?section=<?=$section?>&id_camp=<?=$campuri[$i]['id_camp']?>&move=down&id_parinte=<?=$campuri[$i]['id_parinte']?>" title="move down"><img src="img/down.gif" border="1" style="border-color: #cccccc;" align="absmiddle" hspace="2"></a>  </td>
  <td valign="middle"    style="margin-top:-4px; padding-left:<?=$campuri[$i]['lvl']*20;?>" >
  <a href="#"   onmouseover="show_x('<?=$campuri[$i][id_camp]?>_titlu');" onmouseout="hide_x('<?=$campuri[$i][id_camp]?>_titlu');" style="text-decoration:none;"><img src="img/cat.jpg" hspace="5" border="0" align="top" style="margin-top:-4px;" />
  <?=$campuri[$i]['denumire_camp']?></a>
  
  <div id="<?=$campuri[$i][id_camp]?>_titlu" style=" position:absolute;   background-color:#FFFFFF; padding:10px; color:#000066; display:none; border:1px solid #999999;     height:auto;">
<? $valori = mysql_query_assoc("
	SELECT * FROM erad_campuri_valori left join erad_campuri on erad_campuri_valori.id_camp=erad_campuri.id_camp  
	where erad_campuri_valori.id_camp='".$campuri[$i][id_camp]."'   
");


for($jj = 0; $jj < count($valori); $jj++) {
?>

 <span class="small_text">&bull;</span> <?=$valori[$jj]['valoare_camp']?>
 <br />

<? }?>


  </div>  </td>
  <td align="center"  >
  
  <a href="<?=$scr?>?section=<?=$mnp1?>_4&id_camp=<?=$campuri[$i][id_camp]?>" class="but" >Adauga valori</a> 
  
  </td>
  <td align="center"  >
  
  <? if($campuri[$i]['activ'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_camp=<?=$campuri[$i]['id_camp']?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_camp=<?=$campuri[$i]['id_camp']?>">nu</a>
        <? } ?> 
  </td>
  <td  width="93" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_camp=<?=$campuri[$i]['id_camp']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$campuri[$i]['denumire_camp']?>', '<?=$scr?>?section=<?=$section?>&act=del_cat&id_camp=<?=$campuri[$i]['id_camp']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


