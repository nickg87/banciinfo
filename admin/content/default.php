 <? include('menu_sub.php'); ?> 
<table width="100%" border="0" cellspacing="5" cellpadding="0">
  <tr>
    <td width="46%" valign="top">
<?
if (isset($_POST[s_valuta])){

//print_r($_POST[mon]);

 foreach ($_POST[mon] as $camp=>$val) 
 		{
		 
 
  	 if($val<>0) mysql_query("update erad_curs_monede set curs='".$val."' where id_moneda='".$camp."'");
	 
		
 		}
echo js_redirect($scr.'?section='.$mnp1.'_0&msg=Modificare efectuata.');




}

?>	

<?

 

  
 
  $p[] = " fac.id_status <> 99 ";


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

#printr($cmd);

if(!$_GET['cnt'] )$_SESSION['fact_cnt']=0; 
$nr_pg = 10;
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
	<? $produse=mysql_query_assoc("select id_produs, produs, accesari from erad_produse order by accesari desc limit 0,100");?>
	
	<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
  <tr>
    <td height="35" colspan="4" bgcolor="#efefef"  class="head" background=" img/top.jpg"><strong>&raquo; Cele mai vizualizate 50 articole </strong></td>
  </tr>
  <tr>
    <td width="24" align="center" bgcolor="#cccccc"  background="img/butbk.jpg"   class="titlu_header">
	ID</td>
    <td width="375" align="left" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Articol</td>
    <td width="53" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Accesari</td>
    <td width="52" align="center" bgcolor="#cccccc" background="img/butbk.jpg"   class="titlu_header">Editeaza</td>
  </tr>
 </table>
 <div style="height:600px; width:100%; overflow:scroll;">
<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
   <?  
 
for($i=0; $i<count($produse); $i++) { 
	 
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'">
    <td  height="25" align="left" nowrap style="border-bottom:1px solid #ccc;">
	<?=$produse[$i]['id_produs']?></td>
    <td align="left"  style="border-bottom:1px solid #ccc;">
		 <?=$produse[$i]['produs']?>	</td>

    <td align="center"  style="border-bottom:1px solid #ccc;">
	<?=$produse[$i]['accesari']?>
	
	</td>
    <td style="border-bottom:1px solid #ccc;" align="center" nowrap><a href="<?=$scr?>?section=1_2&act=edit&id_produs=<?=$produse[$i]['id_produs']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle" /></a>&nbsp; 
	 </td>
  </tr>
  <? }  ?>
</table>
	
	</div>
		
	<br />
 
	</td>
    <td width="54%" height="1" valign="top">
	
	
 <!--
    <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#ff3300">
 
 <tr>
  <td bgcolor="#efefef" colspan="5" height="35" align="left" class="head" background=" img/top.jpg">
<strong>  &raquo; Curs valutar</strong>  </td>
 </tr>
 
  <tr>
  <td bgcolor="#efefef" colspan="5" height="35" align="center" >
<? $valute=mysql_query_assoc("select * from erad_curs_monede where activ=1");?>

<form action="<?=$src?>?section=<?=$section?>" method="post">

<? foreach ($valute as $v) {?>

<strong>1 <?=$v[moneda]?> =</strong> <input name="mon[<?=$v[id_moneda]?>]" type="text" value="<?=$v[curs]?>" size="6" /> 
Lei 

<? }?>
&nbsp;&nbsp;<input type="submit" name="s_valuta" value="Seteaza" class="but" />
</form>


 </td>
 </tr>
 </table>
 -->
 
	<? $produse=mysql_query_assoc("select id_produs, produs
	
	 from erad_produse where id_produs NOT IN (select id_produs from erad_galerie)   ");?>



	<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
  <tr>
    <td height="35" colspan="4" bgcolor="#efefef"  class="head" background=" img/top.jpg"><strong>&raquo; Articole fara imagini (<?=count($produse)?> articole)</strong></td>
  </tr>
  <tr>
    <td width="17" align="center" bgcolor="#cccccc"  background="img/butbk.jpg"   class="titlu_header">
	ID</td>
    <td width="389" align="left" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Produs</td>
    <td width="34" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Vizite</td>
    <td width="43" align="center" bgcolor="#cccccc" background="img/butbk.jpg"   class="titlu_header"></td>
  </tr>
 </table>
<div style="height:600px; width:100%; overflow:scroll;">
<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
  <tr>
   <?  
 
for($i=0; $i<count($produse); $i++) { 
	 
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'">
    <td  height="25" align="left" nowrap style="border-bottom:1px solid #ccc;">
	<?=$produse[$i]['id_produs']?></td>
    <td align="left"  style="border-bottom:1px solid #ccc;">
		 <?=$produse[$i]['produs']?>	</td>

    <td align="center"  style="border-bottom:1px solid #ccc;">
	<?=$produse[$i]['accesari']?>
	
	</td>
    <td style="border-bottom:1px solid #ccc;" align="center" nowrap><a href="<?=$scr?>?section=1_2&act=edit&id_produs=<?=$produse[$i]['id_produs']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle" /></a>&nbsp; 
	 </td>
  </tr>
  <? }  ?>
</table>
	
	</div>
	
	</td>
  </tr>
  <tr>
    <td height="1" valign="top">	</td>
    <td valign="top">
	
	<? $top=mysql_query_assoc("select SUM(cant) as cant,erad_produse.id_produs, erad_produse.produs  
	 from erad_cart
	 left join erad_produse on erad_produse.id_produs=erad_cart.id_produs  
	  where erad_cart.id_produs<>99999 and  erad_produse.produs<>''
	 group by erad_produse.id_produs
	  order by cant desc limit 0,10");?>
	<!-- cele mai vandute 10 produse
	<table width="100%" cellpadding="5" cellspacing="1" bgcolor="#FFFFFF"  >
  <tr>
    <td height="35" colspan="4" bgcolor="#efefef"  class="head" background="img/top.jpg"><strong>&raquo; Cele mai vandute 10 produse </strong></td>
  </tr>
  <tr>
    <td width="17" align="center" bgcolor="#cccccc"  background="img/butbk.jpg"   class="titlu_header">
	ID</td>
    <td width="475" align="left" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Produs</td>
    <td width="42" align="center" background="img/butbk.jpg" bgcolor="#cccccc"   class="titlu_header">Bucati.</td>
    <td width="43" align="center" bgcolor="#cccccc" background="img/butbk.jpg"   class="titlu_header"></td>
  </tr>
 
   <?  
 
for($i=0; $i<count($top); $i++) { 
	 
?>
  <tr onMouseOver="this.bgColor = '#efefef'"  onMouseOut ="this.bgColor = '#FFFFFF'">
    <td  height="25" align="left" nowrap style="border-bottom:1px solid #ccc;">
	<?=$top[$i]['id_produs']?></td>
    <td align="left"  style="border-bottom:1px solid #ccc;">
		 <?=$top[$i]['produs']?>	</td>

    <td align="center"  style="border-bottom:1px solid #ccc;">
	<?=$top[$i]['cant']?>
	
	</td>
    <td style="border-bottom:1px solid #ccc;" align="center" nowrap><a href="<?=$scr?>?section=1_2&act=edit&id_produs=<?=$top[$i]['id_produs']?>" title="Edit"><img src="img/edit.gif" border="1" style="border-color: #cccccc;" align="absmiddle" /></a>&nbsp; 
	 </td>
  </tr>
  <? }  ?>
</table>
	-->
	
	</td>
  </tr>
</table>
