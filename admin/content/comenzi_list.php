 <? include('menu_sub.php'); ?> 

<?

if ($_GET[reset]==1) { 
session_unregister(c_id_status);
session_unregister(c_month);
session_unregister(c_year);

}

 
//$_SESSION[c_month] = !strlen($_SESSION[c_month]) ? date('m') : $_SESSION[c_month];
$_SESSION[c_month] = strlen($_GET[set_c_month]) ? $_GET[set_c_month] : $_SESSION[c_month];

$_SESSION[c_year] = !strlen($_SESSION[c_year]) ? date('Y') : $_SESSION[c_year];
$_SESSION[c_year] = strlen($_GET[set_c_year]) ? $_GET[set_c_year] : $_SESSION[c_year];

//$_SESSION[c_id_status] = !strlen($_SESSION[c_id_status]) ? 1 : $_SESSION[c_id_status];
$_SESSION[c_id_status] = strlen($_GET[set_c_id_status]) ? $_GET[set_c_id_status] : $_SESSION[c_id_status];


if ($_SESSION[c_month]<>'') $p[] = " MONTH(data_comanda) = '".$_SESSION[c_month]."' ";
if ($_SESSION[c_year]<>'') $p[] = " YEAR(data_comanda) = '".$_SESSION[c_year]."' ";

if ($_SESSION[c_id_status]<>'') $p[] = " fac.id_status = '".$_SESSION[c_id_status]."' ";


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
   
   <?=get_section_name($section)?></b>  </td>
  
  </tr>
</table>
<br />

<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 
 <tr>
  <td bgcolor="#efefef" colspan="10" height="30" align="left">
  
  Care au status: comanda
    <?
$st = mysql_query_assoc("SELECT * FROM erad_comenzi_status");
?> 	
  	<select name="c_id_status" onChange="window.open(this.options[this.selectedIndex].value,'_self')">

<option value="<?=$src?>?section=<?=$section?>&reset=1"> ---- Toate comenzile ---- </option>
<? for($i = 0; $i < count($st); $i++) { 
	 
	?>
  		<option value="<?=$scr?>?section=<?=$section?>&set_c_id_status=<?=$st[$i][id_status]?>" <?=selected($_SESSION[c_id_status], $st[$i][id_status])?>><?=$st[$i][status]?>  </option>
<? } ?>
  	</select>
  	Comenzi din: 
 
  	<select name="c_year" onChange="window.open(this.options[this.selectedIndex].value,'_self')">
<? for($i = 2008; $i <= date('Y'); $i++) { ?>
  		<option value="<?=$scr?>?section=<?=$section?>&set_c_year=<?=$i?>" <?=selected($_SESSION[c_year], $i)?>><?=$i?></option>
<? } ?>
  	</select>
  
   	<select name="c_month" onChange="window.open(this.options[this.selectedIndex].value,'_self')">
<? $ln = luna_ro();
	for($i = 0; $i < count($ln); $i++) {
?>
  		<option value="<?=$scr?>?section=<?=$section?>&set_c_month=<?=($i + 1)?>" <?=selected($_SESSION[c_month], $i + 1)?>><?=$ln[$i]?></option>
<? } ?>
  	</select>
   	&nbsp;&nbsp;<a href="<?=$src?>?section=<?=$section?>&reset=1" class="but" > Vezi toate comenzile </a>  	
    
      &nbsp;&nbsp; <span class="titlu">Total comenzi: <strong><?=$tt?> Lei </strong></span>
    </td>
 </tr>
 <tr>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">ID</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header"> 
  <a href="<?=$src?>?section=<?=$section?>&cheie=data_comanda&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?> " class="titlu_header">  Data </a>  </td>
  <td background="img/butbk.jpg" bgcolor="#EFEFEF"   class="titlu_header">Client </td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">Telefon</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">Mod. plata</td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">

 <a href="<?=$src?>?section=<?=$section?>&cheie=status&directie=<? if ($_GET[directie]=='asc') echo "desc"; else echo "asc";?> " class="titlu_header"> Status </a>
 
  </td>
  <td bgcolor="#EFEFEF" background="img/butbk.jpg"   class="titlu_header">Total  [lei]</td>
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
  
<a href="<?=$src?>?section=4_2&id_user=<?=$cmd[$i]['id_user']?>">
 <? if ($cmd[$i]['client']==2)  echo $cmd[$i]['nume_user']. ' ('.$cmd[$i]['denumire'].')'; else   if ($cmd[$i]['client']==1 and  $cmd[$i]['denumire']=='' ) echo $cmd[$i]['nume_user'];     ?>
</a>
  
  
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
  		<a href="<?=$scr?>?section=<?=$mnp1?>_1&act=edit&id_comanda=<?=$cmd[$i]['id_comanda']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a>  </td>
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