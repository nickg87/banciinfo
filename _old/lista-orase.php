<?
include('settings/s_settings.php');


if (is_numeric($_GET[id])) $id_oras=$_GET[id];	 

if (is_numeric($_GET[page])) $page=$_GET[page];	 

$n_per_page = 10;


$x=mysql_query_scalar("SELECT oras FROM erad_orase WHERE id_oras = '".$id_oras."'");
$xkk=mysql_query_scalar("SELECT id_parinte FROM erad_orase WHERE id_oras = '".$id_oras."'");
$kkj=mysql_query_scalar("SELECT judet FROM erad_judete WHERE id_judet = '".$xkk."'");
$ors_curent='Lista '.SITE_DOMAIN.'  '.$x;
if ($id_oras<>'3479' && $id_oras<>'3480' && $id_oras<>'3481' && $id_oras<>'3482' && $id_oras<>'3483'  && $id_oras<>'3484' ) $local='orasul ';
$ors_curent_link='Lista '.SITE_DOMAIN.'lor din '.$local.''.$x;





/////////////////// daca e pe general

if (is_numeric($_GET[id])) {

	$xx = mysql_query_assoc("
	SELECT erad_filiale . *
	FROM erad_filiale
	WHERE erad_filiale.activ = '1'
	AND id_oras ='".$id_oras."'
	GROUP BY id_institutie
	LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	$n_total = mysql_query_assoc("
	SELECT erad_filiale . *
	FROM erad_filiale
	WHERE erad_filiale.activ = '1'
	AND id_oras ='".$id_oras."'
	GROUP BY id_institutie
	");
 
 }
 
  $n_total= count($n_total);
 
?>


<? 
///google
 
 
  
 
$title=$ors_curent.'. Pagina '.($page+1);
$description=$ors_curent_link;
$keywords=str_shape3($ors_curent);

 
?>
<? include "head_data.php"?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
    
	<? include "nav_domeniu.php";?>

<div id="col_left">
	<? include "left_judete.php";?>
</div>
    

    
    <div id="main"  > 

		<div id="titlu_pricipal_pagina" >
        <? if ($jx<>'10') $jud_local='judetul '; ?>
			<a name="<?=$ors_curent?>" title="<?=$ors_curent_link?>" ><h2 > <?=$ors_curent_link?>, <?=$jud_local?> <?=$jd[0][judet]?></h2></a>
		</div>
        
	<? include "banner_aff_lista.php";?>    

 
  <div   id="centru"   >
            <? include "linkcentru_ad.php";?>

<? if(count($xx)>0){  ?>
 

<? for($i = 0; $i < count($xx); $i++) { ?>

<? $it =  mysql_query_assoc("
		SELECT erad_tematici.* FROM erad_tematici 
		WHERE  erad_tematici.activ = '1' and id_tematica='".$xx[$i][id_institutie]."'
		ORDER BY erad_tematici.denumire_institutie asc
	");  ?>
    


<div class="box_domeniu_general"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
            <?  $pic = mysql_query_assoc(" select id_tematica, logo_institutie, denumire_institutie from erad_tematici where id_tematica='".$it[0][id_tematica]."'");?> 
			<? if(count($pic)>0) {?>
				<div class="pic_inst_container">
				<? if(is_file(PICS_DIR_MEDIU.$pic[0][logo_institutie])) { ?>
                    <div class="pic_inst_lista"  >
                        <a href="<?=get_link_inst($it[0][id_tematica],$it[0][denumire_institutie])?>" >
                        <img src="<?=PICS_URL_SMALL.$pic[0][logo_institutie]?>" alt="Foto <?=$it[$i][denumire_institutie]?>" title="Detalii <?=$it[$i][denumire_institutie]?>" border="0"   />
                        </a>
                    </div>		
                <? } ?>	
                </div>
			<? }?> 
            
			<div class="titlu_articol_lista">
	        <a href="<?=get_link_inst($it[0][id_tematica],$it[0][denumire_institutie])?>" title="Vezi detalii despre <?=strip_tags($it[0][denumire_institutie])?>">
				<?=strip_tags($it[0][denumire_institutie])?>
			</a>
            </div>
            <div class="detalii_inst_lista">
            <?
            $judetx=mysql_query_scalar("select judet from erad_judete where id_judet='".$it[0][id_judet]."'");
            $orasx=mysql_query_scalar("select oras from erad_orase where id_oras='".$it[0][id_oras]."'");
			?>
            <?=$it[0][adresa].', '.$orasx.', judetul '.$judetx?>
            </div>
            
            <div class="detalii_inst_lista">
				<?
                $nr_filiale=mysql_query_scalar("select count(id_institutie) from erad_filiale where id_institutie='".$it[0][id_tematica]."'");
                $nr_orase=mysql_query_scalar("select count(distinct id_oras) from erad_filiale where id_institutie='".$it[0][id_tematica]."'");
                $nr_judete=mysql_query_scalar("select count(distinct id_judet) from erad_filiale where id_institutie='".$it[0][id_tematica]."'");
				$nr_articole=mysql_query_scalar("select count(id_produs) from erad_produse_tematici where id_tematica='".$it[0][id_tematica]."'");
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
		 	
 <? /* if ($i%2<1) {?> <div class="spacer_inst"  > </div> <? } */?> 
<? } ?>	

<? if ($n_total >$n_per_page) {?>

<div id="paginare" >
   
  <? if($page-1>=0) {?> <a href="<?=get_link_oras($id_oras, $x, 0, ($page-1))?>" class="buton_style1">&laquo;&laquo; </a> <? }?>
   
<div style=" padding:4px; float:left;">   
Pagina 
 
  <select onChange="window.open(this.options[this.selectedIndex].value,'_self')" id="slcnt" class="input">
	
<? for($i = 1; $i <= ceil($n_total / $n_per_page); $i++) { ?>

<option value="<?=get_link_oras($id_oras, $x, 0,($i - 1))?>" <?=selected($i,$page+1 );?>>

         <?=($page + 1 == $i ? '<b>' : '')?><?=$i?><?=($page  == $i ? '</b>' : '')?>
</option>
         <? } ?>
	 </select> 
 din  <?=$i-1?>
 
 </div>
 
  <? if($page+1 < ceil($n_total / $n_per_page)) {?>   <a href="<?=get_link_oras($id_oras, $x, 0,($page+1))?>" class="buton_style1">&raquo;&raquo; </a> <? }?>
  </div>

<? }?>


<div  class="lista_titlu" style="clear:both;">
 

        <p class="small_text"> 
		<br>
		Sunt afisate toate <?=SITE_DOMAIN?>le din <?=$x?>. 
		Pentru detalii suplimentare si <?=SITE_SUBDOMAIN?> privind aceste <?=SITE_DOMAIN?> 
		puteti sa navigati folosind meniul din stanga; Pentru alte informatii folositi datele din pagina de <a class="blue" href="<?=SITE_URL?>contact.php" title="Contact <?=SITE_NAME?>">Contact</a>. 
		</p></em>
        <div id="to_anchor" class="content">
        <span class="content"> 
		Mergi la inceputul listei <br/>
        <a class="link orange" title="Toate <?=SITE_DOMAIN?>le din orasul <?=$x?>" href="#<?=$ors_curent?>"><em><?=$ors_curent_link?></em>
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
        <a class="link orange" title="Vezi toate din <?=$cat_curenta_link?>" href="#<?=$dom_curent?>"><em><?=$dom_curent?></em>
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
