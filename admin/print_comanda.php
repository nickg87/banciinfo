<?   include('a_settings.php');
$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$id_comanda = $_GET[id_comanda];

$cart = mysql_query_assoc("SELECT * FROM erad_cart WHERE id_comanda = $id_comanda");
$proforme = mysql_query_assoc("SELECT * FROM erad_proforme WHERE id_comanda = $id_comanda ORDER BY data");


$Cmd = new ComenziManagement($DBF[erad_comenzi]);
$where = "id_comanda = $id_comanda";
$cmd = $Cmd->getCmd($where,'');
$x = explode('.', $cmd[0][pret_livrare]);
$cmd[0][pret_livrare1] = $x[0];
$cmd[0][pret_livrare2] = $x[1];
$vl = $cmd[0];


$error = array();
if(isset($_POST[s_mod_status]) || isset($_POST[s_mod_comanda]) || isset($_POST[s_mod_cart])) {
	$_POST[s_mod_cart] = 'on';
	$vl = array();
	$vl = $_POST;
	$vldb = $Cmd->FormToDb($vl);
	$vldb[pret_livrare] = $vldb[pret_livrare1] . '.' . $vldb[pret_livrare2];
	$vldb[de_acord] = 1;
	
	#verificari
	
	$Cmd->vld($vldb, $error);

	if(empty($error)) {
		$ins = $Cmd->update($vldb, $id_comanda);
	
		if($ins) {
#			if(!isset($_POST[s_mod_cart])) {
#				echo js_redirect($scr . '?id_comanda=' . $id_comanda . '&msg=Comanda a fost modificata');
#			}
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
	}
	
}


if(isset($_POST[s_mod_cart])) {
	$tc = 0;
	foreach($_POST[cant] as $id_cart => $cant) {
		$cant = trim($cant);
		$pret_unitar1 = trim($_POST[pret_unitar1][$id_cart]);
		$pret_unitar2 = trim($_POST[pret_unitar2][$id_cart]);
		if($cant > 0 && $pret_unitar2 >= '00' && $pret_unitar1 >= 0) {
			# calcul pret total per produs
			$pret_unitar[$id_cart] = $pret_unitar1 . '.' . $pret_unitar2;
			$pret_total[$id_cart] = $cant * $pret_unitar[$id_cart];
			$pret_total[$id_cart] = number_format($pret_total[$id_cart], 2, '.', '');
			
			# update cant, pret unitar
			mysql_query("UPDATE erad_cart SET 
				cant = '".$cant."',
				pret_unitar = '".$pret_unitar[$id_cart]."',
				pret_total = '".$pret_total[$id_cart]."'
				WHERE id_cart = '".$id_cart."'
			");
			
		} else {
			$pret_total[$id_cart] = mysql_query_scalar("SELECT pret_total FROM erad_cart WHERE id_cart = '".$id_cart."'");
		}

		# calcul total comanda
		$tc += $pret_total[$id_cart];
		$tc = number_format($tc, 2, '.', '');
	}
		
	# update pret comanda
	$pl = mysql_query_scalar("SELECT pret_livrare FROM erad_comenzi WHERE id_comanda = '".$id_comanda."'");
	$tc += $pl;
	$tc = number_format($tc, 2, '.', '');
	$upd = mysql_query("UPDATE erad_comenzi SET total_comanda = '".$tc."' WHERE id_comanda = $id_comanda");
	if($upd)
		echo js_redirect($scr . '?section='.$section.'&id_comanda=' . $id_comanda . '&msg=Comanda a fost modificata');
}


if(strlen($_GET[remove_from_cart])) {
	$rfc = $_GET[remove_from_cart];
	$minus = mysql_query_scalar("SELECT pret_total FROM erad_cart WHERE id_cart = $rfc");
	$tc = mysql_query_scalar("SELECT total_comanda FROM erad_comenzi WHERE id_comanda = $id_comanda");
	$tc -= $minus;
	$tc = number_format($tc, 2, '.', '');
	$upd = mysql_query("UPDATE erad_comenzi SET total_comanda = '".$tc."' WHERE id_comanda = $id_comanda");
	if($upd) {
		$minus = mysql_query_scalar("DELETE FROM erad_cart WHERE id_cart = $rfc");
		echo js_redirect($scr . '?section='.$section.'&id_comanda=' . $id_comanda . '&msg=Comanda a fost modificata');}
	}


?><head>
 <link href="prints.css" rel="stylesheet" type="text/css" media="print">
 <link href="style.css" rel="stylesheet" type="text/css" >

<style media="all" type="text/css">
	@import "style_print.css";
.style2 {
	color: #000000;
	font-weight: bold;
}
</style>
 
 </head>
 
 <p align="center" class="NonPrintable">
     
    <input type="button" value=" Print " onClick="window.print();return false;" class="but" style=" font-size:11px;" />
  
 
    <input type="button" value=" Inchide " onClick="window.close();return false;" class="but" style=" font-size:11px;"/>
   </p>


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



 
 <table width="95%" cellpadding="5" cellspacing="1" bgcolor="#ffffff">
  
 <tr>
  <td bgcolor="#ffffff" colspan="2" height="30" align="center"> 
   	<div style="clear: both"></div>
  	<br><br><br>
  	<?=$prftxt?>
  </td>
 </tr>
</table>
 




  


   
   
<form action="<?=$scr?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>" method="post" name="fx">
 


  	<table cellpadding="5" cellspacing="0" width="100%" >
  		<tr>
		  <td align="center" valign="top" width="50%">
  			
  	 <br />
  	 <br />
  	 <p>&nbsp;</p>
		  </form>
