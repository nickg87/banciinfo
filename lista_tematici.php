<?
include('settings/s_settings.php');

if (is_numeric($_GET[id])) $id_tematica=$_GET[id];	 
  

$page = $_GET[page];
$n_per_page = 10;

$x=mysql_query_assoc("SELECT * FROM erad_tematici WHERE id_tematica = '".$id_tematica."'  ");
$tematica_curenta=$x[0][denumire_institutie];

////////////////////
 
 
$xtras='&id_categorie='.$_GET[id_categorie];
  $nex=implode('&', $q);

//////////////////////////


if (is_numeric($_GET[id])) {
	$lista = mysql_query_assoc("
		SELECT  erad_produse.id_produs, produs, produs_cod, erad_produse.data_aparitie, erad_produse.descriere_scurta, erad_produse.id_categorie,oferta_speciala,produs_nou, id_moneda 
		  FROM erad_produse 
		INNER JOIN erad_produse_tematici ON erad_produse.id_produs = erad_produse_tematici.id_produs
		INNER JOIN erad_tematici ON erad_tematici.id_tematica = erad_produse_tematici.id_tematica
		WHERE erad_produse_tematici.id_tematica = '".$id_tematica."' AND erad_produse.activ = '1'
		order by erad_produse.data_aparitie desc
		LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	  $n_total = mysql_query_scalar("SELECT COUNT(*) FROM erad_produse 
		INNER JOIN erad_produse_tematici ON erad_produse.id_produs = erad_produse_tematici.id_produs
		INNER JOIN erad_tematici ON erad_tematici.id_tematica = erad_produse_tematici.id_tematica
		WHERE erad_produse_tematici.id_tematica = '".$id_tematica."' AND erad_produse.activ = '1'");
 }
 

?>


<? 
///google
 
 
 
$title='Articole, Stiri, '.$tematica_curenta.'. '.SITE_NAME. '. Pagina '.($page+1);
$description='Citeste toate articolele, stirile si noutatile legate de '.$tematica_curenta.' oferite de '.SITE_NAME ;
$keywords='Articole, Stiri, '.str_shape3($tematica_curenta).',  '.SITE_NAME ;

?>
<?  
include "head_data.php"?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
    
	<? include "nav_tematici.php";?>

<div id="col_left">
	<? include "left_ad.php";?>
	<? include "banner_left.php";?>
</div>
    

    
    <div id="main"  > 
 

		<div id="titlu_pricipal_pagina" >
			<a name="<?=$tematica_curenta?>" title="Articole despre <?=$tematica_curenta?>" ><h2 >Citeste ultimele articole si stiri referitoare la <?=$tematica_curenta?> </h2></a>
		</div>       

 
  <div   id="centru"   >
                              <? include "linkcentru_ad.php";?>
 
		
	<? 
$it = $lista;
for($i = 0; $i < count($it); $i++) { ?>
		
			
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
		
<? if ($n_total >$n_per_page) {?>

<div id="paginare"  class="head_top_text" >
 
   
  <? if($page-1>=0) {?> <a href="<?=get_link_tematica($n['id_tematica'], $n['denumire_institutie'],($page-1))?>" class="buton_style1">&laquo;&laquo; </a> <? }?>
   
<div style=" padding:4px; float:left;">   
Pagina 
 
  <select onChange="window.open(this.options[this.selectedIndex].value,'_self')" id="slcnt" class="input">
	
	<? for($i = 1; $i <= ceil($n_total / $n_per_page); $i++) { ?>

<option value="<?=get_link_tematica($n['id_tematica'], $n['denumire_institutie'],($i-1))?>?<?=$nex?>" <?=selected($i,$page+1 );?>>

         <?=($page + 1 == $i ? '<b>' : '')?><?=$i?><?=($page  == $i ? '</b>' : '')?>
</option>
         <? } ?>
	 </select> 
 din  <?=$i-1?>
 
 </div>
 <? if($page+1 < ceil($n_total / $n_per_page)) {?>   <a href="<?=get_link_tematica($n['id_tematica'], $n['denumire_institutie'],($page+1))?>" class="buton_style1">&raquo;&raquo; </a> <? }?>
  </div>

<? }?>




	</div><!-- end centru -->
        
    <div id="col_right">
        <? include "right.php";?>
    </div>


	<div  class="lista_titlu" style="clear:both;">

        <p class="small_text"> 
		<br>
		Sunt afisate toate articolele cu referire la <em><strong><?=$tematica_curenta?></strong></em>. 
		Pentru detalii suplimentare privind articolele din <strong><?=$tematica_curenta?> </strong> 
		puteti sa ne contactati, folosind datele din pagina de Contact. 
		</p></em>

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
