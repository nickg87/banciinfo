 <? include('menu_sub.php'); ?> 

<?

if ($_GET[reset]==1) { 
session_unregister(c_id_status);
session_unregister(c_month);
session_unregister(c_year);

}
$id_user=$_GET[id_user];
$user=mysql_query_assoc("select * from erad_users where id_user='".$id_user."'");

$p[] = " fac.id_user = '".$id_user."' ";
 
 
////////////////////
 
if (isset($_GET['cheie']) and isset($_GET['directie'])) {
$ord[]=$_GET[cheie].' '.$_GET[directie];
$q[]='cheie='.$_GET[cheie].'&directie='.$_GET[directie];

}
else $ord[]=" id_comanda desc";
  
$order= ' order by '. implode(' , ', $ord);
 
  $nex=implode('&', $q);

//////////////////////////



$Cmd = new ComenziManagement($DBF[erad_comenzi]);
   $where =implode(' AND ', $p);
//$where = "fac.id_status = '".$_SESSION[c_id_status]."' AND MONTH(data_comanda) = '".$_SESSION[c_month]."' AND YEAR(data_comanda) = '".$_SESSION[c_year]."'";
$cmd = $Cmd->getCmd($where, $order);


$tt=0;
foreach($cmd as $cc) $tt+=($cc['total_comanda']-$cc['pret_livrare']);

$nr_comenzi=count($cmd);

#printr($cmd);

if(!$_GET['cnt'] )$_SESSION['fact_cnt']=0; 
$nr_pg = 25;
if(is_numeric($_GET['cnt']) && $_GET['cnt'] >= 0)
	$_SESSION['fact_cnt'] = $_GET['cnt'];
else 
	$_SESSION['fact_cnt'] = $_SESSION['fact_cnt'] != 0 ? $_SESSION['fact_cnt'] : 0;
$cnt = $_SESSION['fact_cnt'];
$prev = $cnt - $nr_pg;
if($prev >= 0) $prev = $prev < 0 ? 0 : $prev;
else $prev = -1;
$next = $cnt + $nr_pg;
$next = $next > count($cmd) ? count($cmd) : $next;
 
 

?>

<table width="95%" cellpadding="2" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td height="30" colspan="2" bgcolor="#efefef" class="titlu"><b>
   
   <?=get_section_name($section)?>
   
   &raquo; <? if ($user[0]['client']==2)  echo $user[0]['nume_user']. ' ('.$user[0]['denumire'].')'; else   if ($user[0]['client']==1  ) echo $user[0]['nume_user'];  echo $user[0]['denumire'];  ?>
   </b> 
   
    </td>
  
  </tr>
</table>
<br />

<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 <tr>
  <td bgcolor="#efefef" colspan="10" height="30" align="left">
<span class="titlu"><strong>  Nr comenzi: <?=$nr_comenzi?></strong>&nbsp;&nbsp; | Total comenzi: <strong><?=$tt?> Lei </strong></span>    </td>
 </tr>
 <tr>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">ID</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"> 
  <a href="<?=$src?>?section=<?=$section?>&cheie=data_comanda&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?>&id_user=<?=$id_user?>" class="titlu_header">  Data </a>  </td>
  <td background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header">Client </td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">Telefon</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">Mod. plata</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">

 <a href="<?=$src?>?section=<?=$section?>&cheie=status&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?>&id_user=<?=$id_user?>" class="titlu_header"> Status </a>
 
  </td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">
  
  <a href="<?=$src?>?section=<?=$section?>&cheie=total_comanda&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?>&id_user=<?=$id_user?>" class="titlu_header">Total  [lei]</a>
  </td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">Proforma</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">E-mail</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"></td>
 </tr>
  <?  
$k = -1;
for($i=$cnt; $i<$cnt+$nr_pg; $i++) { 
if(is_array($cmd[$i])) { $k++;
	 
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'" bgcolor="#FFFFFF">
  <td height="38"><?=$cmd[$i]['id_comanda']?></td>
  <td> <?=show_date_ro($cmd[$i]['data_comanda'])?></td>
  <td>
  
  <? if ($cmd[$i]['client']==2)  echo $cmd[$i]['nume_user']. ' ('.$cmd[$i]['denumire'].')'; else   if ($cmd[$i]['client']==1  ) echo $cmd[$i]['nume_user'];  echo $cmd[$i]['denumire'];  ?>
  
  
  </td>
  <td><?=$cmd[$i]['telefon']?></td>
  <td><?=$cmd[$i]['mod_plata']?></td>
  <td><?=$cmd[$i]['status']?></td>
  <td><?=$cmd[$i]['total_comanda']?></td>
  <td>
  <? $proforma=mysql_query_assoc("select id_proforma from erad_proforme where id_comanda='".$cmd[$i]['id_comanda']."'");?>
  <? if (count($proforma)>0) echo 'Proforma nr. '.$proforma[0][id_proforma];?>
  
  </td>
  <td><?=$cmd[$i]['email']?></td>
  <td width="30" align="center" nowrap>
  		<a href="<?=$scr?>?section=5_1&act=edit&id_comanda=<?=$cmd[$i]['id_comanda']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
 </tr>
<? } } ?>
</table>


<table width="100%" border="0" cellpadding="5" cellspacing="0"  bgcolor="#B5C6CF">
   <tr>
     <td bgcolor="#CCCCCC" width="25%" valign="middle" align="right" height="30"><? if($prev >= 0) { ?>
         <a href="<?=$scr?>?section=<?=$section?>&cnt=<?=$prev?>&<?=$nex?>&keyword=<?=$keyword?>" class="but">&laquo;&laquo; previous</a>
       <? }else{ echo '&nbsp;'; } ?></td>
     <td bgcolor="#CCCCCC" width="10%" align="center" valign="middle">
	 
	 Pagina:	
	   <select onchange="window.open(this.options[this.selectedIndex].value,'_self')">
	
	 <? for($i=0; $i<count($cmd); $i+=$nr_pg) { ?>
<option value="<?=$scr?>?section=<?=$section?>&cnt=<?=$i?>&<?=$nex?>&keyword=<?=$keyword?>" <?=selected($i,$cnt );?>>

           <?=(($cnt==$i)?'<font color="#0B6ABF">':'')?>
           <?=$i/$nr_pg+1?>
           <?=(($cnt==$i)?'</font>':'')?>
</option>
         <? } ?>
	 </select>
     </td>
     <td bgcolor="#CCCCCC" width="25%" valign="middle" align="left"><? if($next < count($cmd)) { ?>
         <a href="<?=$scr?>?section=<?=$section?>&cnt=<?=$next?>&<?=$nex?>&keyword=<?=$keyword?>" class="but">next &raquo;&raquo;</a>
       <? }else{ echo '&nbsp;'; } ?></td>
   </tr>
</table>