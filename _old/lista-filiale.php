<?
include('settings/s_settings.php');


if (is_numeric($_GET[id])) $id_inst=$_GET[id];

if (is_numeric($_GET[id_judet])) $id_judet=$_GET[id_judet];

if (is_numeric($_GET[id_oras])) $id_oras=$_GET[id_oras];	 

if (is_numeric($_GET[page])) $page=$_GET[page];	 

 

$n_per_page = 10;

$inst_cur=mysql_query_assoc("SELECT * FROM erad_tematici WHERE id_tematica = '".$id_inst."'");
$x=$inst_cur[0][denumire_institutie];
$inst_curent='Lista '.SITE_SUBDOMAIN.'  '.$x;
$inst_curent_link='Lista '.SITE_SUBDOMAIN.'lor '.$x;

if ($id_judet<>'0') {
$jud_cur=mysql_query_scalar("SELECT judet FROM erad_judete WHERE id_judet = '".$id_judet."'");
$inst_curent='Lista '.SITE_SUBDOMAIN.'  '.$x.' din '.$jud_cur;
$inst_curent_link='Lista '.SITE_SUBDOMAIN.'lor '.$x.' din '.$jud_cur;
$local_cur=$id_judet;
}

if ($id_oras<>'') {
$ors_cur=mysql_query_scalar("SELECT oras FROM erad_orase WHERE id_oras = '".$id_oras."'");
$inst_curent='Lista '.SITE_SUBDOMAIN.'  '.$x.' din '.$ors_cur;
$inst_curent_link='Lista '.SITE_SUBDOMAIN.'lor '.$x.' din '.$ors_cur;
$local_cur=$id_oras;
}
 

