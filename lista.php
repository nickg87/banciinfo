<?
include('settings/s_settings.php');

if (is_numeric($_GET[id])) $id_categorie=$_GET[id];	 
 
if($id_categorie==999999) $tip='oferta_speciala';


$page = $_GET[page];
$n_per_page = 10;

$x=mysql_query_assoc("SELECT * FROM erad_categorii WHERE id_categorie = '".$id_categorie."'  ");
$cat_curenta=$x[0][categorie];
$cat_curenta_link=$x[0][link];


////////////////////

 
 
$xtras='&id_categorie='.$_GET[id_categorie];
  $nex=implode('&', $q);

 
 
if (is_numeric($_GET[id])) {
	
	if ($id_categorie<>0) { 
 
 $catsub = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, $id_categorie,0); 
 $all[]='';
  for($j = 0; $j < count($catsub); $j++) 
   $all[]=$catsub[$j][id_categorie];
	 
 
 $p[] = " ( erad_produse.id_categorie = '".$id_categorie."'" .implode(' OR  erad_produse.id_categorie=', $all).' )' ;
 
 }



/////////////////////////////// filtre

if($_SESSION[cat_filtre]<>$id_categorie) {$_SESSION[cat_filtre]=$id_categorie;  unset ($_SESSION[filtre]);}

 // unset ($_SESSION[filtre]);
    
	if(isset($_GET[filtru])) $_SESSION[filtre][$_GET[filtru]]=$_GET[val];
	
	if(isset($_GET[filtru_del])) unset ($_SESSION[filtre][$_GET[filtru_del]]);
// $p[] = "  erad_produse.id_brand='".$_GET[id_brand]."'  " ; 
 
 
// echo "<pre>";  print_r ($_SESSION[filtre]); echo "</pre>"; // exit; 

foreach($_SESSION[filtre] as $filtre=>$val){
$nume_filtru=array();

if($filtre=='brand') $f[] = "  erad_produse.id_brand='".$val."'  " ;

if($filtre=='pret') { $preturi=explode('~',$val);
						
						if($preturi[1]>0) $f[] = "  IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)
  >='".$preturi[0]."' and IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)<='".$preturi[1]."' " ; 
							else $f[] = "  IF(erad_produse.pret_oferta != 0, erad_produse.pret_oferta, erad_produse.pret)>='".$preturi[0]."' " ; 
					}



if(is_numeric($filtre)) $f[] = "  erad_produse_valori.id_camp='".$filtre."'  and erad_produse_valori.	id_valoare='".$val."' " ;;

if($filtre=='tematica') $f[] = "  erad_produse_tematici.id_tematica='".$val."'  " ;
if($filtre=='produs_nou') $f[] = "  erad_produse.produs_nou='".$val."'  " ;
if($filtre=='oferte_speciale') $f[] = "  erad_produse.oferta_speciala='".$val."'  " ;
if($filtre=='stoc') $f[] = "  erad_produse.in_curand='".$val."'  " ;
if($filtre=='in_curand') $f[] = "  erad_produse.in_curand='".$val."'  " ;
}

if (count($f)>0)  $p[] = implode(' AND ', $f)  ;
//// end filtre

