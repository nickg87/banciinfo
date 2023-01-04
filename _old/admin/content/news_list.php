 <? include('menu_sub.php'); ?> 

<?

if(isset($_GET['move_type']) && isset($_GET['id_page'])) {
	//$extra = " AND id_ziar = '".$_SESSION['id_ziar_cat']."'";
	move_order('erad_pages', 'id_page', 'ord', $_GET['id_page'], $_GET['move_type'], $extra);
	 update_order('erad_pages', 'id_page', 'ord',$extra ); 
	 echo js_redirect($scr.'?id_page='.$_GET["id_page"]);
}


if(is_numeric($_GET['id_page']) && $_GET['act'] == 'del_news') {
	//delete

	$p=mysql_query_assoc("SELECT * FROM erad_pages WHERE id_page = '".$_GET['id_page']."'");
 
if(is_file(PICS_DIR_THUMB . $p[0][pic_small])) {
			unlink(PICS_DIR_THUMB . $p[0][pic_small]);
			unlink(PICS_DIR_LARGE . $p[0][pic_small]);
			unlink(PICS_DIR_THUMB . $p[0][pic_large]);
			unlink(PICS_DIR_LARGE . $p[0][pic_large]);
			}

	 
	mysql_query("DELETE FROM erad_pages WHERE id_page = '".$_GET['id_page']."'");

	echo js_redirect($scr);
}

 


 


$work = mysql_query_assoc("
	SELECT * FROM erad_pages   ORDER BY  ord asc
");
//print_r($work);





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



<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
  
 <tr>
  <td width="66" height="20" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header">&nbsp;</td>
  <td width="260" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"><b>Title</b></td>
  <td width="504" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"><b>Link</b></td>
  <td bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
$k = -1; 
for($i = 0; $i < count($work); $i++) {
if(is_array($work[$i])) { $k++;
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38"  >
  <a href="<?=$scr?>?move_type=up&id_page=<?=$work[$i]["id_page"]?>&tip_proiect=<?=$_GET["tip_proiect"]?>" title="move up"><img src="img/up.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
   	<a href="<?=$scr?>?move_type=down&id_page=<?=$work[$i]["id_page"]?>&tip_proiect=<?=$_GET["tip_proiect"]?>" title="move down"><img src="img/down.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
  <td><?=$work[$i]['titlu_stire']?></td>
  <td><?=$work[$i]['link']?></td>
  <td width="73" align="center" nowrap="nowrap">
  		<a href="<?=$scr?>?csm=content/news_mod.php&act=edit&id_page=<?=$work[$i]['id_page']?>" title="Edit"><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  		 &nbsp;
  		<a href="#" onClick="confirm_del('', '<?=$scr?>?act=del_news&id_page=<?=$work[$i]['id_page']?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>


