<? include('settings/s_settings.php');
 $Usr = new UserManagement($DBF['erad_users']);
 if(isset($_POST[s_sign_up])) {
	$vl = array();
	$vl = $_POST;
	
	$vldb = $Usr->FormToDb($vl);

		
	#verificari
	$error = array();
		if (!chk_empty($vl['nume_user'])) $error[]='Nume necompletat'; 
		if (!chk_email($vl['email'])) $error[]='Email necompletat'; 
			else if (!chk_user($vl['email'], 'erad_users')) $error[]='Adresa de email se afla deja in baza de date. <a href="'.SITE_URL.'pages.php?link=recuperare" class="default_link" > Ati uitat parola? </a>'; 
		if (!chk_empty($vl['passwordx'])) $error[]='Toate campurile sunt obligatorii'; 
			else if($vl[passwordx] != $vl[r_password]) $error[] = 'Parola retiparita este gresita';
		
// print_r ($error); exit;

	if(empty($error)) {

$vl[passwordx]=md5($vl[passwordx]); 
$ins =  mysql_query("insert into erad_users set email='".$vl[email]."', password='".$vl[passwordx]."', nume_user='".$vl[nume_user]."'  ");
	 	 
	
		if($ins) {
$last_id=get_last_mysql_id('erad_users');		
///////////////////////////
 mysql_query("insert into erad_newsletter set nl_email='".$_POST[email]."', activ=1 ");


$usrr=mysql_query_assoc("select * from erad_users where id_user='".$last_id."'");

$_SESSION[iduser] = $last_id;
 $_SESSION[user][login] = 1;	
 

 
 $catre_email=$usrr[0][email];
 
$nume=SITE_NAME;
$email=PROFORMA_SENDER_EMAIL;
 
 
$subject = "Inscriere pe ".SITE_NAME;
$message = "<span class=content>
Contul dvs pe ".SITE_NAME." a fost activat. <br>
<br>

Datele de autentificare sunt: <br>
Email: ".$usrr[0][email]." <br>
Parola: ".$_POST[passwordx]." <br>
<br>
Va multumim,<br>
Echipa ".SITE_NAME."</span>";
  
 $sent_nr=0;
   $message = '<html><head><style>'.file_get_contents(SITE_DIR.'style/style.css').'</style></head><body style="background-color:#ffffff; color:#000000;">'.$message.'</body></html>';

  
 if(send_mail($catre_email, $subject, $message, $nume, $email))
						$sent_nr++;
  
////////////////////////////////
		
			echo js_redirect(SITE_URL."viewcart_livrare.php");
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
	}
	
}

 if($Login->check_login()) echo js_redirect(SITE_URL."viewcart_livrare.php");
$title="Cumparaturi :: Autentificare";

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
	 
			 <? $pas=1; include "viewcart_pasi.php";?>						  
							  
	 
            <h1 class="titlu_mare" ><?=$title?></h1> 
		

        
        
 <div id="auth_form">             
	
     <? if(count($error)>0 and isset($_POST[s_sign_up])) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 
    
     <? if($_err_login and isset($_POST[s_login])) { ?>
                <div class="error">
                   
                   Adresa de email sau parola gresite
                    
                </div>
            <? } ?> 
      
	  <? if(!$Login->check_login()) { ?>
<form  name="sform" action="<?=SITE_URL?>viewcart_auth.php" method="post" style="padding-left:10px;  "  >

<table id="login" width="659" border="0"   cellpadding="0" cellspacing="10" class="content_cont" <? if(!isset($_POST[s_sign_up]) or isset($_POST[s_login])) {?> <? } else {?>style="display:none;"<? }?>   >
  <tr>
    <td width="130" height="23" align="left"><? $fusr = strlen($_POST[username]) && isset($_POST[s_login]) ? $_POST[username] : 'email'; ?>
Adresa de email*: </td>
    <td align="left"><input type="text"    class="input" name="username"   size="40"  onClick="if(this.value == 'email') this.value = '';" onBlur="if(this.value == '') this.value = 'email';" /></td>
  </tr>
  <tr>
    <td height="22" align="left">Parola*:</td>
    <td align="left" valign="middle"><input type="password" name="password" class="input"  size="40" />   
    
   &nbsp;&nbsp;&nbsp; <a href="<?=SITE_URL?>pages.php?link=recuperare" class="content_cont"  > Am uitat parola</a>    </td>
  </tr>
 </table>
 
 
 <table id="cont_nou" width="659" border="0"   cellpadding="0" cellspacing="10" class="content_cont" <? if(isset($_POST[s_sign_up]) and !isset($_POST[s_login])) {?> <? } else {?>style="display:none;"<? }?>  >
  <tr>
                    <td align="left" >Nume:*</td>
                    <td align="left" ><input name="nume_user" size="40" type="text" class="input" value="<?=$vl[nume_user]?>"    /></td>
                  </tr>
  <tr>
    <td width="130" height="23" align="left"><? $fusr = strlen($_POST[username]) && isset($_POST[s_login]) ? $_POST[username] : 'email'; ?>
Adresa de email*: </td>
    <td align="left"><input type="text"    class="input" name="email" value="<?=$vl[email]?>"   size="40"  onClick="if(this.value == 'email') this.value = '';" onBlur="if(this.value == '') this.value = 'email';" /></td>
  </tr>
  <tr>
    <td height="22" align="left">Parola*:</td>
    <td align="left" valign="middle"><input type="password" name="passwordx" class="input"   size="40" />   
    
   &nbsp;</td>
  </tr>
  <tr>
    <td height="22" align="left">Confirma parola*:</td>
    <td align="left" valign="middle"><input name="r_password" size="40" maxlength="20" type="password" class="input"   /></td>
  </tr>
 </table>
 
 
 
 
 <table width="659" border="0"   cellpadding="0" cellspacing="10" class="content_cont"  >
  <tr>
    <td width="130">&nbsp;</td>
    <td align="left"><input type="radio" name="client" value="1" <? if(isset($_POST[s_sign_up]) and !isset($_POST[s_login])) {?> <? } else {?> checked <? }?> onClick="hide_x('cont_nou');show_x('login');    hide_x('s_sign_up');show_x('s_login');  hide_x('s_sign_upx'); show_x('s_loginx'); "> <strong>Sunt client <?=SITE_NAME?> si am cont pe site</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">
    <input type="radio" name="client" value="2" <? if(!isset($_POST[s_sign_up]) or isset($_POST[s_login])) {?> <? } else {?> checked<? }?>  onClick="show_x('cont_nou');hide_x('login'); show_x('s_sign_up'); hide_x('s_login');  show_x('s_sign_upx');hide_x('s_loginx');" > <strong>Nu am cont pe site</strong>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> 
      &nbsp;
      
    
 <div id="s_loginx" class="buttons" style=" float:left; margin-left:10px; <? if(!isset($_POST[s_sign_up]) or isset($_POST[s_login])) {?> <? } else {  ?> display:none; <? }?>">
    <button type="submit" class="positive"  >
      <img src="images/icons/tick.png" alt=""/> 
      Autentificare
      </button>
    </div>        
             
            
          									
            
             <input id="s_login"   name="s_login" type="hidden"    <? if(!isset($_POST[s_sign_up]) or isset($_POST[s_login])) {?> value="1" <? } else {  ?>    disabled style="display:none;"<? }?> />
    
    
     <div  id="s_sign_upx" class="buttons" style=" float:left; margin-left:10px; <? if(isset($_POST[s_sign_up]) and !isset($_POST[s_login])) {?> <? } else {?>    display:none;  <? }?>">
    <button type="submit" class="positive"  >
      <img src="images/icons/tick.png" alt=""/> 
      Creeaza cont
      </button>
    </div> 
     		 
           
            
             <input id="s_sign_up" name="s_sign_up" type="hidden"    <? if( isset($_POST[s_sign_up]) ) {?> value="1"  <? } else {  ?>   disabled style="display:none;"<? }?>/>										
     
    
     
     
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
  </tr>
</table>

<div class="titlu_mare">
	<? // <span> Daca doriti, puteti comanda si telefonic <a class="titlu_mare" style=" color:#FF0000;" href="http://www.aleroma.ro/Contact/Contactati-ne-2-2.html">aici</a> </span>?>
	</div>  
    
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
