<? include('settings/s_settings.php');


$Usr = new UserManagement($DBF['erad_users']);



if(isset($_POST[s_sign_up])) {
	$vl = array();
	$vl = $_POST;


	
	#verificari
	$error = array();
	 

	//if (!chk_email($_POST['email'])) $error[]='Email incorect'; 
	 	
	 if(trim($vl[parolanoua])<>'')  { 
			if($vl[parolanoua] != $vl[rparolanoua]) $error[] = 'Parola retiparita este gresita';
			 if(md5($vl[parolaveche])<>$vl[parolavechex])	$error[] = 'Introduceti parola veche';
			  $parola_noua=md5($vl[parolanoua]);
	//605823
	if(empty($error)) mysql_query ("update erad_users set password='".$parola_noua."' where id_user='".$_SESSION[iduser]."'");
	 		}
	
	
	
	if($vl[adr_fact]==1)  $vl[adresa_livrare]=$vl[adresa_facturare]; 
	if($vl[adr_fact]==2)  $vl[adresa_livrare]=$vl[adresa_livrare]; 
	 $vldb = $Usr->FormToDb($vl);
	 
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
	 	//if (!chk_empty($vl['password'])) 956555
	 
		
		$ins = $Usr->update($vldb, $_SESSION[iduser] );
	
		if($ins) {
			echo js_redirect($scr.'?msg_ok=1');
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
	}
	
} else {
$vldb=$Usr->get01($_SESSION[iduser]);
  
$vl=$Usr->DbToForm($vldb);
}


$title=SITE_NAME ." - Modificare date cont";
?>

<? 

include "head_data.php";?>

 


<body  style="margin:0;"> 
 

<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
       <div id="LEFT" class="left" >
                
            <? $tip=3;?>
             <? include "left_cont.php";?>
            <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
             
          
        </div>
        
         
        
        
        
        <div id="CENTRU" class="centru">
            
 <p class="titlu_mare">Modificare date personale si livrare</p>
 
<br>
  
		
<? if($_GET[msg_ok] == 1) { ?>  
	<div class="ok">
    Datele dvs. au fost modificate
	</div>
<? }  ?>


<form  name="sform"  action="<?=SITE_URL?>cont_edit.php" method="post" id="login_customer"  >
          
								
 
		    <? if(count($error)>0) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 
        
        
        	  
                      
        
<table cellpadding="0" cellspacing="10" width="500" class="content_cont">
<td align="right" valign="top"></td>
    <td align="left" >    </td>
<tr valign="top">
  <td height="26" colspan="2" align="left" valign="middle" bgcolor="#efefef" class="sapou">
<strong>  Date de livrare:</strong> </td>
</tr>
<tr>
  <td ><input type="radio" name="client" value="1"  checked  onClick="hide_x('persj'); show_x('persf');" <?=checked($vl[client],1);?>>
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
      <td width="134" align="left">Telefon*:</td>
      <td width="344" align="left" ><input name="telefon" size="40" type="text" class="input" value="<?=$vl[telefon]?>" /></td>
    </tr>
   </table>
   
   
   <table id="persf" cellpadding="0" cellspacing="10" width="500" class="content_cont" <? if($vl[client]==2) echo 'style="display:none;"';?> >
    <tr valign="top">
      <td width="134" align="left">CNP*:</td>
      <td  width="344" align="left" ><input name="cnp" size="40" type="text" class="input" value="<?=$vl[cnp]?>" />
          <strong><br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">CI*:</td>
      <td align="left" ><input name="ci" size="40" type="text" class="input" value="<?=$vl[ci]?>" />          </td>
    </tr>
  </table>
  
  
  <table id="persj" cellpadding="0" cellspacing="10" width="500" class="content_cont" <? if($vl[client]==1 or  $vl[client]==0) echo 'style="display:none;"';?>>
    <tr valign="top">
      <td width="134" align="left">Companie *:</td>
      <td width="344" align="left" ><strong>
        <input name="denumire" size="40" type="text" class="input" value="<?=$vl[denumire]?>" />
        <br />
        </strong> </td>
    </tr>
    <tr valign="top">
      <td align="left">CUI *:</td>
      <td align="left" ><input name="cui" size="40" type="text" class="input" value="<?=$vl[cui]?>" />          </td>
    </tr>
    <tr valign="top">
      <td align="left">Nr.inregistrare *:</td>
      <td align="left" ><input name="reg_comert" size="40" type="text" class="input" value="<?=$vl[reg_comert]?>" /></td>
    </tr>
    <tr valign="top">
      <td align="left">Banca *:</td>
      <td align="left" ><input name="banca" size="40" type="text" class="input" value="<?=$vl[banca]?>" />      </td>
    </tr>
    <tr valign="top">
      <td align="left">Cont bancar *:</td>
      <td align="left" ><input name="cont" size="40" type="text" class="input" value="<?=$vl[cont]?>" />      </td>
    </tr>
    <tr valign="top">
      <td align="left">&nbsp;</td>
      <td align="left" >&nbsp;</td>
    </tr>
  </table>
  
  
  <table   cellpadding="0" cellspacing="10" width="500" class="content_cont">
    <tr valign="top">
      <td width="134" align="left">Localitate*:</td>
      <td  width="344" align="left" ><input name="localitate" size="40" type="text" class="input" value="<?=$vl[localitate]?>" />
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
  
  
  <table id="adf" cellpadding="0" cellspacing="10" width="500" class="content_cont" <? if($vl[adr_fact]==1   or $vl[adr_fact]==0) echo 'style="display:none;"';?>>
   <tr>
     <td align="left" width="134">Adresa de livrare*:<br />
       Str, nr, bl , ap, zona      </td>
     <td width="344" align="left" valign="top"  ><textarea name="adresa_livrare" rows="5" cols="37" style="height:60px;" class="input"><?=$vl[adresa_livrare]?></textarea>     </td>
   </tr> 
   
  <tr align="right">
    <td align="center">&nbsp;</td>
    <td align="left" class="small_text_produs"> (Adaugati si un reper pentru curier ex: cladirea Vodafone)</td>
   </tr>
 </table>
 
 
 
 
 
 <table  cellpadding="0" cellspacing="10" width="500" class="content"  >
    <tr align="right">
    <td width="124" align="center">&nbsp;</td>
    <td align="left">
    
                                      <input type="hidden" name="s_sign_up" value="1" />                               
   
    
    
    <div class="buttons" style="  ">
    <button type="submit" class="positive"  >
      <img src="images/icons/tick.png" alt=""/> 
      Salveaza
      </button>
    </div>
    
    </td>
   </tr>
 </table>
            
        </form> 
					   
					  
    
         
         
        </div><!-- end center -->
        
      
      
        
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
