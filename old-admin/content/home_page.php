 <? include('menu_sub.php'); ?> 

 <?
 
// $tip_item=1; // categorie
// $tip_item=2; // bannerecategorie 
// $tip_item=3 	; // grup pagini 


if(isset($_GET['new_move']) && isset($_GET['id_move']) ) {
$extra= '';
	 
	 new_order('erad_home', 'id', 'ord', $_GET['id_move'], $_GET['new_move'], $extra);
 // update_order('erad_produse', 'id_produs', 'ord',$extra ); 
	 echo js_redirect($scr.'?section='.$section);
} 

if(strlen($_GET['set_activ'])) {
	mysql_query("UPDATE erad_home SET activ = '".$_GET['set_activ']."' WHERE id = '".$_GET['id']."'");
	echo js_redirect($scr.'?section='.$section);
}


  
 $items = mysql_query_assoc("
	SELECT * from 	  erad_home   	 
	order by ord asc
  
");




 $interval = mysql_query_assoc("	SELECT  min(erad_home.ord) as min,  max(erad_home.ord) as max from  erad_home  
    ");

  $min=$interval[0]['min'];
  $max=$interval[0]['max'];


?>



<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#B5C6CF">
  
 <tr>
  <td width="31" height="20" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header">ID</td>
  <td width="75" background="img/butbk.jpg" bgcolor="#f5f5f5"   class="titlu_header"><strong>Ordonare</strong></td>
  <td width="453" bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"><b>Denumire</b></td>
  <td width="55" background="img/butbk.jpg" bgcolor="#f5f5f5"   class="titlu_header">&nbsp;</td>
  <td width="56" background="img/butbk.jpg" bgcolor="#f5f5f5"   class="titlu_header">Activ</td>
  <td bgcolor="#f5f5f5" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
<?
$k = -1; 
for($i = 0; $i < count($items); $i++) {
if(is_array($items[$i])) { $k++;
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38"  ><?=$items[$i]["id"]?>  </td>
  <td height="38" align="center"  > 
 
 
 <select name="pos" onchange="window.open(this.options[this.selectedIndex].value,'_self')" >
		 <? for($c=$min; $c<=$max; $c++) {?>
        <option value="<?=$scr?>?section=<?=$section?>&new_move=<?=$c?>&id_move=<?=$items[$i]["id"]?>" <?=selected($c,$items[$i]["ord"])?> ><?=$c?> </option>
        <? }?>
   </select>  </td>
  <td>
  
  <? if($items[$i]['tip_item']==1) {
echo "<b>CATEGORIE | </b>";	echo 	 $nume1=mysql_query_scalar("select link from erad_categorii where id_categorie='".$items[$i]['id_item']."'");

  }
  ?>

   </td>
  <td>&nbsp;</td>
  <td>
  
   <? if($items[$i]['activ'] == 1) { ?>
      <a href="<?=$scr?>?section=<?=$section?>&set_activ=0&id=<?=$items[$i]['id']?><?=$xtras?>"><font color="#FF5A00">da</font></a>
        <? } else { ?>
      <a href="<?=$scr?>?section=<?=$section?>&set_activ=1&id=<?=$items[$i]['id']?><?=$xtras?>">nu</a>
    <? } ?>  </td>
  <td width="76" align="center" nowrap="nowrap">&nbsp;</td>
 </tr>
<? } } ?>
</table>
