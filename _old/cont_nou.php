<? include('settings/s_settings.php');


 
if(isset($_POST[s_sign_up])) {
	$vl = array();
	$vl = $_POST;
	
	 #verificari
	$error = array();
		
		if (!chk_email($vl['email'])) $error[]='Email necompletat'; 
		if (!chk_empty($vl['nume_user'])) $error[]='Nume necompletat'; 
			else if (!chk_user($vl['email'], 'erad_users')) $error[]='Adresa de email se afla deja in baza de date. <a href="'.SITE_URL.'pages.php?link=recuperare" class="default_link" > Ati uitat parola? </a>'; 
		if (!chk_empty($vl['password'])) $error[]='Toate campurile sunt obligatorii'; 
			else if($vl[password] != $vl[r_password]) $error[] = 'Parola retiparita este gresita';
		
// print_r ($error); exit;

	if(empty($error)) {
 $vl[password]=md5($vl[password]);
 
	 

	 	$ins =  mysql_query("insert into erad_users set email='".$vl[email]."', nume_user='".$vl[nume_user]."', password='".$vl[password]."'  ");
	
		if($ins) {
$last_id=get_last_mysql_id('erad_users');		
///////////////////////////
 mysql_query("insert into erad_newsletter set nl_email='".$_POST[email]."', activ=1 ");


$usrr=mysql_query_assoc("select * from erad_users where id_user='".$last_id."'");

 $_SESSION[user] = $usrr[0];
 $_SESSION[user][login] = 1;	
 $_SESSION[iduser]=$last_id; 

 
 $catre_email=$usrr[0][email];
 
$nume=SITE_NAME;
$email=PROFORMA_SENDER_EMAIL;
 
 
$subject = "Contul dvs. pe ".SITE_NAME." a fost creat cu succes ";
$message = '<span class=content>
 
Contul dvs. pe '.SITE_NAME.' a fost creat cu succes. Va multumim pentru increderea acordata. 
<br>

Veti putea efectua comenzi mai simplu, veti fi la curent cu toate noutatile noastre.
<br>
<br>

Datele de logare pentru contul dvs. sunt:
  <br>
Email: '.$usrr[0][email].' <br>
Parola: '.$_POST[password].' <br>
<br>
<br>
Pentru a va autentifica, click pe urmatorul <a href="'.SITE_URL.'auth.html"><strong>LINK</strong></a>
<br>
<br>

Va multumim,<br>
Echipa '.SITE_NAME.'</span>';
  
 $sent_nr=0;
  $message = '<html><head><style>'.file_get_contents(SITE_DIR.'style/style.css').'</style></head><body style="background-color:#ffffff; background:none; color:#000000;">'.$message.'</body></html>';
  
  
 if(send_mail($catre_email, $subject, $message, $nume, $email))
						$sent_nr++;
  
////////////////////////////////
		
		
			echo js_redirect($scr.'?msg_ok=1');
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
	}
	
}
$title=SITE_NAME ." &raquo; Cont nou";
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;

?>
<?  

include "head_data.php"?>


<body  style="margin:0;"> 
 

<div id="wrap" > 
 
	<? include "header.php"; ?>

    
    <div id="main"  > 
    
       <div id="LEFT" class="left" >
                
            <? $tip=3;?>
           <? include "box_intrebari.php";?>
            <? include "banner_left.php";?>
             
            

            
            
       
            
        </div>
        
         
        
        
        
        <div id="CENTRU" class="centru">
                <div id="nav" class="nav">
                        <a href="<?=SITE_URL?>" class="nav">Home</a> &raquo;
                        <a href="#" class="nav"> <?=$title?></a>  
           </div>    

<br>
<br>
 
            <h1 class="titlu_mare" ><?=$title?></h1> 
            <br>
<br>
    
  		
	 
	
  
 
                    
            <? if($_GET[msg_ok] == 1) { ?>  
                <p align="left" class="mesaj">
                
                Contul dvs. pe <?=SITE_NAME?> a fost creat cu succes. Va multumim pentru increderea acordata. <br>


Veti putea efectua comenzi mai simplu, veti fi la curent cu toate noutatile noastre.
<br>

Va multumim. 
<br>
<br>
<div class="buttons"  style="float:left; margin-right:20px;" >
    <a href="<?=SITE_URL?>" class="positive">
        <img src="images/icons/basket_add.png" alt=""/> 
      Continua cumparaturile 
    </a>
  </div>
        
      
      
  
    <div class="buttons" style="float:left; margin-right:20px;">
    <a href="<?=SITE_URL?>cont_edit.php">
        <img src="images/icons/user_edit.png" alt=""/> 
     Modifica-ti datele din cont
    </a>
  </div>
           
      
 
  <div class="buttons" style="float:left; ">
    <a href="<?=SITE_URL?>index.html?logout=1" class="negative">
        <img src="images/icons/key.png" alt=""/> 
     Logout
    </a>
  </div>
               
                <br>
				
                </p>
                <br/><br/>
            <? } else { ?>
           
           
          <form name="sform" action="#" method="post" id="login_customer">
           
           
                
                     
            <? if(count($error)>0) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 
            
 <p class="content_cont" align="left">
 Bine ati venit in zona de creare cont nou pe <?=SITE_NAME?>. 
 <br>
Odata cu creearea contului veti putea plasa comenzi din paginile de produse, veti putea urmari statusurile si istoricul comenzilor efectuate, veti putea fi la curent cu noutatile pe care le oferim.  
<br>
<br>


</p>

<br>
   
            
            <table width="500" border="0" align="left" cellpadding="0" cellspacing="10" class="content_cont"  >
                <tbody>
                          
                            
                  <tr>
                    <td align="left" >Nume:</td>
                    <td align="left" ><input name="nume_user" size="50" type="text" class="input" value="<?=$vl[nume_user]?>"    /></td>
                  </tr>
                  <tr>
                    <td width="130" align="left" >Adresa de email:</td>
                    <td align="left" ><input name="email" size="50" type="text" class="input" value="<?=$vl[email]?>"    /></td>
                  </tr>
                  <tr>
                    <td align="left" >Parola:</td>
                    <td align="left" >
				    <input id="password" name="password" size="26" type="password" class="input"   /></td>
                  </tr>
                  <tr>
                    <td align="left" >Confirma parola:</td>
                    <td align="left" >
					   <input id="r_password" name="r_password" size="26" type="password" class="input"    />				    </td>
                  </tr>
                            <tr>
                              <td align="right" >&nbsp;</td>
                              <td align="left" >  
                             
                              
                                    <input type="hidden" name="s_sign_up" value="1" />                               
    <div class="buttons" style=" float:left; margin-left:10px;">
    <button type="submit" class="positive"  >
      <img src="images/icons/tick.png" alt=""/> 
      Creeaza cont
      </button>
    </div>        
                          
                            </tr>
              </tbody>
            </table>
                                  
                         
            
            
            
          
                                  
                     
          </form>
            <? } ?>
                      
                      
        
         
         
        </div><!-- end center -->
        
    
         
      
        
    </div>
    
    
     <? include "foot.php";?>
    

</div>


</body>
</html>
