<?
include('settings/s_settings.php');

$r1=rand(0,9);
$r2=rand(0,9);

$rezultat=$_POST[rezultat];
$r1t=$_POST[r1t];
$r2t=$_POST[r2t];
$sumaR=$r1t+$r2t;

$id_institutie=$_GET[id_inst];
$inst=mysql_query_assoc("select * from erad_tematici where id_tematica='".$id_institutie."'");
$jud=mysql_query_scalar("select judet from erad_judete where id_judet='".$inst[0][id_judet]."'");
$ors=mysql_query_scalar("select oras from erad_orase where id_oras='".$inst[0][id_oras]."'");
if ($inst[0][id_judet]<>'10') { $local1=' orasul '; $local2=' judetul '; }  else { $local1=' '; $local2=' '; }
$inst_cur=$inst[0][denumire_institutie].', '.$local1.$ors.', '.$local2.$jud.'. Adresa, telefon, date de contact';
 
$title=strip_tags($inst[0][denumire_institutie]); 
$keywords=str_shape3($inst[0][denumire_institutie]); 
$description=strip_tags($inst_cur).DESCRIPTION_GENERAL;

if(isset($_POST['s_go'])){

$email=strip_tags(trim($_POST[email]));
$link=strip_tags(trim($_POST[link]));
$nume=strip_tags(trim($_POST[nume]));
$mesaj=strip_tags(trim($_POST[mesaj]));
$error = array();

if($email=='' or !chk_email($email)) $error[]='Nu ati introdus adresa de email! ';
if($nume=='') $error[]='Nu ati completat numele dvs! ';
if($mesaj=='') $error[]='Nu ati completat mesajul dvs! ';
if($rezultat=='' or $sumaR<>$rezultat ) $error[]='Rezultatul adunarii dvs. este gresit! ';
 
$today = date("Y-m-d");
/* 
$key=$_SESSION['security_code'];
$number = $_REQUEST['number'];
	if($number!=$key){
	  $error[]= ' Codul de validare nu este valid! va rugam sa incercati din nou! ';
		  }
*/		  
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
			echo js_redirect(SITE_URL.'institutie.php?id_inst='.$id_institutie.'&gal=1&link=ok#formular');
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
	<? include "left_judete.php";?>
</div>

    
    <div id="main"  > 
    
	<div id="titlu_pricipal_pagina" >
		<a name="<?=$inst[0][denumire_institutie]?>" title="<?=$inst_cur?>" ><h2 ><?=$inst_cur?></h2></a>
	</div>
    
 
  <div   id="centru"   >
  <? include "linkcentru_ad.php";?>
  
	<div id="box_inst">             
		<? if(is_file(PICS_DIR_MEDIU.$inst[0][logo_institutie])) {?>
            <div id="articol_pic_container" >
                <div id="articol_poza" style="height:auto;" >          
                <? if(is_file(PICS_DIR_MEDIU.$inst[0][logo_institutie])) { ?>
                <img src="<?=PICS_URL_SMALL.$inst[0][logo_institutie]?>" border="0" alt="Logo <?=$inst[0][denumire_institutie]?>" title="Logo <?=$inst[0][denumire_institutie]?>"  />		</a>
                <? } ?>	
                </div>
            </div>
		<? }?>
        
        <div id="detalii_institutie">
        	<div class="detalii_inst_item">
            <strong>Adresa:&nbsp;&nbsp;</strong><?=$inst[0][adresa]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Judet:&nbsp;&nbsp;</strong><?=$jud?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Localiatte:&nbsp;&nbsp;</strong><?=$ors?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Telefon:&nbsp;&nbsp;</strong><?=$inst[0][telefon]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Fax:&nbsp;&nbsp;</strong><?=$inst[0][fax]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Email:&nbsp;&nbsp;</strong><?=$inst[0][email]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Cod SWIFT:&nbsp;&nbsp;</strong><?=$inst[0][swift]?>
            <a class="blue" href="<?=SITE_URL?>coduri-swift-banci-romania.php" title="Vezi lista cu toate codurile SWIFT ale bancilor inscrise in site">
            &nbsp;[ vezi toate codurile SWIFT ]
            </a>
            </div> 
        	<div class="detalii_inst_item">
            <strong>CUI:&nbsp;&nbsp;</strong><?=$inst[0][cui]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Registrul Comertului:&nbsp;&nbsp;</strong><?=$inst[0][reg_com]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Web:&nbsp;&nbsp;</strong><a class="blue" href="<?=$inst[0][www]?>" target="_blank" title="Site oficial <?=$inst[0][denumire_institutie]?>"><?=$inst[0][www]?></a>
            </div>
        </div>
	</div>
    
	<? include "formular.php";?>

	<? include "center_ad.php";?>

		<? if ($inst[0][descriere_inst]<>'') { ?>        
            <div id="descriere_inst">
            <div class="titlu_articol_lista">Despre <?=$inst[0][denumire_institutie]?></div><br/>
            <?=nl2br($inst[0][descriere_inst])?>
            </div>
        <? } ?>
        


<? include "articole_institutie.php";?>

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
