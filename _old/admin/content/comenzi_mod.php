 <? include('menu_sub.php'); ?> 
<?

$empty = '<br><font color=red style="font-size: 9px;">camp lipsa</font>';

$id_comanda = $_GET[id_comanda];

$z=explode('php?',$_SERVER['REQUEST_URI']); 

  $_SESSION[url]=$z[1];

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


?>





<?
if(strlen($_GET[vezi_proforma])) {
	$prf_continut = mysql_query_scalar("SELECT continut FROM erad_proforme WHERE id_proforma = '".$_GET[vezi_proforma]."'");
	echo '
				<div style="
			width: 100%; 
			height: 300px; 
			overflow: auto; 
			text-align: center; 
			background-color: white;
			">';
	echo '<a href="'.$scr.'?section='.$section.'&id_comanda='.$id_comanda.'">Inchide</a><br><br>';
	# -- scoatem doar ce e in <body> pentru afisarea in pagina asta
	echo preg_replace('`.*<body[^>]*>(.+)</body>.*`', '\1', $prf_continut);
	echo '</div><br><Br>';
}
?>

<form action="<?=$scr?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>" method="post" name="fx">
<table width="95%" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
 <tr>
  <td bgcolor="#efefef" colspan="2" height="30" class="titlu"><b><?=get_section_name($section)?></b></td>
 </tr>

 <tr>
  <td bgcolor="#ffffff" colspan="2" height="30" align="center"><?=$_GET[msg]?>
<? if(!array_empty($error)) { ?>
	<div class="error" align="center" style="color: red">
		Au fost intalnite urmatoarele erori:<br>
		<?=implode('<br>', $error)?>
		<br><br>
	</div>
<? } ?>
  </td>
 </tr>

</table>


  	<table cellpadding="5" cellspacing="0" width="100%" >
  		<tr>
		  <td align="center" valign="top" width="50%">
  			
  	 <br />

  	
	<table width="800" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
	  <tr>
        <td bgcolor="#999999" height="30" background="img/butbk.jpg"  class="titlu_header"><b>Date comanda </b></td>
	    <td bgcolor="#999999" height="30" background="img/butbk.jpg"  class="titlu_header">&nbsp;</td>
	    <td align="right" background="img/butbk.jpg" bgcolor="#999999"  class="titlu_header">
		
		<a href="#" class="but" onclick="javascript:popUp('print_comanda.php?id_comanda=<?=$id_comanda?>');" > Printeaza comanda</a>		</td>
	  </tr>
          <tr>
            <td width="136" align="right" bgcolor="#ffffff"><b>Data Comanda:</b></td>
            <td width="639" colspan="2" align="left" bgcolor="#ffffff"><?=$cmd[0][data_comanda]?></td>
          </tr>

          <tr>
            <td bgcolor="#ffffff" align="right"><b>Status Comanda:</b></td>
            <td colspan="2"><?
$st = mysql_query_assoc("SELECT * FROM erad_comenzi_status");
?>
                <select name="id_status">
                  <option value=""> - </option>
                  <? for($i = 0; $i < count($st); $i++) { ?>
                  <option value="<?=$st[$i][id_status]?>" <?=selected($vl[id_status], $st[$i][id_status])?>>
                    <?=$st[$i][status]?>
                  </option>
                  <? } ?>
                </select>            </td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Status Plata:</b></td>
            <td colspan="2" align="left" bgcolor="#ffffff"><?
$st = mysql_query_assoc("SELECT * FROM erad_comenzi_status_plati");
?>
                <select name="id_status_plata">
                  <option value=""> - </option>
                  <? for($i = 0; $i < count($st); $i++) { ?>
                  <option value="<?=$st[$i][id_status_plata]?>" <?=selected($vl[id_status_plata], $st[$i][id_status_plata])?>>
                    <?=$st[$i][status_plata]?>
                  </option>
                  <? } ?>
                </select>            </td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Total Comanda:</b></td>
            <td colspan="2" align="left" bgcolor="#ffffff"><b>
              <?=$cmd[0][total_comanda]?>
              RON</b></td>
          </tr>
          <tr>
            <td colspan="3" align="center" bgcolor="#FFFFFF"><input class="but" type="submit" name="s_mod_status" value="Modifica" /></td>
          </tr>
         </table>
		 
	<br />
	<table width="800">
 <tr>
  <td bgcolor="#CCCCCC" colspan="2" height="30" background="img/butbk.jpg"  class="titlu_header"><b>&nbsp; Info Cart</b></td>
 </tr>
 <tr>
  <td colspan="2" bgcolor="#ffffff">
  
  	<table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  		<tr>
  			<td bgcolor="#ffffff"><b>Produs</b></td>
  			<td bgcolor="#ffffff"><b>Nr. Buc</b></td>
  			<td bgcolor="#ffffff"><b>Pret unitar</b></td>
  			<td bgcolor="#ffffff"><b>Pret total</b></td>
  			<td bgcolor="#ffffff"></td>
  		</tr>