if ($id_inst<>'' and $id_judet<>'') {

	$filiale = mysql_query_assoc("
	SELECT erad_filiale.*
	FROM erad_filiale
	WHERE erad_filiale.activ = '1' and id_institutie='".$id_inst."' and id_judet='".$id_judet."'
	ORDER BY id_filiala
	LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	$n_total = mysql_query_assoc("
	SELECT erad_filiale.*
	FROM erad_filiale
	WHERE erad_filiale.activ = '1' and id_institutie='".$id_inst."' and id_judet='".$id_judet."'
	");
 } 
 
if ($id_inst<>'' and $id_judet=='0') {

 
 	$filiale = mysql_query_assoc("
	SELECT erad_filiale.*
	FROM erad_filiale
	WHERE erad_filiale.activ = '1' and id_institutie='".$id_inst."'
	ORDER BY id_filiala
	LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
 	$n_total = mysql_query_assoc("
	SELECT erad_filiale.*
	FROM erad_filiale
	WHERE erad_filiale.activ = '1' and id_institutie='".$id_inst."'
	");
 
 }

if ($id_inst<>'' and $id_oras<>'') {

	$filiale = mysql_query_assoc("
	SELECT erad_filiale.*
	FROM erad_filiale
	WHERE erad_filiale.activ = '1' and id_institutie='".$id_inst."' and id_oras='".$id_oras."'
	ORDER BY id_filiala
	LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	$n_total = mysql_query_assoc("
	SELECT erad_filiale.*
	FROM erad_filiale
	WHERE erad_filiale.activ = '1' and id_institutie='".$id_inst."' and id_oras='".$id_oras."'
	");
	
 } 
 
$n_total= count($n_total);

?>


<? 
///google
$title=$inst_curent.'. Pagina '.($page+1);
$description= ' '.$inst_curent_link.' oferite de '.SITE_NAME ;
$keywords= str_shape3($inst_curent);
?>

<? include "head_data.php"?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
    
	<? include "nav_subdomeniu.php";?>

<div id="col_left">
	<?  include "left_filiale.php";?>
</div>
    
    <div id="main"  > 

		<div id="titlu_pricipal_pagina" >
			<a name="<?=$inst_curent?>" title="<?=$inst_curent_link?>" ><h2 > <?=$inst_curent_link?></h2></a>
		</div>   

	<? include "banner_aff_lista.php";?>
 
 
  <div   id="centru"   >
            <? include "linkcentru_ad.php";?>

<div class="box_domeniu_general"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
			<? if($inst_cur[0][logo_institutie]<>'') {?>
				<div class="pic_inst_container">
				<? if(is_file(PICS_DIR_MEDIU.$inst_cur[0][logo_institutie])) { ?>
                    <div class="pic_inst_lista"  >
                        <a href="<?=get_link_inst($inst_cur[0][id_tematica],$inst_cur[0][denumire_institutie])?>" >
                        <img src="<?=PICS_URL_SMALL.$inst_cur[0][logo_institutie]?>" alt="Foto <?=$inst_cur[0][denumire_institutie]?>" title="Detalii <?=$inst_cur[0][denumire_institutie]?>" border="0"   />
                        </a>
                    </div>		
                <? } ?>	
                </div>
			<? }?> 
            
			<div class="titlu_articol_lista">
	        <a href="<?=get_link_inst($inst_cur[0][id_tematica],$inst_cur[0][denumire_institutie])?>" title="Vezi detalii despre <?=strip_tags($inst_cur[0][denumire_institutie])?>">
				Sediul central <?=strip_tags($inst_cur[0][denumire_institutie])?>
			</a>
            </div>
            
            <div class="detalii_inst_lista">
            <?
            $judetx=mysql_query_scalar("select judet from erad_judete where id_judet='".$inst_cur[0][id_judet]."'");
            $orasx=mysql_query_scalar("select oras from erad_orase where id_oras='".$inst_cur[0][id_oras]."'");
			?>
            <?=$inst_cur[0][adresa].', '.$orasx.', judetul '.$judetx?>
            </div>
            
            
            <div class="detalii_inst_lista">
				<?
                $nr_filiale=mysql_query_scalar("select count(id_institutie) from erad_filiale where id_institutie='".$inst_cur[0][id_tematica]."'");
                $nr_orase=mysql_query_scalar("select count(distinct id_oras) from erad_filiale where id_institutie='".$inst_cur[0][id_tematica]."'");
                $nr_judete=mysql_query_scalar("select count(distinct id_judet) from erad_filiale where id_institutie='".$inst_cur[0][id_tematica]."'");
				$nr_articole=mysql_query_scalar("select count(id_produs) from erad_produse_tematici where id_tematica='".$inst_cur[0][id_tematica]."'");
                ?>
                <strong><?=$nr_filiale?><? if($nr_filiale==1) echo ' filiala'; else echo ' filiale';?></strong> in 
                <strong><?=$nr_orase?><? if($nr_orase==1) echo ' oras'; else echo ' orase';?></strong> din 
                <strong><?=$nr_judete?><? if($nr_judete==1) echo ' judet'; else echo ' judete';?></strong>
                <div style="margin-top:5px;">
                <strong class="blue"><?=$nr_articole?><? if($nr_articole==1) echo ' articol'; else echo ' articole';?></strong> in <strong class="blue"><?=SITE_NAME?></strong>
                </div>
            </div>


           </td>
           </tr>
           </table>
          
            </div>
		 	
<? if(count($filiale)>0){ $it=$filiale; ?>
 

 
<div id="container_filiale_lista">
<? for($i = 0; $i < count($it); $i++) { ?>

<div class="box_subdomeniu_general"  >

    <div class="titlu_articol_lista">
        <a href="<?=get_link_filiala($it[$i][id_filiala],$it[$i][denumire_filiala])?>" title="Vezi detalii despre <?=strip_tags($it[$i][denumire_filiala])?>">
            <?=strip_tags($it[$i][denumire_filiala])?>
        </a>
    </div>
    
    <div class="detalii_filiale_lista">
        <strong>Tel:&nbsp;</strong><?=$it[$i][telefon]?> | 
        <strong>Fax:&nbsp;</strong><?=$it[$i][fax]?> | 
        <strong>Email:&nbsp;</strong><span class="blue"><?=$it[$i][email]?></span>
    </div>
    
	<?
    $judet=mysql_query_scalar("select judet from erad_judete where id_judet='".$it[$i][id_judet]."'");
    $oras=mysql_query_scalar("select oras from erad_orase where id_oras='".$it[$i][id_oras]."'");
    ?>
    
    <div class="localizare_filiale_lista">
        <strong>Jud:&nbsp;</strong><span class="blue"><?=$judet?></span>
        <strong>Oras:&nbsp;</strong><span class="blue"><?=$oras?></span>
    </div>
    
    <div class="but_detalii_filiala">
    <a href="<?=get_link_filiala($it[$i][id_filiala],$it[$i][denumire_filiala])?>" class="buton_style1" style="float:none;">
    Vezi detalii</a>
    </div>

</div>

<? } ?>	

</div>


 <? if ($n_total >$n_per_page) {?>
 
<?
if ($id_inst<>'' and $id_judet=='0'  ) {
$link_pagina_inapoi=get_link_filiale($inst_cur[0][id_tematica], $inst_cur[0][denumire_institutie],0,($page-1));
$link_pagina_inainte=get_link_filiale($inst_cur[0][id_tematica], $inst_cur[0][denumire_institutie],0,($page+1));
}

if ($id_judet<>'0' and $id_oras=='' ) {
$link_pagina_inapoi=get_link_filiale($inst_cur[0][id_tematica], $inst_cur[0][denumire_institutie],$local_cur,($page-1));
$link_pagina_inainte=get_link_filiale($inst_cur[0][id_tematica], $inst_cur[0][denumire_institutie],$local_cur,($page+1));
}

if ($id_oras<>'') {    
$link_pagina_inapoi=get_link_filiale_oras($inst_cur[0][id_tematica],  $inst_cur[0][denumire_institutie], $local_cur, $ors_cur, ($page-1));
$link_pagina_inainte=get_link_filiale_oras($inst_cur[0][id_tematica],  $inst_cur[0][denumire_institutie], $local_cur, $ors_cur,  ($page+1));
}

?>

<div id="paginare" > 
   
  <? if($page-1>=0) {?> <a  href="<?=$link_pagina_inapoi?>" class="buton_style1">&laquo;&laquo; </a> <? }?>
   
<div style=" padding:4px; float:left;">   
Pagina 
 
  <select onChange="window.open(this.options[this.selectedIndex].value,'_self')" id="slcnt" class="input">
	
<? for($i = 1; $i <= ceil($n_total / $n_per_page); $i++) { ?>
<?
if ($id_inst<>'' and $id_judet=='0'  ) {
$link_pagina=get_link_filiale($inst_cur[0][id_tematica], $inst_cur[0][denumire_institutie],0,($i - 1));
}
if ($id_judet<>'0' and $id_oras=='' ) {
$link_pagina=get_link_filiale($inst_cur[0][id_tematica], $inst_cur[0][denumire_institutie],$local_cur,($i - 1));
}
if ($id_oras<>'') {  
$link_pagina=get_link_filiale_oras($inst_cur[0][id_tematica],  $inst_cur[0][denumire_institutie], $local_cur, $ors_cur, ($i - 1));
}
?>
<option value="<?=$link_pagina?>" <?=selected($i,$page+1 );?>>

         <?=($page + 1 == $i ? '<b>' : '')?><?=$i?><?=($page  == $i ? '</b>' : '')?>
</option>
         <? } ?>
	 </select> 
 din  <?=$i-1?>
 
 </div>
 
  <? if($page+1 < ceil($n_total / $n_per_page)) {?>   <a href="<?=$link_pagina_inainte?>" class="buton_style1">&raquo;&raquo; </a> <? }?>
  </div>

<? }?>

<div  class="lista_titlu" style="clear:both;">
 

        <p class="small_text"> 
		<br>
		Sunt afisate toate <?=SITE_SUBDOMAIN?>le din <?=$x?>. 
		Pentru detalii suplimentare si <?=SITE_SUBDOMAIN?> privind aceste <?=SITE_SUBDOMAIN?> 
		puteti sa navigati folosind meniul din stanga; Pentru alte informatii folositi datele din pagina de <a class="blue" href="<?=SITE_URL?>contact.php" title="Contact <?=SITE_NAME?>">Contact</a>. 
		</p></em>
        <div id="to_anchor" class="content">
        <span class="content"> 
		Mergi la inceputul listei <br/>
        <a class="link orange" title="Toate <?=SITE_DOMAIN?>le <?=$x?>" href="#<?=$inst_curent?>"><em><?=$inst_curent_link?></em>
        </a>.
		</span> 
		</div>
 
</div>
	

<? } else {?>	

<div style="float:left; width:100%;">
<br>
<strong>Nu exista articole care sa corespunda criteriilor de navigare alese.</strong>

<br>

Pentru criteriile de navigare pe care le-ati aplicat nu exista momentan articole in site-ul nostru.
<br><br>

Va rugam sa alegeti alte criterii de navigare astfel incat sa ajungeti la rezultatele dorite. 

<br><br>

Pentru optiuni avansate de navigare aveti la dispozitie optiunea <b>Cautare in site</b>.
<br>
<br>
<br>
</div>

<? }?>


 

<div  class="lista_titlu" style="clear:both;">
    
<? if (is_numeric($_GET[id])) { ?>

 <? } else { ?>

        <p class="small_text"> 
		<br>
		Sunt afisate toate <?=SITE_DOMAIN?>le din Romania. 
		Pentru detalii suplimentare si <?=SITE_SUBDOMAIN?> privind aceste <?=SITE_DOMAIN?> 
		puteti sa navigati folosind meniul din stanga; Pentru alte informatii folosind datele din pagina de <a class="blue" href="<?=SITE_URL?>contact.php" title="Contact <?=SITE_NAME?>">Contact</a>. 
		</p></em>
        <div id="to_anchor" class="content">
        <span class="content"> 
		Mergi la inceputul listei <br/>
        <a class="link orange" title="Toate articolele din <?=$cat_curenta_link?>" href="#<?=$dom_curent?>"><em><?=$dom_curent?></em>
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
	<? include "liste_under.php";?>
</div>

</div> <!-- end container -->
</div> <!-- end wrap -->

<div id="footer">
	<? include "foot.php";?>
</div>

</body>
</html>
