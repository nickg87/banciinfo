 <? include('menu_sub.php'); ?> 

<?
if(is_numeric($_GET['id_oras']) && $_GET['act'] == 'del') {
	//delete
 
 
// mysql_query("DELETE FROM erad_produse_tematici WHERE id_oras = '".$catx[$i]['id_oras']."'");
mysql_query("DELETE FROM erad_orase WHERE id_oras = '".$_GET[id_oras]."'");
	  update_order('erad_orase', 'id_oras', 'ord',$extra );
 

 


	
 	  echo js_redirect($scr.'?section='.$section);
}
 
 

if(strlen($_GET['set_principal'])) {
	mysql_query("UPDATE erad_orase SET principal = '".$_GET['set_principal']."' WHERE id_oras = '".$_GET['id_oras']."'");
	echo js_redirect($scr.'?section='.$section.'&id_judet='.$_GET[id_judet]);
}
 
 
 
$xtras='&id_judet='.$_GET[id_judet];
 
$id_judet=$_GET[id_judet];

 
$interval = mysql_query_assoc("
	SELECT   min(erad_orase.ord) as min,  max(erad_orase.ord) as max from  erad_orase 
	where id_parinte= '".$id_judet."'
	 
");
$min=$interval[0]['min'];
$max=$interval[0]['max'];



 $orase = mysql_query_assoc("
 	select * from erad_orase
	where id_parinte='".$id_judet."'
	ORDER BY erad_orase.principal desc,  erad_orase.oras asc
 ");


?>

 
 
 
<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?></b>  &nbsp; &nbsp; &nbsp;
 
   
		<?  $judete = mysql_query_assoc ("
		select * from erad_judete
		order by judet asc
		") ?>
        
	 	<select name="id_judet" onchange="window.open(this.options[this.selectedIndex].value,'_self')"    >  

               <option value="<?=$src?>?section=<?=$section?>">--- Alege judet ---</option>
             
              <? for($j = 0; $j < count($judete); $j++) { ?>
 
              <option value="<?=$src?>?section=<?=$section?>&id_judet=<?=$judete[$j][id_judet]?>" <? if ($judete[$j][id_judet]==$id_judet) echo "selected"; ?>  >
              <?=$judete[$j][judet]?>
              </option>
              <? }?>
            </select>
            
       <a style="float:right" href="#" onclick="javascript:popUp('export_orase.php');"   class="but">Importa orase</a>
            
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
  <td  width="4%" align="center" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header"><b> - </b></td>
  <td width="50%" background="img/butbk.jpg"   class="titlu_header"><b>&nbsp;Oras</b></td>
  <td width="15%" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header">Judet</td>
  <td width="5%" bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header">Nr filiale</td>
  <td width="10%" background="img/butbk.jpg" bgcolor="#EFEFEF" class="titlu_header">Principal</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg" class="titlu_header"></td>
 </tr>
 
 
 
 

<?
if ($id_judet<>'') {
for($i = 0; $i < count($orase); $i++) {
?>
 <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td width="21" height="25" align="center" nowrap="nowrap" >
<?=$i+1?></td>
 
  <td valign="middle"    style="margin-top:-4px;">
  <a href="<?=$scr?>?section=<?=$mnp1?>_1&act=edit&id_oras=<?=$orase[$i]['id_oras']?>" style="text-decoration:none; color:<? if ($orase[$i][principal]=='1') echo '#FF0000';?>; font-weight:<? if ($orase[$i][principal]=='1') echo 'bold';?>;">&nbsp;<?=str_replace('&nbsp;','',$orase[$i]['oras'])?></a>
  
  <div id="<?=$orase[$i][id_oras]?>_titlu" style=" position:absolute; background-color:#FFFFFF; padding:10px; color:#000066; display:none; border:1px solid #999999;    width:200px; height:auto;">
<?=str_replace('&nbsp;','',$orase[$i]['categorie'])?>
  </div>  </td>
  <td align="left"  >
  <? $judet=mysql_query_scalar("select judet from erad_judete where id_judet='".$id_judet."'"); ?>
  <?=$judet?>
  </td>


  <? $nr_filiale=mysql_query_scalar("select count(id_filiala) from erad_filiale where id_oras='".$orase[$i][id_oras]."'"); ?>
  <? if($nr_filiale>=2) { mysql_query("UPDATE erad_orase SET principal=1 WHERE id_oras = '".$orase[$i][id_oras]."'"); } ?>
  <? if($nr_filiale>=1) { $color='#ff3300'; $bg='#eeeeee';  } else { $color='#000000'; $bg='#ffffff';} ?>
 <td align="right" bgcolor="<?=$bg?>"  >

  <font style="color:<?=$color?>"><?=$nr_filiale?></font>
  </td>  

<td align="center" ><? if($orase[$i]['principal'] == 1) { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_principal=0&id_oras=<?=$orase[$i]['id_oras']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>"><font color="#FF5A00">da</font></a>
            <? } else { ?>
            <a href="<?=$scr?>?section=<?=$section?>&set_principal=1&id_oras=<?=$orase[$i]['id_oras']?><?=$xtras?>&cnt=<?=$_GET[cnt]?>">nu</a>
            <? } ?>
</td>

  <td  width="93" align="center">
  		<a href="<?=$scr?>?section=<?=$mnp1?>_1&act=edit&id_oras=<?=$orase[$i]['id_oras']?>" title="Edit"   ><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>
  		&nbsp;&nbsp;&nbsp;
  		<a href="#" onClick="confirm_del('<?=$orase[$i]['oras']?> ', '<?=$scr?>?section=<?=$section?>&act=del&id_oras=<?=$orase[$i]['id_oras']?>')" title="Delete"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } } ?>
</table>


