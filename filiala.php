<?
include('settings/s_settings.php');
 
$r1=rand(0,9);
$r2=rand(0,9);

$rezultat=$_POST[rezultat];
$r1t=$_POST[r1t];
$r2t=$_POST[r2t];
$sumaR=$r1t+$r2t;

$id_filiala=$_GET[id_filiala];
$filiala=mysql_query_assoc("select * from erad_filiale where id_filiala='".$id_filiala."'");
$institutie_fil=mysql_query_assoc("select * from erad_tematici where id_tematica='".$filiala[0][id_institutie]."'");
$jud=mysql_query_scalar("select judet from erad_judete where id_judet='".$filiala[0][id_judet]."'");
$ors=mysql_query_scalar("select oras from erad_orase where id_oras='".$filiala[0][id_oras]."'");
if ($filiala[0][id_judet]<>'10') { $local1=' orasul '; $local2=' judetul '; }  else { $local1=' '; $local2=' '; }
$fili_cur=$filiala[0][denumire_filiala].', '.$local1.$ors.', '.$local2.$jud.'. Adresa, telefon, date de contact';
 
$title=strip_tags($filiala[0][denumire_filiala]); 
$keywords=str_shape3($filiala[0][denumire_filiala]); 
$description=strip_tags($fili_cur).DESCRIPTION_GENERAL;



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
		
		$subject =  " Date eronate pentru ".$filiala[0][denumire_filiala];
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
			echo js_redirect(SITE_URL.'filiala.php?id_filiala='.$id_filiala.'&gal=1&link=ok#formular');
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
	<? include "nav_subdomeniu.php";?>

<div id="col_left">
	<? include "left_filiale.php";?>
</div>
    

    
    <div id="main"  > 
    
	<div id="titlu_pricipal_pagina" >
		<a name="<?=$filiala[0][denumire_filiala]?>" title="<?=$fili_cur?>" ><h2 ><?=$fili_cur?></h2></a>
	</div>
    
 
  <div   id="centru"   >
  <? include "linkcentru_ad.php";?>
  
<div id="box_filiala">             
 
        
        <div id="detalii_institutie">
        	<div class="detalii_inst_item">
            <strong>Adresa:&nbsp;&nbsp;</strong><?=$filiala[0][adresa]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Judet:&nbsp;&nbsp;</strong><?=$jud?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Localiatte:&nbsp;&nbsp;</strong><?=$ors?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Telefon:&nbsp;&nbsp;</strong><?=$filiala[0][telefon]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Fax:&nbsp;&nbsp;</strong><?=$filiala[0][fax]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Email:&nbsp;&nbsp;</strong><?=$filiala[0][email]?>
            </div>
        </div>
	</div>
		<? if ($filiala[0][descriere_filiala]<>'') { ?>        
            <div id="descriere_inst">
            <div class="titlu_articol_lista">Despre <?=$filiala[0][denumire_filiala]?></div><br/>
            <?=nl2br($filiala[0][descriere_filiala])?>
            </div>
        <? } ?>    

	<? include "formular.php";?>
	<? include "center_ad.php";?>
  
	<div id="box_inst">
    <div class="titlu_secundar_pagina" style="margin-top:0px;">
    Sediul central <?=$institutie_fil[0][denumire_institutie]?>
    </div>
		<? if(is_file(PICS_DIR_MEDIU.$institutie_fil[0][logo_institutie])) {?>
            <div id="articol_pic_container" >
                <div id="articol_poza" style="height:auto;" >         
                <? if(is_file(PICS_DIR_MEDIU.$institutie_fil[0][logo_institutie])) { ?>
                <img src="<?=PICS_URL_SMALL.$institutie_fil[0][logo_institutie]?>" border="0" alt="Logo <?=$institutie_fil[0][denumire_institutie]?>" title="Logo <?=$institutie_fil[0][denumire_institutie]?>"  />		</a>
                <? } ?>	
                </div>
            </div>
		<? }?>
        
        <div id="detalii_institutie">
        	<div class="detalii_inst_item">
            <strong>Adresa:&nbsp;&nbsp;</strong><?=$institutie_fil[0][adresa]?>
            </div>
        	<div class="detalii_inst_item">
            <? $judet_inst=mysql_query_scalar("select judet from erad_judete where id_judet='".$institutie_fil[0][id_judet]."'");?>
            <strong>Judet:&nbsp;&nbsp;</strong><?=$judet_inst?>
            </div>
        	<div class="detalii_inst_item">
            <? $oras_inst=mysql_query_scalar("select oras from erad_orase where id_oras='".$institutie_fil[0][id_oras]."'");?>
            <strong>Localiatte:&nbsp;&nbsp;</strong><?=$oras_inst?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Telefon:&nbsp;&nbsp;</strong><?=$institutie_fil[0][telefon]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Fax:&nbsp;&nbsp;</strong><?=$institutie_fil[0][fax]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Email:&nbsp;&nbsp;</strong><?=$institutie_fil[0][email]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Cod SWIFT:&nbsp;&nbsp;</strong><?=$institutie_fil[0][swift]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>CUI:&nbsp;&nbsp;</strong><?=$institutie_fil[0][cui]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Registrul Comertului:&nbsp;&nbsp;</strong><?=$institutie_fil[0][reg_com]?>
            </div>
        	<div class="detalii_inst_item">
            <strong>Web:&nbsp;&nbsp;</strong><a class="blue" href="http:\\<?=$inst[0][www]?>" target="_blank" title="Site oficial <?=$institutie_fil[0][denumire_institutie]?>"><?=$institutie_fil[0][www]?></a>
            </div>
        </div>
	</div>

		<? if ($institutie_fil[0][descriere_inst]<>'') { ?>        
            <div id="descriere_inst">
            <div class="titlu_articol_lista">Despre <?=$institutie_fil[0][denumire_institutie]?></div><br/>
            <?=nl2br($institutie_fil[0][descriere_inst])?>
            </div>
        <? } ?>

<? include "articole_institutie.php";?>

<div id="to_anchor" class="content">
        <span class="content"> 
		Mergi la inceputul descrierii: <br/>
        <a class="link orange" title="Mergi la inceputul paginii <?=$inst[0][denumire_institutie]?>" href="#<?=$filiala[0][denumire_filiala]?>">
		<em><?=$filiala[0][denumire_filiala]?></em>
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