<? foreach($cart as $c) { 
		$x = explode('.', $c[pret_unitar]);
		$c[pret_unitar1] = $x[0];
		$c[pret_unitar2] = $x[1];
		$pret=$c[pret_unitar1].'.'.$c[pret_unitar2];
		
		$c[pret_total]=$pret*$c[cant];
	?>
  		<tr>
  			<td bgcolor="#ffffff"><?=$c[produs]?></td>
  			<td bgcolor="#ffffff"><input type="text" name="cant[<?=$c[id_cart]?>]" value="<?=$c[cant]?>" size="2"></td>
  			<td bgcolor="#ffffff">
  				<input type="text" name="pret_unitar1[<?=$c[id_cart]?>]" value="<?=$c[pret_unitar1]?>" size="5">
  				.
  				<input type="text" name="pret_unitar2[<?=$c[id_cart]?>]" value="<?=$c[pret_unitar2]?>" size="2" maxlength="2">
  				RON  			</td>
  			<td bgcolor="#ffffff"><?=$c[pret_total]?> RON</td>
  			<td bgcolor="#ffffff"><a href="<?=$scr?>?section=<?=$section?>&id_comanda=<?=$id_comanda?>&remove_from_cart=<?=$c[id_cart]?>" title="Sterge"><img src="img/del.gif" border="1" style="border-color: #cccccc;" align="absmiddle"></a></td>
  		</tr>
<? } ?>
  		<tr>
  			<td bgcolor="#ffffff"></td>
  			<td bgcolor="#ffffff"></td>
  			<td bgcolor="#ffffff" align="right"><b>Pret livrare:</b></td>
  			<td bgcolor="#ffffff">
					<input type="text" name="pret_livrare1" value="<?=$cmd[0][pret_livrare1]?>" size="1">
  				.
  				<input type="text" name="pret_livrare2" value="<?=$cmd[0][pret_livrare2]?>" size="1" maxlength="2">
  				RON  			</td>
  			<td bgcolor="#ffffff"></td>
  		</tr>
  		<tr>
  			<td bgcolor="#ffffff"></td>
  			<td bgcolor="#ffffff"></td>
  			<td bgcolor="#ffffff" align="right"><b>Total (cart + taxe livrare):</b></td>
  			<td bgcolor="#ffffff"><b><?=$cmd[0][total_comanda]?> RON</b></td>
  			<td bgcolor="#ffffff"></td>
  		</tr>
  		<tr>
  			<td bgcolor="#ffffff" align="center"><input  class="but" onclick="document.location.href='<?=$scr?>?section=<?=$mnp1?>_3&id_comanda=<?=$id_comanda?>'" type="button"   value="Adauga item" /></td>
  		    <td bgcolor="#ffffff" align="center">&nbsp;</td>
  		    <td bgcolor="#ffffff" align="center">&nbsp;</td>
  		    <td bgcolor="#ffffff" align="center"><input  class="but" type="submit" name="s_mod_cart" value="Modifica" /></td>
  		    <td bgcolor="#ffffff" align="center">&nbsp;</td>
  		</tr>
  	</table>
  	
  	</td>
  </tr>

</table>


    <br />
    

<br />
<table width="800" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc">
  <tr>
    <td bgcolor="#999999" colspan="2" height="30" background="img/butbk.jpg"  class="titlu_header"><b>Info cumparator  </b> 
&nbsp;&nbsp;&nbsp;    <a href="<?=$src?>?section=4_1&act=edit&id_user=<?=$cmd[0][id_user]?>" class="titlu_header">Edit</a>
    </td>
  </tr>
          <tr>
            <td width="85" bgcolor="#ffffff">&nbsp;</td>
            <td width="390" align="left" bgcolor="#ffffff">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><strong>Cumparator</strong></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][nume_user]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Email:</b></td>
            <td bgcolor="#ffffff" align="left"><a href="mailto:<?=$cmd[0][email]?>">
              <?=$cmd[0][email]?>
            </a></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Telefon:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][telefon]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>CNP:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][cnp]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>CI:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][ci]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right">&nbsp;</td>
            <td bgcolor="#ffffff" align="left">&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Companie</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][denumire]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>CUI:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][cui]?></td>
          </tr>
          
          <tr>
            <td bgcolor="#ffffff" align="right"><b>RC:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][reg_comert]?></td>
          </tr>
          
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Judet:</b></td>
            <td bgcolor="#ffffff" align="left"><?=get_judet($cmd[0][id_judet])?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Localitate:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][localitate]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><strong>IBAN:</strong></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][cont]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><strong>Banca</strong></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][banca]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Adresa facturare:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][adresa_facturare]?></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="right"><b>Cod Postal:</b></td>
            <td bgcolor="#ffffff" align="left"><?=$cmd[0][cod_postal]?></td>
          </tr>
        </table>