//echo implode(' AND ', $p);
	$lista = mysql_query_assoc("
		SELECT erad_produse.id_produs, produs, data_aparitie, produs_cod, erad_produse.pret,erad_produse.descriere_scurta, erad_produse.pret_oferta, erad_produse.id_categorie,oferta_speciala,produs_nou, erad_categorii.link,id_moneda
		FROM erad_produse 
		LEFT JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	 left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
	left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
	
		WHERE (".implode(' AND ', $p).") AND erad_produse.activ = '1' 
		group by erad_produse.id_produs
		order by added_on desc
		LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	 $n_total = mysql_query_assoc("SELECT  erad_produse.id_produs  FROM erad_produse 
	 	LEFT JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
	 left join erad_produse_tematici on erad_produse_tematici.id_produs=erad_produse.id_produs 
 	 left join erad_produse_valori on erad_produse_valori.id_produs=erad_produse.id_produs 
	 left join erad_tematici on erad_tematici.id_tematica=erad_produse_tematici.id_tematica 
	 
	 WHERE (".implode(' AND ', $p).") AND erad_produse.activ = '1'
	 group by erad_produse.id_produs
	 
	 ");
 }
 
 
if ($tip<>'') {
	$lista = mysql_query_assoc("
		SELECT erad_produse.* FROM erad_produse 
		LEFT JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
 	
	
		WHERE  {$tip} = 1    AND erad_produse.activ = '1' 
		group by erad_produse.id_produs
		{$order}
		LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	   $n_total = mysql_query_assoc(" SELECT  erad_produse.id_produs  FROM erad_produse 
 	 WHERE {$tip} = 1    AND erad_produse.activ = '1' 
	 ");

 
if ($id_categorie==999999) $cat_curenta='Oferte speciale';
 
 }
 
  $n_total= count($n_total);
 
?>


<? 
///google
 
 
  
 
$title=$cat_curenta_link.'. Pagina '.($page+1);
$description= $cat_curenta.' - '.DESCRIPTION_GENERAL ;
$keywords=str_shape3($cat_curenta_link);

 
?>
<? include "head_data.php"?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
    
	<? include "nav_lista.php";?>

<div id="col_left">
	<? include "left_produse.php";?>
</div>
    

    
    <div id="main"  > 
    
    
	<? if ($id_categorie==999999) $cat_curenta='Oferte speciale';?>

		<div id="titlu_pricipal_pagina" >
			<a name="<?=$cat_curenta?>" title="<?=$cat_curenta?>" ><h2 > <?=$cat_curenta?> </h2></a>
		</div>       
        
	<? include "banner_aff_lista.php";?>
 
  <div   id="centru"   >
      <? include "linkcentru_ad.php";?>
 

<? if($n_total>0){ ?>			
	<? $it = $lista;
	for($i = 0; $i < count($it); $i++) 
	{ ?>
		

<div id="prd<?=$it[$i][id_produs]?>" class="box_articol_general"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
			<div class="titlu_articol_lista">
	        <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"   title="Citeste articolul <?=strip_tags($it[$i][produs])?>">
				<?=strip_tags($it[$i][produs])?>
			</a><span class="blue"><?=show_date_ro(substr($it[$i]['data_aparitie'],0,10))?></span>
            </div>


			<?  $pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");?> 
			<? if(count($pic)>0) {?>
				<div class="pic_container">
				<? if(is_file(PICS_DIR_THUMB.$pic[0][pic])) { ?>
                    <div class="pic_articol_lista"  >
                        <img src="<?=PICS_URL_SMALL.$pic[0][pic]?>" alt="Foto <?=$it[$i][produs]?>" title="Detalii <?=$it[$i][produs]?>" border="0"   />
                    </div>		
                <? } ?>	
                </div>
			<? }?> 


			<div class="articol_sapou_lista">
                <h3><?=strip_tags(substr($it[$i][descriere_scurta],0,250))?> [...]
                	<span class="blue" >citeste mai mult despre</span>
                    <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  class="link blue" title="<?=strip_tags($it[$i][produs])?>. Citeste acest articol">
                    <?=$it[$i][produs_cod]?>
                    </a> 
                </h3>
			</div>

            <div class="detalii_articol_lista">
            <?
			$categ=mysql_query_assoc("select * from erad_categorii where id_categorie='".$it[$i][id_categorie]."'")
			?>
                <a href="<?=get_link_cat($categ[0][id_categorie],$categ[0][link])?>" class="small_link_orange" title="Toate articolele din <?=$categ[0][link]?>"><?=$categ[0][link]?></a> 
                <em><span class="small_link_black"> | <?=$categ[0][categorie]?></span></em>
            </div>

             
           </td>
           </tr>
           </table>
          
            </div>
		 	

<? } ?>		

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



<? if ($n_total >$n_per_page) {?>

<div id="paginare" >
   
  <? if($page-1>=0) {?> <a href="<?=get_link_cat($id_categorie, $cat_curenta_link, ($page-1))?>" class="buton_style1">&laquo;&laquo; </a> <? }?>
   
<div style=" padding:4px; float:left;">   
Pagina 
 
  <select onChange="window.open(this.options[this.selectedIndex].value,'_self')" id="slcnt" class="input">
	
<? for($i = 1; $i <= ceil($n_total / $n_per_page); $i++) { ?>

<option value="<?=get_link_cat($id_categorie, $cat_curenta_link, ($i - 1))?>?<?=$nex?>" <?=selected($i,$page+1 );?>>

         <?=($page + 1 == $i ? '<b>' : '')?><?=$i?><?=($page  == $i ? '</b>' : '')?>
</option>
         <? } ?>
	 </select> 
 din  <?=$i-1?>
 
 </div>
 
  <? if($page+1 < ceil($n_total / $n_per_page)) {?>   <a href="<?=get_link_cat($id_categorie, $cat_curenta_link, ($page+1))?>" class="buton_style1">&raquo;&raquo; </a> <? }?>
  </div>

<? }?>

 
         
	</div><!-- end centru -->
        
    <div id="col_right">
        <? include "right.php";?>
    </div>


	<div  class="lista_titlu" style="clear:both;">

        <p class="small_text"> 
		<br>
		Sunt afisate toate articolele din <em><strong><?=$cat_curenta_link?></strong></em>. 
		Pentru detalii suplimentare privind articolele din <strong><?=$cat_curenta_link?> </strong> 
		puteti sa ne contactati, folosind datele din pagina de Contact. 
		Mergi la toate articolele din <em> <a class="small_link" title="Toate articolele din <?=$cat_curenta_link?>" href="#<?=$cat_curenta?>"><?=$cat_curenta?></a>.
		</p></em>

    </div>
     <? include "banner_aff_bottom.php";?>
	 
        
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
