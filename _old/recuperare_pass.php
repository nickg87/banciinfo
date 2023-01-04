<?  
  if(isset($_POST['s_go'])){

$email=trim($_POST[email]);
$error = array();
if($email=='') $error[]='Nu ati introdus adresa de email! ';

$pas=mysql_query_assoc("
select * from erad_users where email= '".$email."';
");

 
 $today = date("Y-m-d");


		
	 

 if (count($pas)==0) { 
 $error[]= ' Adresa de e-mail nu exista in baza noastra de date! ';
  }
 
 
 
$key=substr($_SESSION['key'],0,5);
$number = $_REQUEST['number'];
  if($number!=$key){
	   
	 $error[]= ' Codul de validare nu este valid! va rugam sa incercati din nou! ';
		  }
 

if ($err==0) {
 
   
 if(isset($_POST['s_go']) and empty($error) ) {
  
  $pas[0][password]=rand(23102, 981233);  

$md5pass=md5($pas[0][password]);

mysql_query("update erad_users set password='".$md5pass."' where  email= '".$email."'");
 
  
//$cc="comenzi@programdefacturare.ro";
$catre_email=$_POST[email];
$nume=PROFORMA_SENDER_NAME;
$email=PROFORMA_SENDER_EMAIL;

 
	$subject = "Recuperare parola :  ".SITE_NAME;
echo 	  $message = "
 
Datele de autentificare pe site-ul ".SITE_NAME.":
<br>
<br>

USERNAME: <b>".$pas[0][email]."</b>
<br>

PAROLA: <b>".$pas[0][password]."</b>
 
	
	";
	 exit;

 $message = '<html><head></head><body>'.$message.'</body></html>';
  if(send_mail($catre_email, $subject, $message, $nume, $email))
						$sent_nr++;
		 
			
			
			if($sent_nr > 0) {
			
		 			
				$msg[] = 'Mail trimis.';
			} else {
				$msg[] = 'Mail netrimis.';
			}
				
	 
//////////////////////////////////////		
		
	 		
		
		 
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
 
}




}  

?>

        <div id="CENTRU" class="centru">
                <div id="nav"   class="nav">
                        <a href="<?=SITE_URL?>" class="nav">Home</a> &raquo;
                        <a href="#" class="nav"> Recuperare parola</a>  
           		</div>    
<br><br>

<div style="width:100%; height:30px; float:left; text-align:left; position:relative; padding-left:10px;" class="titlu_produs">

<p class="titlu_mare">Recuperare parola</p>
 
 
 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="content_cont"  >
  <tr>
    <td  align="left"> 
 
 

     <? if(count($error)>0) { ?>
                <div class="error">
                   
                    <? foreach($error as $er) if($er<>'') echo '&raquo; '.$er.'<br>';
					
					?>
                    
                </div>
            <? } ?> 

      <? if ($msg<>'') {?> <p align="center"   class="error"> <? echo implode(' <br> ', $msg); ?></p> <? }?>
<form name="sform" action="<?=SITE_URL?>pages.php?link=recuperare" method="post">


In cazul in care doriti sa va autentificati in contul dvs. dar nu mai retineti parola, introduceti adresa de e-mail folosita la crearea contului in campul de mai jos. In cel mai scurt timp veti primi pe aceasta adresa datele de autentificare.
<br />
<br />

Daca folositi adrese de e-mail de genul Yahoo sau G-Mail sau aveti instalate programe de filtrare a e-mailurilor primite, verificati si sectiunile Spam / Trash; este posibil ca e-mailul trimis de noi sa ajunga in aceste foldere.

 
 <br />
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="26%" align="right">Introduceti adresa de email: </td>
    <td width="74%" align="left"><input name="email" type="text" class="input" size="40" /></td>
  </tr>
  <tr>
    <td align="right">Tastati codul din imagine:</td>
    <td align="left"><input name="number" type="text" id="number" size="5" class="input" />
&nbsp; <img src="php_captcha.php" align="top" /> </td>
  </tr>
  <tr>
    <td align="right">
    
         <input type="hidden" name="s_go" value="1" />                               
     
 </td>
    <td align="left">
    
     <div   class="buttons" style=" float:left; margin-left:10px; ">
    <button type="submit" class="positive"  >
      <img src="images/icons/textfield_key.png" alt=""/> 
      Recupereaza parola
      </button>
    </div>
    </td>
  </tr>
</table>
<br />
<br />
<br />
  <br>
  <br />
</form>

  </td>
    </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
</div>