<br />
<table width="800">
 <tr>
  <td bgcolor="#999999" colspan="2" height="30" background="img/butbk.jpg"  class="titlu_header"><b> Adresa de livrare</b></td>
 </tr>

 <tr>
  <td bgcolor="#ffffff" colspan="2" align="center">

                  <table width="100%" align="center" cellpadding="5" cellspacing="1" bgcolor="#cccccc" class="content">
                       
                        <tr>
                          <td width="165" align="right" bgcolor="#FFFFFF"><strong>Adresa de livrare:<br />
                          </strong></td>
                          <td width="602" valign="top" bgcolor="#FFFFFF" class="descriere">
						<strong> <?=$vl[adresa_livrare]?> </strong>
                              <br />                          </td>
                        </tr>
                      
                      <tr>
                        <td height="68" align="right" bgcolor="#ffffff"><b>Comentarii client:</b></td>
                        <td bgcolor="#ffffff" align="left"><?=$cmd[0][comentarii]?></td>
                      </tr>
                      <tr>
                        <td align="right" bgcolor="#FFFFFF"><strong>Comentarii furnizor:<br />
                        </strong></td>
                        <td valign="top" bgcolor="#FFFFFF" class="descriere">
                        <textarea name="comentarii_furnizor" rows="3" cols="50" class="input"><?=$vl[comentarii_furnizor]?></textarea>
                            <br />
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="top" bgcolor="#FFFFFF"><strong>Modalitate transport:</strong></td>
                        <td bgcolor="#FFFFFF" class="descriere"><?
$curier = mysql_query_assoc("SELECT * FROM erad_curier ");
?>
                            <select name="id_curier"  class="input">
                              <option value=""> - </option>
                              <? for($i = 0; $i < count($curier); $i++) { ?>
                              <option value="<?=$curier[$i][id_curier]?>" <?=selected($vl[id_curier], $curier[$i][id_curier])?>>
                              <?=$curier[$i][curier_nume]?>
                              </option>
                              <? } ?>
                            </select>                        </td>
                      </tr>
                      
                     
                      <tr>
                        <td align="right" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                        <td bgcolor="#FFFFFF" class="descriere">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" valign="top" bgcolor="#FFFFFF"><strong>Modalitate de plata:</strong></td>
                        <td bgcolor="#FFFFFF" class="descriere">
<?
$mod_plata = mysql_query_assoc("SELECT * FROM erad_mod_plata WHERE activa = '1'");
?>
						  <select name="id_mod_plata"  class="input">
                              <option value=""> - </option>
<? for($i = 0; $i < count($mod_plata); $i++) { ?>
                              <option value="<?=$mod_plata[$i][id_mod_plata]?>" <?=selected($vl[id_mod_plata], $mod_plata[$i][id_mod_plata])?>> <?=$mod_plata[$i][mod_plata]?> </option>
<? } ?>
					    </select>						</td>
                      </tr>
            </table>

  </td>
 </tr>


 <tr>
  <td align="center" bgcolor="#ffffff">
  	<input class="but" type="submit" name="s_mod_comanda" value="Modifica">
  </td>
 </tr>
</table>

<p>&nbsp;</p>
<table width="800">
		  <tr>
            <td height="25" colspan="2" align="left" bgcolor="#999999" background="img/butbk.jpg"  class="titlu_header"><strong> &nbsp; Proforme</strong></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" align="left"><b>Proforma:</b></td>
            <td bgcolor="#ffffff" align="left" nowrap="nowrap"><? foreach($proforme as $pf) { ?>
                <a href="<?=$scr?>?section=<?=$section?>&vezi_proforma=<?=$pf[id_proforma]?>&id_comanda=<?=$id_comanda?>">Proforma
                  <?=$pf[id_proforma]?>
              </a> (
              <?=$pf[data]?>
              )<br />
                <? } ?>
                <br /></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" colspan="2" align="center"><input class="but" onclick="document.location.href='<?=$scr?>?section=<?=$mnp1?>_2&id_comanda=<?=$id_comanda?>'" type="button" name="s_emite_proforma" value="Emite Proforma Noua"   /></td>
          </tr>
        </table>

<p>&nbsp;</p>
<p>&nbsp;</p>
		  </form>
