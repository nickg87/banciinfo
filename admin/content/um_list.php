 <? include('menu_sub.php'); ?> 

<?

 
if(is_numeric($_GET['id_um']) && $_GET['act'] == 'del_um') {
	//delete
 
 mysql_query("DELETE FROM erad_um WHERE id_um = '".$_GET['id_um']."'");
 mysql_query("update erad_produse set id_um=0 WHERE id_um = '".$_GET['id_um']."'");
   	
 	  echo js_redirect($scr.'?section='.$section);
}

 
 





 $campuri = mysql_query_assoc("select * from erad_um");


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
  <td colspan="2" align="center" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;</td>
  <td width="653" background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Denumire</b></td>
  <td width="128" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header">&nbsp;</td>
  <td width="171" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">&nbsp;</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 

<?
for($i = 0; $i < count($campuri); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td width="21" height="25" align="center" nowrap="nowrap" >
<?=$i+1?></td>
  <td width="70" align="center" nowrap="nowrap" >&nbsp;</td>
  <td valign="middle"    style="margin-top:-4px; padding-left:<?=$campuri[$i]['lvl']*20;?>" >
  <a href="#"   onmouseover="show_x('<?=$campuri[$i][id_um]?>_titlu');" onmouseout="hide_x('<?=$campuri[$i][id_um]?>_titlu');" style="text-decoration:none;"> 
  <?=$campuri[$i]['um']?></a>
  
  <div id="<?=$campuri[$i][id_um]?>_titlu" style=" position:absolute; background-color:#FFFFFF; padding:10px; color:#000066; display:none; border:1px solid #999999;    width:200px; height:auto;">
<?=str_replace('&nbsp;','',$campuri[$i]['categorie'])?>
  </div>  </td>
  <td align="center"  >&nbsp;</td>
  <td align="center"  >&nbsp;</td>
  <td  width="93" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_8&act=edit&id_um=<?=$campuri[$i]['id_um']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$campuri[$i]['um']?>', '<?=$scr?>?section=<?=$section?>&act=del_um&id_um=<?=$campuri[$i]['id_um']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } ?>
</table>


