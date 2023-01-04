
<?
include('settings/s_settings.php');

$s = $_GET['s'];
$r1=rand(0,9);
$r2=rand(0,9);

$rezultat=$_POST[rezultat];
$r1t=$_POST[r1t];
$r2t=$_POST[r2t];
$sumaR=$r1t+$r2t;
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

if($mesaj=='') $error[]='Nu ati completat mesajul! ';
 
 $today = date("Y-m-d");
  
/* 
$key=$_SESSION['security_code'];
$number = $_REQUEST['number'];
  if($number!=$key){
	   
	  $error[]= ' Codul de validare nu este valid! va rugam sa incercati din nou! ';
		  }
 */
 if($rezultat=='' or $sumaR<>$rezultat ) $error[]='Rezultatul adunarii dvs. este gresit! ';
 
if (count($error)==0) {
 
   
 if(isset($_POST['s_go']) and empty($error) ) {
  
  
 

 $catre_email=PROFORMA_SENDER_EMAIL;
 

 	$sent_nr=0;
 
 $subject = "Mesaj nou de pe ".SITE_NAME;
 $message .=  "Nume: ".$nume."<br>";
 $message .=  "Email: ".$de_la."<br>";
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
  

$title=SITE_NAME. ". Contact";
$keywords=SITE_NAME. ". Contact";
$description=SITE_NAME. ". Contact";




include('head_data.php');
?>




<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
	<? include "nav_contact.php";?>
    
<div id="col_left">
	<? include "banner_left.php";?>
</div>

 
<div id="main">

  <div   id="centru"   >
 
    <div class="titlu_secundar_pagina" >
        <h1 >Contact <?=SITE_NAME?> </h1> 
    </div>            
            
 	<? include "formular_vechi.php";?>
 
</div>

        
    <div id="col_right">
        <? include "right.php";?>
    </div>


        </div><!-- end main -->
        
<div id="liste_under">
	<? include "liste_under.php";?>
</div>

</div> <!-- end container -->
</div> <!-- end wrap -->

<div id="footer">
	<? include "foot.php";?>
</div>

</body>
</html>
