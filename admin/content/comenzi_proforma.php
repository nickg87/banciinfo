<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$id_comanda = $_GET[id_comanda];

$cart = mysql_query_assoc("SELECT * FROM erad_cart WHERE id_comanda = $id_comanda");

$Cmd = new ComenziManagement($DBF[erad_comenzi]);
$where = "id_comanda = $id_comanda";
$cmd = $Cmd->getCmd($where, '');


$prf = array();
$prf[id_proforma] = get_next_mysql_id('erad_proforme');
if($cmd[0][client]==1) $prf[nume] = $cmd[0][nume_user];
if($cmd[0][client]==2) $prf[nume] = $cmd[0][denumire];
 $prf[cui] = $cmd[0][cui] ;
if($cmd[0][client]==1) $prf[cnp] = $cmd[0][cnp] ; else $prf[cnp] ='';
$prf[rc] = $cmd[0][reg_comert]; 
if($cmd[0][client]==1) $prf[ci] = $cmd[0][ci]; else $prf[ci] = '';
$prf[judet] = get_judet($cmd[0][id_judet]);
$prf[localitate] = $cmd[0][localitate];

$prf[adresa_facturare] = $cmd[0][adresa_facturare];
$prf[adresa_livrare] = $cmd[0][adresa_livrare];
$prf[comentarii] = $cmd[0][comentarii];
$prf[comentarii_furnizor] = $cmd[0][comentarii_furnizor];
$prf[cod_postal] = $cmd[0][cod_postal];
$prf[data] = date('d.m.Y');
$prf[total_comanda] = $cmd[0][total_comanda];
$prf[pret_livrare] = $cmd[0][pret_livrare];

$date_firma=mysql_query_assoc("select * from erad_date_firma where id_firma=1");

$prf[firma_denumire] = $date_firma[0][firma_denumire];
$prf[firma_cui] = $date_firma[0][firma_cui];
$prf[firma_ro] = $date_firma[0][firma_ro];
$prf[firma_sediu] = $date_firma[0][firma_sediu];
$prf[firma_cont] = $date_firma[0][firma_cont];
$prf[firma_banca] = $date_firma[0][firma_banca];



$prf_tpl = file_get_contents(TPL_PROFORMA);
$prf_tpl = str_replace(array(chr(10), chr(11)), '', $prf_tpl);

$p = '`<\!\-\-CART\-\->(.*)<\!\-\-END\-CART\-\->`m';
preg_match($p, $prf_tpl, $m);
$prf_tpl_cart = $m[1];
$prf_cart = '';
$k = 0;
foreach($cart as $c) {
$um=mysql_query_assoc("select * from erad_um 
left join erad_produse on erad_produse.id_um=erad_um.id_um
where id_produs = '".$c[id_produs]."' ");
	$prf_cart .= str_replace(
					array('{crt}', '{cant}', '{produs}', '{pret_total}', '{pret_unitar}',  '{um}'), 
					array(++$k, $c[cant], $c[produs], $c[pret_total], $c[pret_unitar], $um[0][um]), 
					$prf_tpl_cart);
}


#printr($prf);

$d = $prf_tpl;
# -- facem replace cu datele comenzii
foreach($prf as $k => $v)
	$d = str_replace('{' . $k . '}', $v, $d);
# -- facem replace si pt cart
$d = preg_replace('`(.*<\!\-\-CART\-\->).*(<\!\-\-END\-CART\-\->.*)`', "\\1{$prf_cart}\\2", $d);

$prftxt_to_send = $d;

# -- scoatem doar ce e in <body> pentru afisarea in pagina asta
$d = preg_replace('`.*<body[^>]*>(.+)</body>.*`', '\1', $d);

$prftxt = $d;

#echo htmlspecialchars($d);


if(isset($_POST[s_confirma])) {
	
	# -- trimitem mail clientului
	if(send_mail(
			$cmd[0][email], 
			'Factura proforma Nr ' . $prf[id_proforma], 
			$prftxt_to_send, 
			PROFORMA_SENDER_NAME, 
			PROFORMA_SENDER_EMAIL)) {
		mysql_query("INSERT INTO erad_proforme SET
			id_comanda = '".$id_comanda."',
			cod = '".md5($prf[id_proforma])."',
			data = now(),
			continut = '".quotes($prftxt_to_send)."'
		");
		# -- comanda trece in status "In Lucru"
		mysql_query("UPDATE erad_comenzi SET id_status = 2 WHERE id_comanda = $id_comanda");
		echo js_redirect($scr . '?section='.$mnpl.'_1&id_comanda=' . $id_comanda . '&msg=Proforma a fost emisa');
	} else {
		echo js_redirect($scr . '?section='.$section.'&id_comanda=' . $id_comanda . '&msg=Nu se poate trimite mail');
	}
}


?>



 <? include('menu_sub.php'); ?> 

<form action="<?=$scr?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>" method="post">
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td bgcolor="#efefef" colspan="2" height="30" class="titlu"><b><?=get_section_name($section)?></b></td>
 </tr>
 <tr>
  <td bgcolor="#ffffff" colspan="2" height="30" align="center">
  
  <? if ($_GET['msg']<>'') {?>
<div id="msg" style=" width:950px; height:20px; border:2px solid #ccc; background-color:#efefef; padding-top:5px; color: #FF0000; font-size:13px; margin:5px; ">
<?=$_GET['msg']?>
</div>
<? }?>


  </td>
 </tr>
 <tr>
  <td bgcolor="#ffffff" colspan="2" height="30" align="center"> 
  	<input type="button" onclick="document.location.href='<?=$scr?>?section=<?=$mnp1?>_1&id_comanda=<?=$id_comanda?>'" name="s_back" value="Inapoi la editare comanda" style="float: left" class="but">
  	<input type="submit" name="s_confirma" value="Confirma Emitere Proforma" style="float: right" class="but">
  	<div style="clear: both"></div>
  	<br><br><br>
  	<?=$prftxt?>
  </td>
 </tr>
</table>
</form>

