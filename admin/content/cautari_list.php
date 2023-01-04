<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
 <? include('menu_sub.php'); ?> 

<?
if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_keywords SET activ = '".$_GET['set_activ']."' WHERE id_keyword = '".$_GET['id_keyword']."'");
	echo js_redirect($scr.'?section='.$section);
}

if(is_numeric($_GET['id_keyword']) && $_GET['act'] == 'del') {
	//delete
 
 	mysql_query("DELETE FROM erad_keywords WHERE id_keyword = '".$_GET['id_keyword']."'");
	echo js_redirect($scr.'?section='.$section);
}

 

//update_order('erad_cautari', 'id_keyword', 'ord','' ); 

 $cautari=mysql_query_assoc("select * from erad_keywords order by accesari desc");
 

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
  <td width="2%" height="25" align="center"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b>Nr </b></td>
  <td width="65%"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;&nbsp;<b>Keyword</b></td>
  <td width="15%"  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;&nbsp;<b>Rezultate</b></td>
  <td width="5%"  background="img/butbk.jpg" bgcolor="#EFEFEF" align="center" class="titlu_header">&nbsp;<b>Accesari&nbsp;</b></td>
  <td width="5%" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;&nbsp;<strong>Activ</strong></td>
  <td  background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"></td>
 </tr>


<?
for($i = 0; $i < count($cautari); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td  height="36" align="center"> <?=$i+1?>  </td>
 
  <td >
  &nbsp;&nbsp;
    <strong><?=$cautari[$i]['keyword']?></strong>  </td>
    
<td >
<? if ($cautari[$i]['rezultate']==0) {?> <span style="color:#FF0000"> Cautare fara rezultate </span><? } ?>
<? if ($cautari[$i]['rezultate']==1) {?> <span style="color:#006600"> Cautare cu rezultate </span><? } ?>
  &nbsp;&nbsp;
</td>
    
  <td  align="center"><?=$cautari[$i]['accesari']?></td>
  <td align="center" >
  <? if($cautari[$i]['activ'] == 1) { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id_keyword=<?=$cautari[$i]['id_keyword']?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
        <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id_keyword=<?=$cautari[$i]['id_keyword']?>">nu</a>
        <? } ?>  </td>
  <td  width="117" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_1&act=edit&id_keyword=<?=$cautari[$i]['id_keyword']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$cautari[$i]['keyword']?>', '<?=$scr?>?section=<?=$section?>&act=del&id_keyword=<?=$cautari[$i]['id_keyword']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


