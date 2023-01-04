<? include('settings/s_settings.php');
 
include('cart_fx.php'); 
 
$curier = mysql_query_assoc("select * from erad_curier order by curier_nume asc");
  $today=date('Y-m-d');
 if(isset($_POST["s_finalizeaza"])) {
$Usr = new UserManagement($DBF['erad_comenzi']);  

$id_comanda=get_next_mysql_id('erad_comenzi');

	$vl = array();
	$vl = $_POST;

//echo $vl[comentarii]; exit;
	
$vl[data_comanda]=$today;
$vl[total_cart]=$_SESSION[cart_total];
$vl[pret_livrare]=$_SESSION[taxa_transport];
$vl[total_comanda]=$_SESSION[comanda_total];
$vl[id_user]=$_SESSION[iduser];
$vl[id_mod_plata]=$_SESSION[id_mod_plata];
$vl[id_curier]=$_SESSION[id_curier];

$vl[id_status]=1; 
 
    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 $id_comanda=get_last_mysql_id('erad_comenzi');
		if($ins) {
		foreach($_SESSION[cart] as $k => $v) {
			$produs_in= $v[produs].$v[coordx];
				mysql_query("insert into erad_cart set 
				id_comanda='".$id_comanda."', 
				produs='".$produs_in."', 
				id_produs='".$k."', 
				cant='".$v[cant]."', 
				pret_unitar='".$v[pret]."',
				pret_total='".fx($v[pret]*$v[cant])."'   
				");
			}
 			
			



//////// comanda user
$user=mysql_query_assoc("select * from erad_users where id_user='".$_SESSION[iduser]."'");

$cart = mysql_query_assoc("SELECT * FROM erad_cart WHERE id_comanda = '".$id_comanda."'");

 
 
$Cmd = new ComenziManagement($DBF[erad_comenzi]);
$where = "id_comanda = $id_comanda";
$cmd = $Cmd->getCmd($where,'');


$prf = array();
$prf[id_proforma]=$id_comanda;
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
$prf[telefon] = $cmd[0][telefon];
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

$prf[site_name] = SITE_NAME;
$prf[site_url] = SITE_URL;
 
  
$prf[data] = date('d.m.Y');
$prf[total_comanda] = $cmd[0][total_comanda];
$prf[pret_livrare] = $cmd[0][pret_livrare];


$prf_tpl = file_get_contents(TPL_COMANDA);
$prf_tpl = str_replace(array(chr(10), chr(11)), '', $prf_tpl);

$p = '`<\!\-\-CART\-\->(.*)<\!\-\-END\-CART\-\->`m';
preg_match($p, $prf_tpl, $m);
$prf_tpl_cart = $m[1];
$prf_cart = '';
$k = 0;
foreach($cart as $c) {

$prds=mysql_query_assoc("select pret from erad_produse where id_produs='".$c[id_produs]."' ");
$ums=mysql_query_assoc("select um from erad_produse
left join erad_um on erad_um.id_um=erad_produse.id_um where id_produs='".$c[id_produs]."' ");

	$prf_cart .= str_replace(
					array('{crt}', '{cant}', '{produs}', '{pret_unitar}', '{pret_total}', '{pret_baza}','{um}'), 
					array(++$k, $c[cant], strip_tags($c[produs]), $c[pret_unitar], $c[pret_total], $prds[0][pret], $ums[0][um]), 
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
 




$catre_email=$user[0][email];
//$catre_email='marius.serban@anadeea.ro';
$nume=SITE_NAME;
$email=$hf[0][emails];
 
 
$subject = "Comanda dvs la ".SITE_NAME;
   
 $sent_nr=0;
     $message = '<html><head><style>'.file_get_contents(SITE_DIR.'style/style.css').'</style></head><body class="content" style="background-color:#ffffff;font-size:12px; background:none;">'.$prftxt.'</body></html>';
 
  
 if(send_mail($catre_email, $subject, $message, $nume, $email))
						$sent_nr++;


//catre admin

$catre_email=$hf[0][emails];
 
$nume='Comanda';
$email=SITE_NAME;
$subject = 'Comanda nr '.$id_comanda.' - '.SITE_NAME;
 
 if(send_mail($catre_email, $subject, $message, $nume, $email))
						$sent_nr++;

 
////////////////////////////////
 
			
			
			
	unset ($_SESSION[cart]);
	unset ($_SESSION[cart_total]);
	unset ($_SESSION[pret_transport]);
	unset ($_SESSION[comanda_total]);
	unset ($_SESSION[mod_plata]);
			
			echo js_redirect(SITE_URL.'pages.php?link=msg&msg=10');
		}
	}
}
 
 

$Usr = new UserManagement($DBF['erad_users']); 
$vldb=$Usr->get01($_SESSION[iduser]);
$vl=$Usr->DbToForm($vldb);
 
$title="Cumparaturi &raquo; Finalizare comanda";
 
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;

 
?>

<?  
include "head_data.php"?>


<body style="margin:0;"> 
 
<div id="div_abs" ></div>

<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
      <div id="LEFT" class="left" >
                
           
           <? $tip=3;?>
          <? include "left_cont.php";?>
           <? include "box_intrebari.php";?>
           <? include "banner_left.php";?>
             
        <div  style="     height:30px; width:230px;  float:left;"></div> 
           
            
            
       
            
      </div>
        
        
        
        
        
  <div  class="centru"   >
            
        
          
  <form name="sform" action="<?=SITE_URL?>viewcart_checkout.php" method="post"    >
  
  
 <div style="width:100%;   " class="content">
						
                        <br>
						<br>
	 
			<? $pas=4; include "viewcart_pasi.php";?>					  
							  
   

 
        <h1 class="titlu_mare" ><?=$title?></h1> 
        
   
           <br>
<br>

	
			 
                  
    <table align="center" border="0" cellpadding="3" cellspacing="2" width="100%"  >
													  <tbody>
														<tr>
														  <td   height="30" align="left" bgcolor="#999999" class="input"><strong>Denumirea Produsului</strong></td>
														  <td width="10%" align="left" bgcolor="#999999" class="input"><strong>Nr. Buc</strong></td>
														  <td width="14%" align="left" bgcolor="#999999" class="input"><strong>Pret unitar</strong> </td>
														  <td width="14%" align="left" bgcolor="#999999" class="input"><strong>Valoare</strong></td>
														</tr>
								 
									<?
									$p = 0;
									
									 
									foreach($_SESSION[cart] as $k => $v) {
									 
							 
									?>
														<tr>
														  <td height="30" align="left" bgcolor="#<?=(++$p % 2 == 0 ? 'f8f8f8' : 'ffffff')?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?=get_link_produs($v[id_produs], $v[produs])?>"><strong><?=$v[produs]?>  </strong></a>
                                                          <br><?=$v[coordx]?></td>
														  <td align="left" bgcolor="#<?=($p % 2 == 0 ? 'f8f8f8' : 'ffffff')?>" style="border-bottom:1px solid #CCCCCC;">
														  <?=$v[cant]?>                                                           </td>
														  <td align="left" bgcolor="#<?=($p % 2 == 0 ? 'f8f8f8' : 'ffffff')?>" nowrap="nowrap" style="border-bottom:1px solid #CCCCCC;"><?=$v[pret]?> Lei</td>
														  <td align="left" bgcolor="#<?=($p % 2 == 0 ? 'f8f8f8' : 'ffffff')?>" style="border-bottom:1px solid #CCCCCC;"><?=fx($v[pret]*$v[cant])?> Lei   </td>
														</tr>
									<? } ?>
														
														<tr>
														  <td height="20" align="left"   >&nbsp;</td>
														  <td align="left"  >&nbsp;</td>
														  <td align="right" >&nbsp;</td>
														  <td align="left"  nowrap="nowrap" style="font-size:12px;">&nbsp;</td>
													    </tr>
														<tr>
														  <td height="20" align="left"   >&nbsp;														  </td>
														  <td align="left"  >&nbsp;</td>
														  <td align="right" bgcolor="#f8f8f8"  ><strong>Total:</strong></td>
														  <td align="left" bgcolor="#f8f8f8"   nowrap="nowrap" style="font-size:12px;"><strong><?=$_SESSION[cart_total]?>    </strong>Lei														  </td>
														</tr>
														<tr>
                                                          <td height="20" align="left"  style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td align="left" style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td align="right" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
														  <td align="left"  nowrap="nowrap"   style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
													    </tr>
														<tr>
                                                          <td height="20" align="left"  style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td align="left" style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td align="right" style="border-bottom:1px solid #CCCCCC;"><strong>Taxa transport</strong>:                                                          </td>
														  <td align="left"  nowrap="nowrap"   style="border-bottom:1px solid #CCCCCC;">
														<strong>  <?=$_SESSION[taxa_transport]?> lei</strong>                                                          </td>
													    </tr>
														<tr>
														  <td height="20" align="left"  style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td align="left" style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td align="right" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
														  <td align="left"  nowrap="nowrap"   style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
													    </tr>
														<tr>
                                                          <td height="20" align="left"  style="border-bottom:1px solid #CCCCCC;" >&nbsp;</td>
														  <td colspan="2" align="left" style="border-bottom:1px solid #CCCCCC;" class="pret"><strong>TOTAL COMANDA:</strong> </td>
														  <td align="left"  nowrap="nowrap"   style="border-bottom:1px solid #CCCCCC;" class="pret">
                                                          <strong>
                                                           <?=$_SESSION[comanda_total]?>
														    lei</strong> </td>
													    </tr>
														<tr>
														  <td height="30" colspan="2" align="left" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
														  <td colspan="2" align="center" style="border-bottom:1px solid #CCCCCC;">&nbsp;</td>
													    </tr>
													  </tbody>
		  </table> 							 
	
    
    
     
   
    <table width="100%"   cellpadding="0" cellspacing="10" class="content">
    <tr>
      <td width="127" align="right"><strong>Alte observatii</strong>:<br /></td>
      <td width="45%" align="left" valign="top"  ><textarea name="comentarii" rows="5" cols="45" style="height:60px;" class="input"></textarea>
          <br /></td>
      <td width="39%" align="center" valign="middle"  ><span style="border-bottom:1px solid #ffffff;">
        
         
  <input name="s_finalizeaza" type="hidden" value="1"    />
 
        
      <div class="buttons" style=" float:left; ">
    <button type="submit" class="positive"  >
      <img src="images/icons/star.png" alt=""/> 
    Trimite comanda
      </button>
    </div>      
        
      </span></td>
    </tr>
  </table> 						 
							 
 </div>    
   
          
    </form>       
    
 
  <br>
<br>
 
 
  <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="content">
<tr valign="top">
  <td colspan="2" align="left" bgcolor="#efefef"><strong>Date personale de contact</strong></td>
  <td width="230" align="left" bgcolor="#efefef">
  <a href="<?=SITE_URL?>viewcart_livrare.php" class="default_link"> Modifica </a>  </td>
</tr>
<tr valign="top">
  <td width="124" align="left" bgcolor="#FFFFFF">Nume si prenume*:</td>
  <td colspan="2" align="left" bgcolor="#FFFFFF" > <strong><?=$vl[nume_user]?></strong> </td>
</tr>
     
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">Telefon*:</td>
      <td colspan="2" align="left" bgcolor="#FFFFFF" > <strong><?=$vl[telefon]?></strong>      </td>
    </tr>
   </table>  
   
   
   <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="content" id="persf" <? if($vl[client]==2) echo 'style="display:none;"';?> >
    <tr valign="top">
      <td width="124" align="left" bgcolor="#FFFFFF">CNP*:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[cnp]?> 
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">CI*:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[ci]?>           </td>
    </tr>
  </table>
  
  
  <table width="100%" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="content" id="persj" <? if($vl[client]==1 or !isset($vl[client])) echo 'style="display:none;"';?>>
    <tr valign="top">
      <td width="124" align="left" bgcolor="#FFFFFF">Companie *:</td>
      <td align="left" bgcolor="#FFFFFF" ><strong>
         <?=$vl[denumire]?> 
        <br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">CUI *:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[cui]?>           </td>
    </tr>
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">Nr.inregistrare *:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[reg_comert]?> </td>
    </tr>
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">Banca *:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[banca]?>          </td>
    </tr>
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">Cont bancar *:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[cont]?>          </td>
    </tr>
  </table>
     
     
     
     <table width="100%"   cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" class="content">
    <tr valign="top">
      <td width="124" align="left" bgcolor="#FFFFFF">Localitate*:</td>
      <td align="left" bgcolor="#FFFFFF" > <?=$vl[localitate]?>
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left" bgcolor="#FFFFFF">Judet*:</td>
      <td align="left" bgcolor="#FFFFFF" ><?
$judete = mysql_query_assoc("SELECT * FROM erad_judete where id_judet='".$vl[id_judet]."'");
?>
            
            <?=$judete[0][judet]?>
          
          </strong> </td>
    </tr>
   
    <tr>
      <td align="left" bgcolor="#FFFFFF"><strong>Adresa facturare*:</strong><br /></td>
      <td align="left" valign="top" bgcolor="#FFFFFF"  >
      <?=$vl[adresa_facturare]?> 
         <br /></td>
    </tr>
  
  
  <tr>
    <td bgcolor="#FFFFFF"><strong>Adresa de livrare*:</strong></td>
    <td align="left" bgcolor="#FFFFFF"><?=$vl[adresa_livrare]?></td>
  </tr>

  <tr align="right">
    <td height="15" colspan="2" bgcolor="#FFFFFF"></td>
  </tr>
  </table>
  
  
  </div>
  <!-- end centru -->
        
         
      
       
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
