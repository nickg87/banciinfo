<?
include('settings/s_settings.php');
$swift=1;



$x=mysql_query_assoc("SELECT * FROM erad_tematici   ");
$dom_curent='Coduri SWIFT '.SITE_DOMAIN.' Romania';
$dom_curent_link='Lista coduri SWIFT '.SITE_DOMAIN.'lor din Romania';

 

 
	$lista = mysql_query_assoc("
		SELECT erad_tematici.* FROM erad_tematici 
 	
	
		WHERE  erad_tematici.activ = '1' 
		ORDER BY erad_tematici.denumire_institutie asc
	");
	
 
?>


<? 
$title=$dom_curent;
$description=$dom_curent_link.' oferite de '.SITE_NAME ;
$keywords=str_shape3($dom_curent);
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
	<? include "left_ad.php";?>
</div>
    

    
    <div id="main"  > 

		<div id="titlu_pricipal_pagina" >
			<a name="<?=$dom_curent?>" title="<?=$dom_curent_link?>" ><h2 > <?=$dom_curent_link?> </h2></a>
		</div>


	<? include "banner_aff_lista.php";?>

  <div   id="centru"   >
 
	<? $it = $lista;
	for($i = 0; $i < count($it); $i++) 
	{ ?>
		

<div class="box_swift"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
            <?  $pic = mysql_query_assoc(" select id_tematica, logo_institutie, denumire_institutie from erad_tematici where id_tematica='".$it[$i][id_tematica]."'");?> 
			<? if(count($pic)>0) {?>
				<div class="pic_inst_container">
				<? if(is_file(PICS_DIR_MEDIU.$pic[0][logo_institutie])) { ?>
                    <div class="pic_inst_lista"  >
                        <a href="<?=get_link_inst($it[$i][id_tematica],$it[$i][denumire_institutie])?>"  >
                        <img src="<?=PICS_URL_SMALL.$pic[0][logo_institutie]?>" alt="Foto <?=$it[$i][denumire_institutie]?>" title="Detalii <?=$it[$i][denumire_institutie]?>" border="0"   />
                        </a>
                    </div>		
                <? } ?>	
                </div>
			<? }?> 
            
			<div class="titlu_articol_lista"> 
	        <a href="<?=get_link_swift($it[$i][id_tematica],$it[$i][denumire_institutie])?>"   title="Cod SWIFT <?=strip_tags($it[$i][denumire_institutie])?>">
				Cod SWIFT <?=strip_tags($it[$i][denumire_institutie])?>
			</a>
            </div>
 
            
            <div class="swift_cod">
			<?=$it[$i][swift]?>
            </div>


           </td>
           </tr>
           </table>
          
            </div>
		 	
 <? /* if ($i%2<1) {?> <div class="spacer_inst"  > </div> <? } */?> 
<? } ?>		

<div  class="lista_titlu" style="clear:both;">
    
<? if (is_numeric($_GET[id])) { ?>

 <? } else { ?>

        <p class="small_text"> 
		<br>
		Sunt afisate toate codurile <?=SITE_DOMAIN?>lor din Romania. 
		Pentru detalii suplimentare si <?=SITE_SUBDOMAIN?> privind aceste <?=SITE_DOMAIN?> 
		puteti sa navigati folosind meniul din stanga; Pentru alte informatii folosind datele din pagina de <a class="blue" href="<?=SITE_URL?>contact.php" title="Contact <?=SITE_NAME?>">Contact</a>. 
		</p></em>
        <div id="to_anchor" class="content">
        <span class="content"> 
		Mergi la inceputul listei <br/>
        <a class="link orange" title="Mergi la <?=$cat_curenta_link?>" href="#<?=$dom_curent?>"><em><?=$dom_curent?></em>
        </a>.
		</span> 
		</div>

 <? }?>
    </div>
 
         
	</div><!-- end centru -->
        
    <div id="col_right">
        <? include "right.php";?>
    </div>


	

	 
        
        </div><!-- end main -->
        
<div id="liste_under">
	<?  include "liste_under.php";?>
</div>

</div> <!-- end container -->
</div> <!-- end wrap -->

<div id="footer">
	<? include "foot.php";?>
</div>

</body>
</html>
