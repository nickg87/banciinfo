 <? include('menu_sub.php'); ?> 

<?
if(is_numeric($_GET['id_link']) && $_GET['act'] == 'del_cat') {
	//delete
	mysql_query("DELETE FROM erad_links WHERE id_link = '".$_GET['id_link']."'");
	 
	update_order('erad_links', 'id_link', 'ord', "");
	echo js_redirect($scr.'?section='.$section);
}

 

if(strlen($_GET['move']) && strlen($_GET['id_link'])) {
	move_order('erad_links', 'id_link', 'ord', $_GET['id_link'], $_GET['move'], "");
	echo js_redirect($scr.'?section='.$section);
}

 $links = mysql_query_assoc("SELECT * FROM erad_links order by ord");


?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
  </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>
<br />

<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 <tr>
  <td bgcolor="#EFEFEF" width="106" background="img/butbk.jpg"   class="titlu_header"><b>Ordonare</b></td>
  <td width="255" bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"><b>Denumire</b></td>
  <td width="680" bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"><b>Link</b></td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
for($i = 0; $i < count($links); $i++) {
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38" align="center">
<a href="<?=$scr?>?section=<?=$section?>&id_link=<?=$links[$i]['id_link']?>&move=up" title="move up"><img src="img/up.gif" border="1" style="border-color: #cccccc;" align="absmiddle" hspace="5"></a>
 - 
<a href="<?=$scr?>?section=<?=$section?>&id_link=<?=$links[$i]['id_link']?>&move=down" title="move down"><img src="img/down.gif" border="1" style="border-color: #cccccc;" align="absmiddle" hspace="5"></a>
  </td>
  <td><?=$links[$i]['denumire']?></td>
  <td><a href="<?=$links[$i]['link']?>" target="_blank"><?=$links[$i]['link']?></a></td>
  <td width="143" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_2&act=edit&id_link=<?=$links[$i]['id_link']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$links[$i]['denumire']?> ', '<?=$scr?>?section=<?=$section?>&act=del_cat&id_link=<?=$links[$i]['id_link']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  </td>
 </tr>
<? } ?>
</table>


