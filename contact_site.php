<?

function send_mail($catre, $titlu, $text, $from_name, $from_address) {
	$headers  = "From: $from_name <$from_address>\n";
	$headers .= "Return-Path: <$from_address>\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\n";
	$x = mail($catre, $titlu, $text, $headers);
	if($x) return 1;
	else return 0;
}


include('class.email.php');

function chk_email($c) {
	if(!valid_email($c))
		return 0;
		else return 1;
}

function valid_email($email){
	if(strlen($email) > 0) {
		$m = array();
		eregi ("(^[a-z0-9\.\_-]{1,})\@([a-z0-9\.-]{1,})\.([a-z]{2,3})$", $email, $m);
		if($m[0] != $email) return false;
		else return true;
	} else {
		return false;
	}
}


if(isset($_POST['s_go'])){

$de_la=strip_tags(trim($_POST[de_la]));
$nume=strip_tags(trim($_POST[nume]));
$pers_contact=trim($_POST[pers_contact]);
$telefon=strip_tags(trim($_POST[telefon]));
$mesaj=strip_tags(trim($_POST[mesaj]));
$localitate=strip_tags(trim($_POST[localitate]));
$error = array();

if($de_la=='' or !chk_email($de_la)) $error[]='Nu ati introdus adresa de email! ';

if($nume=='') $error[]='Nu ati completat numele dvs! ';
if($telefon=='') $error[]='Nu ati completat telefonul! ';
 if($mesaj=='') $error[]='Nu ati completat mesajul! ';
 
 $today = date("Y-m-d");
  
 
  $key=$_SESSION['security_code'];
$number = $_REQUEST['number'];
  if($number!=$key){
	   
	  $error[]= ' Codul de validare nu este valid! va rugam sa incercati din nou! ';
		  }
 
 
if (count($error)==0) {
 
   
 if(isset($_POST['s_go']) and empty($error) ) {
  
  
 

 $catre_email="office@anadeea.ro";
 

 	$sent_nr=0;
 
 $subject = "E-vo: cerere oferta ";
 $message .=  "Nume: ".$nume."<br>";
 $message .=  "Telefon: ".$telefon."<br>";
 $message .=  "Email: ".$de_la."<br>";
 $message .=  "Localitate: ".$localitate."<br>";
 $message .="<br/><br/>".  $mesaj;	 

  $message = '<html><head></head><body style=" background:none; background-color:#ffffff;">'.$message.'<br><br> <br><br> </body></html>';
 
  
   
  if(send_mail(strip_tags(trim($catre_email)), $subject, $message, $nume, $de_la))  
 			  {
				$gg='ok';
		 			
		 	$msg = 'Mail trimis.';
			} else {
	 		$msg = 'Mail netrimis.';
			}
				
	 
//////////////////////////////////////		
		
	 		
		
		 
		} else {
			#$_GET['msg'] = '<font color=red style="font-size: 9px;">Could not update now. Please try again later.</font>';
		}
		
 
}




}  


?>
<style media="screen">
.error { margin:0 auto; width:90%; padding:10px; padding-left:50px; margin-bottom:30px; text-align:left; background-color:#feebeb; border:2px solid #ffaeae; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#424040;}
.ok { margin:0 auto; width:90%; padding:10px; padding-left:50px; margin-bottom:30px; text-align:left; background-color:#ebfeeb; border:2px solid #000000; font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#424040;}

</style>


			 
            <? include "formular.php";?>