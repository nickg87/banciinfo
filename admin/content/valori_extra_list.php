 <? include('menu_sub.php'); ?> 

<?

 $z=explode('php?',$_SERVER['REQUEST_URI']); 

  $_SESSION[url]=$z[1];

 
if(is_numeric($_GET['id_valoare']) && $_GET['act'] == 'del_news') {
	//delete
 
 
  mysql_query("DELETE FROM erad_campuri_valori WHERE id_valoare = '".$_GET['id_valoare']."'");
 
 	echo js_redirect($scr.'?section='.$section.'&id_camp='.$_GET[id_camp]);
}

 


 
$valori = mysql_query_assoc("
	SELECT * FROM erad_campuri_valori left join erad_campuri on erad_campuri_valori.id_camp=erad_campuri.id_camp  
	where erad_campuri_valori.id_camp='".$_GET[id_camp]."'   
");
 
 


?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  </td>
   
 
 </tr>
</table> 

<? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>



<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef"><b>
   Valori ale ale campului: 
   <?    $campuri = mysql_query_assoc("select * from erad_campuri order by denumire_camp");?>

	<select name="id_camp" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
<option value="<?=$src?>"> --- Alege camp extra ---- </option>
	<? foreach ($campuri as $mnu) {
	 $pgs = mysql_query_assoc("select id_valoare from erad_campuri_valori where id_camp='".$mnu[id_camp]."'");
	?>
	<option value="<?=$src?>?section=<?=$section?>&id_camp=<?=$mnu[id_camp]?>" <?=selected($mnu[id_camp], $_GET[id_camp]);?>><?=$mnu[denumire_camp]?> (<?=count($pgs);?>)</option>
	<? }?>
	</select>
	
    
   &nbsp;   &nbsp;   &nbsp; <? if($_GET[id_camp]<>''){?><a href="<?=$scr?>?section=<?=$mnp1?>_4&id_camp=<?=$_GET[id_camp]?>" class="but" >Adauga valoare</a><? }?>
    
    </td>
  
  </tr>
</table>
<br />
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
  
 <tr>
  <td width="31" height="20" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header">ID</td>
   
  <td width="453" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"><b>Denumire</b></td>
  <td width="112" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header">&nbsp;</td>
  <td width="61" background="img/butbk.jpg" bgcolor="#f5f5f5"   class="titlu_header">&nbsp;</td>
  <td bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
$k = -1; 
for($i = 0; $i < count($valori); $i++) {
if(is_array($valori[$i])) { $k++;
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38"  ><?=$valori[$i]["id_valoare"]?>  </td>
   
  <td><?=$valori[$i]['valoare_camp']?></td>
  <td>&nbsp;</td>
  <td> </td>
  <td width="76" align="center" nowrap="nowrap">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_5&act=edit&id_valoare=<?=$valori[$i]['id_valoare']?>" title="Edit"><img src="img/edit.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>
  		 &nbsp;
  		<a href="#" onClick="confirm_del('', '<?=$scr?>?section=<?=$section?>&act=del_news&id_valoare=<?=$valori[$i]['id_valoare']?>&id_camp=<?=$_GET[id_camp]?>')" title="Delete"><img src="img/del.gif" border="1" hspace="4" style="border-color: #B5C6CF;" align="middle"></a>  </td>
 </tr>
<? } } ?>
</table>


