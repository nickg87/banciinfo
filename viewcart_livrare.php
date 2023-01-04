<? include('settings/s_settings.php');
 
 
$Usr = new UserManagement($DBF['erad_users']);

 if(isset($_POST[s_livrare])) {
	$vl = array();
	$vl = $_POST;
	
	 
 
	 if($vl[adr_fact]==1)  $vl[adresa_livrare]=$vl[adresa_facturare]; 
	  if($vl[adr_fact]==2)  $vl[adresa_livrare]=$vl[adresa_livrare]; 
	 
	$vldb = $Usr->FormToDb($vl);


 
  
	#verificari
	$error = array();
	 
 	if($vl[client]==1) {
		if (!chk_cnp($vl['cnp'])) $error[]='<strong>CNP</strong> incorect'; 
		if (!chk_empty($vl['ci'])) $error[]='<strong>CI</strong> incorect'; 
		}
	if($vl[client]==2) {
		if (!chk_empty($vl['denumire'])) $error[]='Nu ati completat <strong>Denumirea firmei</strong>'; 
		if (!chk_empty($vl['cui'])) $error[]='Nu ati completat <strong>CUI</strong>'; 
		if (!chk_empty($vl['reg_comert'])) $error[]='Nu ati completat <strong>Nr. Inmatriculare</strong>'; 
		if (!chk_empty($vl['cont'])) $error[]='Nu ati completat <strong>IBAN</strong>'; 
		if (!chk_empty($vl['banca'])) $error[]='Nu ati completat <strong>Banca</strong>'; 
		}
		
		if (!chk_empty($vl['nume_user'])) $error[]='Nu ati completat <strong>Numele</strong>'; 
		if (!chk_empty($vl['telefon'])) $error[]='Nu ati completat <strong>Telefonul</strong>'; 
		
		if (!chk_empty($vl['id_judet'])) $error[]='Nu ati ales <strong>judetul</strong>';
		if (!chk_empty($vl['adresa_facturare'])) $error[]='Nu ati completat <strong>adresa de facturare</strong>'; 
		if (!chk_empty($vl['localitate'])) $error[]='Nu ati completat <strong>localitatea</strong>'; 
	
	if($vl[adr_fact]==2)  if (!chk_empty($vl['adresa_livrare'])) $error[]='Nu ati completat <strong>Adresa de livrare</strong>'; 
	
		 
	 $_SESSION[id_judet]=$vl[id_judet];
	 

	if(empty($error)) {
	
	
	
		 
		$ins = $Usr->update($vldb,$_SESSION[iduser]);
	 
		if($ins) {
		 		echo js_redirect(SITE_URL."viewcart_plata.php");
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
	}
	
}  else {
$vldb=$Usr->get01($_SESSION[iduser]);
 
$vl=$Usr->DbToForm($vldb); 
}
 
$title="Cumparaturi &raquo; Adresa de livrare si facturare";
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
             
           <div  style="     height:30px; width:230px;  float:left;"></div> 
           
            
            
       
            
      </div>
        
        
        
        
        
  <div  class="centru"   >
            
        
          
 
 <div style="width:100%; float:left;      " class="content">
						
                        <br>
						<br>
	 
			<? $pas=2;  include "viewcart_pasi.php";?>					  
							  
	 
        <h1 class="titlu_mare" ><?=$title?></h1> 
		

        
        
 <div id="auth_form">             
	
     <? if(count($error)>0 and isset($_POST[s_livrare])) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 
    
  
      
	  <? if($Login->check_login()) { ?>



<form name="sform" action="<?=SITE_URL?>viewcart_livrare.php" method="post" style="padding-left:10px;  "  >

<table cellpadding="0" cellspacing="10" width="500" class="content_cont">
<td align="right" valign="top"></td>
    <td align="left" >    </td>
<tr valign="top">
  <td height="26" colspan="2" align="left" valign="middle" bgcolor="#efefef" class="sapou">
<strong>  Date de livrare:</strong> </td>
</tr>
<tr>
  <td><input type="radio" name="client" value="1"  checked  onClick="hide_x('persj'); show_x('persf');" <?=checked($vl[client],1);?>>
    <strong>Persoana fizica</strong></td>
  <td align="left"><input type="radio" name="client" value="2"   onClick="show_x('persj'); hide_x('persf');  "  <?=checked($vl[client],2);?>>
    <strong>Persoana juridica</strong></td>
</tr>
</table>


<table cellpadding="0" cellspacing="10" width="500" class="content_cont">
<tr valign="top">
  <td colspan="2" align="left"><strong>Date personale de contact</strong></td>
  </tr>
<tr valign="top">
  <td width="134" align="left">Nume si prenume*:</td>
  <td width="344" align="left" ><input name="nume_user" size="40" type="text" class="input" value="<?=$vl[nume_user]?>" /> </td>
</tr>
     
    <tr valign="top">
      <td align="left">Telefon*:</td>
      <td align="left" ><input name="telefon" size="40" type="text" class="input" value="<?=$vl[telefon]?>" /></td>
    </tr>
   </table>

    <table id="persf" cellpadding="0" cellspacing="10" width="500" class="content_cont" <? if($vl[client]==2) echo 'style="display:none;"';?> >
    <tr valign="top">
      <td width="134" align="left">CNP*:</td>
      <td width="344" align="left" ><input name="cnp" size="40" type="text" class="input" value="<?=$vl[cnp]?>" />
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">CI*:</td>
      <td align="left" ><input name="ci" size="40" type="text" class="input" value="<?=$vl[ci]?>" />          </td>
    </tr>
  </table>
  
  
  <table id="persj" cellpadding="0" cellspacing="10" width="500" class="content_cont" <? if($vl[client]==1 or $vl[client]==0) echo 'style="display:none;"';?>>
    <tr valign="top">
      <td width="134" align="left">Companie*:</td>
      <td width="344" align="left" ><strong><input name="denumire" size="40" type="text" class="input" value="<?=$vl[denumire]?>" />
        </td>
    </tr>
    <tr valign="top">
      <td align="left">CUI*:</td>
      <td align="left" ><input name="cui" size="40" type="text" class="input" value="<?=$vl[cui]?>" />          </td>
    </tr>
    <tr valign="top">
      <td align="left">Nr.inregistrare*:</td>
      <td align="left" ><input name="reg_comert" size="40" type="text" class="input" value="<?=$vl[reg_comert]?>" /></td>
    </tr>
    <tr valign="top">
      <td align="left">Banca*:</td>
      <td align="left" ><input name="banca" size="40" type="text" class="input" value="<?=$vl[banca]?>" />      </td>
    </tr>
    <tr valign="top">
      <td align="left">Cont bancar*:</td>
      <td align="left" ><input name="cont" size="40" type="text" class="input" value="<?=$vl[cont]?>" />      </td>
    </tr>
    <tr valign="top">
      <td align="left">&nbsp;</td>
      <td align="left" >&nbsp;</td>
    </tr>
  </table>
  
  <table   cellpadding="0" cellspacing="10" width="500" class="content_cont">
    <tr valign="top">
      <td width ="134" align="left">Localitate*:</td>
      <td width ="344" align="left" ><input name="localitate" size="40" type="text" class="input" value="<?=$vl[localitate]?>" />
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">Judet*:</td>
      <td align="left" ><?
$judete = mysql_query_assoc("SELECT * FROM erad_judete ORDER BY judet");
?>
          <select name="id_judet"  class="input">
            <option value=""> - </option>
            <? for($i = 0; $i < count($judete); $i++) { ?>
            <option value="<?=$judete[$i][id_judet]?>" <?=selected($vl[id_judet], $judete[$i][id_judet])?>>
            <?=$judete[$i][judet]?>
            </option>
            <? } ?>
          </select>
          <br>
          </strong> </td>
    </tr>
   
    <tr>
      <td align="left"><strong>Adresa facturare*:</strong><br /></td>
      <td align="left" valign="top"  >
      <textarea name="adresa_facturare" rows="5" cols="37" style="height:60px;" class="input"><?=$vl[adresa_facturare]?></textarea>
         <br /></td>
    </tr>
  
  <tr align="left">
    <td></td>
  </tr>
  <tr>
    <td>Cod postal</td>
    <td align="left"><input name="cod_postal" size="40" type="text" class="input" value="<?=$vl[cod_postal]?>" /></td>
  </tr>
  <tr>
    <td><strong>Adresa de livrare*:</strong></td>
    <td align="left">
    <input   type="radio" name="adr_fact" value="1" <?=checked($vl[adr_fact], 1)?> onClick="hide_x('adf'); " checked >
    (aceeasi cu cea de facturare) 

    <input   type="radio" name="adr_fact" value="2" <?=checked($vl[adr_fact], 2)?> onClick="show_x('adf');  " > (alta adresa )      </td>
  </tr>

  <tr align="right">
    <td height="15" colspan="2"></td>
  </tr>
  </table>
  
 <table id="adf" cellpadding="0" cellspacing="10" width="500" class="content_cont" <? if($vl[adr_fact]==1 or $vl[adr_fact]==0) echo 'style="display:none;"';?>>
   <tr>
     <td align="left" width="134">Adresa de livrare*:<br />
       Str, nr, bl , ap, zona</td>
     <td align="left" valign="top"  ><textarea name="adresa_livrare" rows="5" cols="37" style="height:60px;" class="input"><?=$vl[adresa_livrare]?></textarea>
      </td>
   </tr> 
  <tr align="right">
    <td align="center">      
    <td align="left" class="small_text_produs"> (Adaugati si un reper pentru curier ex: cladirea Vodafone)    
    </tr>
 </table>
 
 <table cellpadding="0" cellspacing="10" width="500" class="content"  >
  <tr>
    <td width="134" align="right"></td>
    <td align="left" >
   
    <input name="s_livrare" type="hidden" value="1"    />
 									
            
      <div class="buttons" style=" float:left;margin-left:10px;">
    <button type="submit" class="positive"  >
      <img src="images/icons/basket_go.png" alt=""/> 
    Continua
      </button>
    </div>       
    
   
   </td>
  </tr>
</table>

 
  
  
  </form>
<? }?>
</div>				  
							 
							 
							 
						</div>    
          
         
         
    
    </div><!-- end centru -->
        
         
      
       
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
