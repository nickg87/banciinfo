<?
include('settings/s_settings.php');

include('cart_fx.php'); 

	
 

if (is_numeric($_GET[id_mod_plata])) $_SESSION[mod_plata]=$_GET[id_mod_plata]; 

if ($_GET[id_mod_plata]==1) {
//$_SESSION[cart][99999][pret]=0;
//$_SESSION[cart][99999][produs]="Comision Ramburs";	
//$_SESSION[cart][99999][cant]=1;	
 	 

// $_SESSION[cart][99999][pret]=fx($_SESSION[comanda_total]*0.02);
//$_SESSION[comanda_total]=	$_SESSION[comanda_total]+$_SESSION[cart][9999999][pret];

 echo js_redirect(SITE_URL.'checkout');
 }  elseif (is_numeric($_GET[id_mod_plata]) and $_GET[id_mod_plata]<>1) {
 unset($_SESSION[cart][99999]);
  // $_SESSION[mod_plata]=2;
 echo js_redirect(SITE_URL.'checkout');
  }





  $today=date('Y-m-d');


//print_r($_SESSION[cart]);

if(isset($_POST["finalizeaza"])) {
$Usr = new UserManagement($DBF['erad_comenzi']);  


	$vl = array();
	$vl = $_POST;
$vl[data_comanda]=$today;
$vl[total_cart]=$_SESSION[cart_total];
$vl[pret_livrare]=$_SESSION[pret_transport];
$vl[total_comanda]=$_SESSION[comanda_total];
$vl[id_user]=$_SESSION[iduser];
 $vl[id_mod_plata]=$_SESSION[mod_plata];
 
 
    	$vldb = $Usr->FormToDb($vl);
 	#verificari

	$error = array();
	$Usr->vld($vldb, $error);

	if(empty($error)) {
$ins = $Usr->insert($vldb);
 $id_comanda=get_last_mysql_id('erad_comenzi');
		if($ins) {
		foreach($_SESSION[cart] as $k => $v) {
				mysql_query("insert into erad_cart set 
				id_comanda='".$id_comanda."', 
				produs='".$v[produs]."', 
				id_produs='".$k."', 
				cant='".$v[cant]."', 
				pret_unitar='".$v[pret]."',
				pret_total='".fx($v[pret]*$v[cant])."'   
				");
			}
 			
			

///////////////////////////

 
  $catre_email=PROFORMA_SENDER_EMAIL;
//$catre_email='marius.serban@anadeea.ro';
$nume='Comanda';
$email=SITE_NAME;
 
 
$subject = "Comanda noua pe ".SITE_NAME;
$message = "Ati primit o comanda noua.<br> Pentru a o verifica va rugam sa va logati in panoul de administrare. ";
  
 $sent_nr=0;
   $message = '<html><head></head><body style=" background-color:#ffffff;">'.$message.'</body></html>';

  
 if(send_mail($catre_email, $subject, $message, $nume, $email))
						$sent_nr++;
 
  
 
////////////////////////////////


			
			
			
			
			echo js_redirect(SITE_URL.'pages.php?link=msg&msg=10');
		}
	}
}
 
 
 $title=SITE_NAME.' - Cos de cumparaturi';
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;


?>

<?  
include "head_data.php"?>


<body style="margin:0;"> 
 
<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
      <div id="LEFT" class="left" >
                
              
           <? $tip=3;?>
           <? include "left_cont.php";?>
             <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
             
           
         
            
        </div>
        
        
        
        
        
  <div  class="centru"   >
            
        
          
 
 <div style="width:100%; float:left;      " class="content">
						
                        <br>
						<br>
	 
							<div align="left"><span class="titlu_mare">Cos de cumparaturi</span>
                              <br>
                              <br>
							  
							  
							</div>  
							  
							  <? if(count($_SESSION[cart])) { ?>
						  
  <form name="sform" action="<?=SITE_URL?>viewcart?id_mod_plata=<?=$_GET[id_mod_plata]?>" method="post">
 			
		<input type="hidden" name="id_produs" value="<?=$id_produs?>">
													<table align="center" border="0" cellpadding="2" cellspacing="1" width="100%"  >
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
														  <td height="35" align="left" valign="top" bgcolor="#<?=(++$p % 2 == 0 ? 'f8f8f8' : 'ffffff')?>" style="border-bottom:1px solid #CCCCCC;"><a href="<?=get_link_produs($v[id_produs], $v[produs])?>" class="produs_nume_cauta"><strong><?=$v[produs]?>  </strong></a>
                                                          <br><span class="small_text"><?=$v[coordx]?></span>
                                                          </td>
														  <td align="left" bgcolor="#<?=($p % 2 == 0 ? 'f8f8f8' : 'ffffff')?>" style="border-bottom:1px solid #CCCCCC;">
														  <input type="text" name="cant[<?=$k?>]" value="<?=$v[cant]?>" size="1" class="input" />
														  <? if($v[produs]<>'Comision Ramburs'){?><a href="<?=SITE_URL?>remove_from_cart/<?=$k?>"  title="Sterge Produsul"><img  src="images/del.png" alt="Sterge Produsul" width="20" height="20" border="0" align="absmiddle" /></a> <? } ?>                                                          </td>
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
														  <td align="right" bgcolor="#999999" class="input"><strong>Total:</strong></td>
														  <td align="left" bgcolor="#666666" class="input" nowrap="nowrap" style="font-size:12px;"><strong><?=$_SESSION[cart_total]?>    </strong>Lei														  </td>
														</tr>
														<tr>
														  <td height="30" colspan="4" align="right" style="border-bottom:1px solid #CCCCCC;">
                                                         <? if($_SESSION[cart_total]<SUMA_MINIMA_ACHIZITIONATA) {?>
                                                          <span class="mesaj_rosu">Comanda minima este de <strong><?=SUMA_MINIMA_ACHIZITIONATA?> Lei</strong></span>  
                                                         <? }?>                                                          </td>
													    </tr>
														<tr>
														  <td height="50" colspan="2" align="center" style="border-bottom:1px solid #CCCCCC;">
														  
  <div class="buttons">
    <a href="<?=SITE_URL?>lista.php?id=999999" >
        <img src="images/icons/basket_add.png" alt=""/> 
      Continua cumparaturile 
    </a>
  </div>
                                                          
                                                          
                                                         
                                                       
  <div class="buttons" style=" float:left;margin-left:100px;">
    <button type="submit" class="negative" >
      <img src="images/icons/basket_edit.png" alt=""/> 
      Actualizeaza cosul
      </button>
    </div>
  <input type="hidden" name="s_update_cart" class="but2"    />                                                          </td>
														  <td colspan="2" align="right" style="border-bottom:1px solid #CCCCCC;">
														
														<? if($_SESSION[cart_total]>=SUMA_MINIMA_ACHIZITIONATA) {?>
                                                        
														<? if(!$Login->check_login()) { ?>
                                                          
                                                        
                                                         <div class="buttons" style="float:right;">
                                                            <a href="<?=SITE_URL?>viewcart_auth.php" class="positive">
                                                                <img src="images/icons/tick.png" alt=""/> 
                                                             Finalizeaza comanda
                                                            </a>
                                                          </div>

                                                            											  
                                                          <? }  else {?>
                                                           
                                                            
                                                            <div class="buttons" style="float:right;">
                                                            <a href="<?=SITE_URL?>viewcart_livrare.php" class="positive">
                                                                <img src="images/icons/tick.png" alt=""/> 
                                                             Finalizeaza comanda
                                                            </a>
                                                          </div>
                                                                                                                  
                                                          <? }?>    
                                                          
                                                          <? }?>                                                          </td>
														</tr>
													  </tbody>
												  </table>
<input type="hidden" name="total_comanda" value="<?=$_SESSION[cart][total]+transport($greutate_total)?>" />
										
						  </form>
									
									
									<? if ($_GET["checkout"]) {?>
										
									<? if(!$Login->check_login()) { ?>
										
                                      <br>

                                      <div style="width:580px; height:80px; padding:20px; border:2px solid #efefef;">
                                        <p class="content" >Trebuie sa fiti logat pt. a efectua o comanda.<br/>
											Va rugam sa folositi formularul de autentificare din partea de sus a paginii.<br/>
											<br>
												In caz ca nu aveti cont, puteti crea un cont nou <a href="<?=SITE_URL?>cont_nou.html" class="but">aici</a>.
										</p>
                                        </div>
									<? } else { ?>
									 
									<? } ?>
									<? } ?>
									
									
									
									<? } else { ?>
									
 <p align="left" class="content_cont">
 
 
             
      
       
         
   Bine ati venit in Cosul de Cumparaturi de pe <strong><?=SITE_NAME?></strong>.
   <br><br>

 Momentan nu ati adaugat produse in cos si acesta este gol.

Pentru a putea comanda produsele oferite de site-ul nostru trebuie sa mergeti in zona de produse, sa alegeti produsul sau produsele dorite si sa si sa folositi butonul <strong>Adauga in cos</strong>. 

<br>

<br>

Imediat dupa aceea <strong>Cosul de Cumparaturi</strong> va include produsele selectate impreuna cu preturile si cantitatile comandate. 
Puteti ulterior sa modificati numarul de produse comandate, sa eliminati produse din cos sau sa adaugati altele noi, revenind in zona de magazin.
<br>
<br>

Pentru a merge in magazin si a incepe cumparaturile, dati click <a href="<?=SITE_URL?>" class="content_cont"><strong>aici</strong></a>. 
<br>
<br>
Pentru detalii suplimentare, nelamuriri sau sesizari, asteptam mesajele dvs. prin::

<br>

- e-mail, la adresa: <strong><?=$hf[0][emails];?></strong>
<br>

- telefonic, la: <strong> <?=$hf[0][telefoane];?></strong>

        <br>
        <br>
 

        
  <div class="buttons"  style="float:left; margin-right:20px;" >
    <a href="<?=SITE_URL?>" class="positive">
        <img src="images/icons/basket_add.png" alt=""/> 
      Continua cumparaturile 
    </a>
  </div>
        
      
      
  
    

</p>
                                    
									<? } ?>	 
							  
							 
							 
							 
							 
						</div>    
          
         
         
      
        </div><!-- end centru -->
        
         
      
       
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
