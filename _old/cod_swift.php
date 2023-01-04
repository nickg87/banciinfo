<?
include('settings/s_settings.php');

$id_institutie=$_GET[id_cod];
$inst=mysql_query_assoc("select * from erad_tematici where id_tematica='".$id_institutie."'");
 
$title='cod swift '.strip_tags($inst[0][denumire_institutie]);
$keywords=str_shape3('cod swift '.$inst[0][denumire_institutie]); 
$description=strip_tags('Cod swift '.$inst[0][denumire_institutie]).DESCRIPTION_GENERAL;
$swift_cur='Codul SWIFT al bancii '.$inst[0][denumire_institutie];


if(isset($_POST['s_go'])){

$email=strip_tags(trim($_POST[email]));
$link=strip_tags(trim($_POST[link]));
$nume=strip_tags(trim($_POST[nume]));
$mesaj=strip_tags(trim($_POST[mesaj]));
$error = array();

if($email=='' or !chk_email($email)) $error[]='Nu ati introdus adresa de email! ';
if($nume=='') $error[]='Nu ati completat numele dvs! ';
if($mesaj=='') $error[]='Nu ati completat mesajul dvs! ';
 
$today = date("Y-m-d");
 
$key=$_SESSION['security_code'];
$number = $_REQUEST['number'];
	if($number!=$key){
	  $error[]= ' Codul de validare nu este valid! va rugam sa incercati din nou! ';
		  }
	if ($err==0) {
	   
		if(isset($_POST['s_go']) and empty($error) ) {
		
		$catre_email=PROFORMA_SENDER_EMAIL;
		
		$subject =  " Date eronate pentru ".$inst[0][denumire_institutie];
		$message .=  "Nume: ".$nume."<br>";
		$message .=  "Email: ".$email."<br>";
		$message .=  "Mesaj: <br>".$mesaj."<br>";
		$message .=  "Link: ".$link;
		
		$message = '<html><head></head><body style=" background:none; background-color:#ffffff;">'.$message. '</body></html>';
		
		if(send_mail($catre_email, $subject, $message, $nume, $email))
		$sent_nr++;
			
			if($sent_nr > 0) {
				$msg[] = 'Mail trimis.';
			} else {
				$msg[] = 'Mail netrimis.';
			}
			echo js_redirect(SITE_URL.'cod_swift.php?id_cod='.$id_institutie.'&link=ok#formular');
			} else {
			}
	}

}  


?>
<? include "head_data.php"?>

<body> 



<? include "header.php";?>

<div id="wrap">

<!------------------S-O-C-I-A-L------------------------>
<? include "social.php"; ?>
<!------------------S-O-C-I-A-L------------------------> 

<div id="container" class="radius3">
	<? include "nav_domeniu.php";?>

<div id="col_left">
	<? include "left_swift.php";?>
</div>

    
    <div id="main"  > 
    
	<div id="titlu_pricipal_pagina" >
		<a name="<?=$inst[0][denumire_institutie]?>" title="<?=$swift_cur?>" ><h2 ><?=$swift_cur?></h2></a>
	</div>

  <div   id="centru"   >
  
	<div id="box_inst">             
		<? if(is_file(PICS_DIR_MEDIU.$inst[0][logo_institutie])) {?>
            <div id="articol_pic_container" >
                <div id="articol_poza" style="height:auto;" >          
                <? if(is_file(PICS_DIR_MEDIU.$inst[0][logo_institutie])) { ?>
                <img src="<?=PICS_URL_SMALL.$inst[0][logo_institutie]?>" border="0" alt="Logo <?=$inst[0][denumire_institutie]?>" title="Logo <?=$inst[0][denumire_institutie]?>"  />		</a>
                <? } ?>	
                </div>
            </div>
		<div id="detalii_institutie">
        	<div class="swift_cod">
            <?=$inst[0][swift]?>
            </div>
        </div>

		<? }?>
        
         
	</div>
    
	<? include "formular.php";?>

	<? include "center_ad.php";?>

            <div>
            <div class="titlu_articol_lista">Despre <?=$inst[0][denumire_institutie]?></div> 
            <?=substr(strip_tags($inst[0][descriere_inst]),0,450)?>..
            <a class="blue" href="<?=get_link_inst($inst[0][id_tematica],$inst[0][denumire_institutie])?>" title="Mai multe detalii despre <?=$inst[0][denumire_institutie]?>">
            citeste mai mult
            </a>
            </div>
        

<div style="clear:both"></div>

<?  include "articole_institutie.php";?>

<div id="to_anchor" class="content">
        <span class="content"> 
		Mergi la inceputul descrierii: <br/>
        <a class="link orange" title="Mergi la inceputul paginii <?=$inst[0][denumire_institutie]?>" href="#<?=$inst[0][denumire_institutie]?>">
		<em><?=$inst[0][denumire_institutie]?></em>
        </a>.
		</span> 
</div>

</div> <!-- end centru -->
		
<div id="col_right">
	<? include "right.php";?>
</div>
 
 
       
    </div>

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
