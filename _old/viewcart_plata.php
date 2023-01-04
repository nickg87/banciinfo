<? include('settings/s_settings.php');
 
include('cart_fx.php'); 

$curier = mysql_query_assoc("select * from erad_curier order by curier_nume asc");
 
 
 if(isset($_POST[s_taxe])) {
 	$vl = array();
	$vl = $_POST;
 #verificari
	$error = array();
	 
 	 
	 
if(count($curier)>0) if (!chk_empty($vl['id_curier'])) $error[]='Nu ati ales <strong>modalitatea de livrare</strong>'; 
if(count($curier)==0) {   $_SESSION[taxa_transport]=0;    $_SESSION[comanda_total]= $_SESSION[cart_total];}
	
			if (!chk_empty($vl['id_mod_plata'])) $error[]='Nu ati ales <strong>modalitatea de plata</strong>';  
 
 if(empty($error)) {
  $_SESSION[id_curier]=$vl["id_curier"];
 
  $_SESSION[id_mod_plata]=$vl['id_mod_plata'];
  	echo js_redirect(SITE_URL."viewcart_checkout.php");
 }
 }
 
 
  $id_judet=mysql_query_scalar("select id_judet from erad_users where id_user='".$_SESSION[iduser]."'");
 
$title="Cumparaturi &raquo; Modalitate de plata si transport";
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
            
        
          
  <form name="sform" action="<?=SITE_URL?>viewcart_plata.php" method="post"    >
  
  
 <div style="width:100%; float:left;      " class="content_cont">
						
                        <br>
						<br>
	 
			<? $pas=3; include "viewcart_pasi.php";?>					  
							  
   

 
        <h1 class="titlu_mare" ><?=$title?></h1> 
        
   
           <br>
<br>

	
					 <? if(count($error)>0 and isset($_POST[s_taxe])) { ?>
                                <div class="error">
                                   
                                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
                                    
                                    ?>
                                    
                                </div>
                            <? } ?> 
                    
                  
    <div id="container_principal" class="content_cont">                    
                      <? if($Login->check_login()) { ?>
                
                
                
  <?   if (1==1 ) {?>            
                 
                <? for ($j=0; $j<count($curier); $j++) {
                $taxe = mysql_query_assoc("select * from erad_judete_curier where id_curier='".$curier[$j]['id_curier']."' and id_judet='".$_SESSION[id_judet]."'");
				
				if (  $taxe[0][taxa_standard]<>0 or $taxe[0][suma_transport_gratuit]<>0 ) {?>
				
             
                
                <table cellpadding="2" cellspacing="2" width="90%" class="content_cont">
                 
                <tr valign="top">
                  <td width="78" align="center"  >
                  
				  <? $cost_transport=transport($_SESSION[greutate_totala_colet], $taxe[0][taxa_standard],  $taxe[0][taxa_per_kg])?>
                  
                  <input type="radio" name="id_curier" value="<?=$curier[$j]['id_curier']?>" onClick="load_taxa('<?=$cost_transport?>');"></td>
                  <td width="753" align="left"  >
                  <span class="content_cont"><strong><?=$curier[$j]['curier_nume']?></strong></span>
                  
                <br>
 
                 &raquo;
                  <span class="content_cont"><strong> 
				  <? if( $_SESSION[cart_total] >= $taxe[0][suma_transport_gratuit]) {?>
                  Gratuit
                  <? } else {?>
				  <?=transport($_SESSION[greutate_totala_colet], $taxe[0][taxa_standard],  $taxe[0][taxa_per_kg])?> lei
                 <? }?>
                  </strong></span></td>
                  <td width="259" align="right"  >Expediere in 
                  <?=$curier[$j]['durata_expeditie']?></td>
                  </tr>
                 
                    <tr valign="top">
                      <td colspan="3" align="left" class="small_text_produs"  style="border-bottom:1px solid #CCCCCC;">
                        <?=$curier[$j]['descriere_curier']?>      </td>
                      </tr>
                   </table>
                
            <? }  ?>
            
          
            
             <? }?>   
     <? } else {?>           
     
		 
     <script>load_taxa('0');</script>
    
       <table cellpadding="0" cellspacing="10" width="90%" class="content_cont">
                <td align="right" valign="top"></td>
                    <td align="left" > 
                     <input type="hidden" name="id_curier"  value="1">
                     
                       </td>
               
                <tr valign="top">
                  <td height="26" colspan="2" align="left" valign="middle" class="content_cont"><strong>Beneficiati de transport GRATUIT!</strong></td>
                </tr>
            </table>
     
     
       
     
     
     <? }?>
                
          <table cellpadding="0" cellspacing="10" width="90%" class="content_cont">
                <td align="right" valign="top"></td>
                  <td align="left" >    </td>
                <tr valign="top">
                  <td height="26" colspan="2" align="left" valign="middle" bgcolor="#efefef" class="sapou">
                <strong> Modalitate de plata</strong> </td>
                </tr>
            </table>
                
                
                	<? $mod_plata = mysql_query_assoc("SELECT * FROM erad_mod_plata WHERE activa = '1'"); ?>
                
                    <table cellpadding="0" cellspacing="10" width="90%" class="content_cont"  >
                
                
                  <tr>
                    <td colspan="2" align="left" class="content_cont">               
                         
                    
			 <? for($i = 0; $i < count($mod_plata); $i++) { ?>
			 <input type="radio" name="id_mod_plata" value="<?=$mod_plata[$i][id_mod_plata]?>">   
			 <?=$mod_plata[$i][mod_plata]?>&nbsp;&nbsp;&nbsp;&nbsp;
               <? } ?>              </td>
                    </tr>
                  <tr>
                    <td width="82" align="right"></td>
                    <td width="998" align="left" >                  </td>
                  </tr>
                  <tr>
                    <td align="right"></td>
                    <td align="left" >
                    
                    
                     
                       <input name="s_taxe" type="hidden" value="1"    />
   <div class="buttons" style=" float:left; ">
    <button type="submit" class="positive"  >
      <img src="images/icons/basket_go.png" alt=""/> 
    Continua
      </button>
    </div>                   </td>
                  </tr>
                </table>
                
                 
                  
                  
        
            <? }?>
         			  
                       
 </div>							 
	
   
    
    <div  id="coloana_dreapta_cart" class="content_cont">
    
    <span class="content_cont"> <strong>Valoare comanda:</strong> </span>
    <br>
    <br>

 
    
   <?=count($_SESSION[cart])?> <? if (count($_SESSION[cart])==1) echo "produs"; else echo "produse";?>, 
 
 <span class="pret_produs"><strong><?=$_SESSION[cart_total]?></strong> lei</span>  
   <hr size="1">
   
   <br>
<br>

    <span class="content_cont"> <strong>TOTAL:</strong> </span>
   
    
     
 
 <span class="pret_produs"><strong><span id="taxax"><?=$_SESSION[cart_total]?></span></strong> lei</span>  
   <hr size="1">
   
  
   
    </div>
   
    						 
							 
 </div>    
          
    </form>       
         
    
    </div><!-- end centru -->
        
         
      
       
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
