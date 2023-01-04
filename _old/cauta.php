<?
include('settings/s_settings.php');
 
$page = $_GET[page];
$n_per_page = 6;
$keyword=trim($_GET[keyword]);
 

if ($keyword<>'') $p[] = "erad_produse.produs LIKE '%".$keyword."%' or erad_produse.produs_cod LIKE '%".$keyword."%' or erad_produse.descriere_scurta LIKE '%".$keyword."%' or erad_produse.descriere LIKE '%".$keyword."%'";
if ($produs<>'') $p[] = "erad_produse.produs LIKE '%".$produs."%' ";
if ($id_categorie<>0) $p[] = "erad_produse.id_categorie = '".$id_categorie."' ";
 

 $p[] = "   erad_produse.id_produs>0  ";

  ////////////////////
 
if (isset($_GET['cheie']) and isset($_GET['directie'])) {
$ord[]=$_GET[cheie].' '.$_GET[directie];
$q[]='cheie='.$_GET[cheie].'&directie='.$_GET[directie];
}
else $ord[]=" erad_produse.id_produs desc";
  
$order= ' order by '. implode(' , ', $ord);
 
$xtras='&id_categorie='.$_GET[id_categorie];
  $nex=implode('&', $q);

//////////////////////////

 
	$produse = mysql_query_assoc("
		SELECT distinct(erad_produse.id_produs), erad_produse.id_produs, produs, produs_cod, erad_produse.pret,erad_produse.descriere_scurta, erad_produse.pret_oferta, erad_produse.id_categorie,oferta_speciala,produs_nou, erad_categorii.link,erad_categorii.categorie,id_moneda FROM erad_produse 
		left JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
		
		 
		WHERE (".implode(' AND ', $p)." )  and erad_produse.activ=1
		{$order}
		LIMIT ".($page * $n_per_page).", {$n_per_page}
	");
	
	  $n_total = mysql_query_scalar("SELECT COUNT(erad_produse.id_produs) 
	  FROM erad_produse 
		left JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
		
		 
		WHERE ( ".implode(' AND ', $p)."  )  and erad_produse.activ=1
	  ");
 
 
$accesari=mysql_query_assoc("select accesari from erad_keywords where keyword='".$keyword."'");
$acc=$accesari[0][accesari]+1;

 if(trim($keyword)<>'' and trim($keyword)<>'..') 
 
$key=mysql_query_assoc("select * from erad_keywords where keyword='".$keyword."'");

if ($n_total==0) {
	if (count($key)==0 and trim($keyword)<>'' and trim($keyword)<>'..' ) { mysql_query("insert into erad_keywords set keyword='".$keyword."', rezultate='0' "); }
	if (count($key)>0) { mysql_query("update erad_keywords set accesari='".$acc."', rezultate='0' where keyword='".$keyword."' "); }
  }


else if ($n_total>0) {
	if (count($key)==0 and trim($keyword)<>'' and trim($keyword)<>'..' ) { mysql_query("insert into erad_keywords set keyword='".$keyword."', rezultate='1' "); }
	mysql_query("update erad_keywords set accesari='".$acc."', rezultate='1' where keyword='".$keyword."' ");
 

}
 
 
$title='Cautare: '.$keyword;
$keywords=$keyword.', '.KEYWORDS_GENERAL;
$description=$keyword.'. Rezultatele cautarii. ';  
?>

<?  
include "head_data.php"?>


<body> 
	<? include "header.php"; ?>
<div id="wrap">
<div id="container"> 
 

    
	<? include "nav_cauta.php";?>

<div id="col_left">
	<? include "left_cauta.php";?>
    <? include "banner_left.php";?>
</div>
    

        
    <div id="main"  > 
    
      
        
       <h1 id="titlu_pricipal_pagina"> <i><?=$keyword?></i>. Rezultatele cautarii in <?=SITE_NAME?></h1> 
       
 <div   id="centru"   >   
            
     <? if (count($produse)>0) {?>       
       
               
        <br/>
        <br/>
        <div class="content_cont">
        <strong>Pentru rezultate cat mai relevante , incercati si noul modul de cautare prin Google <sup style=" background:#FF0000; padding:2px; color:#ffffff">beta</sup></strong>
        </div>
        <div id="google_search" >
        Loading...
        </div>
        <br/>
        <br/>

        <? 
        $it = $produse;
        for($i = 0; $i < count($it); $i++) { ?>

        <div id="prd<?=$it[$i][id_produs]?>" class="box_articol_general"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
			<div class="titlu_articol_lista">
	        <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"   title="Citeste articolul <?=strip_tags($it[$i][produs])?>">
				<?=strip_tags($it[$i][produs])?>
			</a><span class="blue"> <?=show_date_ro($it[$i][data_aparitie])?></span>
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

		<? if ($i==1) { ?>
         <? include "center_ad.php";?> 
		<? } ?>

        <? } ?>
      
<? if($n_total>$n_per_page) { ?>
     <div id="paginare"  class="head_top_text" >
 
   <? if($page-1>=0) {?> <a href="<?=SITE_URL?>cauta.php?page=<?=$page-1?>&keyword=<?=$keyword?>&<?=$nex?>" class="buton_style1">&laquo;&laquo; </a> <? }?>
<div style=" padding:4px; float:left;">   
  &nbsp; Pagina 
 
  
  <select onChange="window.open(this.options[this.selectedIndex].value,'_self')" id="slcnt" class="input">
	
	<? for($i = 1; $i <= ceil($n_total / $n_per_page); $i++) { ?>

<option value="<?=SITE_URL?>cauta.php?page=<?=$i - 1?>&keyword=<?=$keyword?>&<?=$nex?>" <?=selected($i,$page+1 );?>>

         <?=($page + 1 == $i ? '<b><font color=black>' : '')?><?=$i?><?=($page + 1 == $i ? '</font></b>' : '')?>
</option>
         <? } ?>
	 </select> 
din  <?=$i-1?>
</div>
  &nbsp;<? if($page+1 < ceil($n_total / $n_per_page)) {?>   <a href="<?=SITE_URL?>cauta.php?page=<?=$page+1?>&keyword=<?=$keyword?>&<?=$nex?>" class="buton_style1">&raquo;&raquo; </a> <? }?>
  
  </div> 
  <? } ?>             
             
  
  <? } else {?>       
  
<div style="width:100%;  float:left; " class="content_cont">
  

<br>
<br>
<strong>Pentru termenii cautati nu exista rezultate relevante in <?=SITE_NAME?>.</strong>

<br>
<br>

Pentru a gasi informatiile dorite va rugam sa efectuati o alta cautare. Verificati corectitudinea gramaticala a textului introdus in boxul de cautare.
<br>
<br>

In cazul in care nu gasiti informatii satisfacatoare, puteti consulta lista completa de articole mergand in sectiunea <a href ="<?=SITE_URL?>site_map.php"> Site Map</a>.
<br>
<br>

<?php /*?><form action="https://www.google.ro" id="cse-search-box">
  <div style=" width:75%; float:left;">
    <input type="hidden" name="cx" value="partner-pub-9350127359282666:5211972008" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="35"  />
   
  </div>
  <div style=" width:20%; float:right; margin-top:-4px;">
   <input type="submit" class="buton_style1" style="float:left;" name="sa" value="Search" />
   </div>
</form>

<script type="text/javascript" src="https://www.google.ro/coop/cse/brand?form=cse-search-box&amp;lang=ro"></script>

<script type="text/javascript" src="https://www.google.com/cse/query_renderer.js"></script>
<div id="queries"></div>
<script src="https://www.google.com/cse/api/partner-pub-9350127359282666/cse/5211972008/queries/js?oe=UTF-8&amp;callback=(new+PopularQueryRenderer(document.getElementById(%22queries%22))).render"></script>
<?php */?>

 


<br>
<br>
<div class="content_cont">
<strong>Incercati si noul modul de cautare prin Google pentru rezultate cat mai relevante <sup style=" background:#FF0000; padding:2px; color:#ffffff">beta</sup></strong>
</div>
<div id="google_search" >
Loading...
</div>

  

<br>
<br>

Sau puteti incerca lista urmatoare de sugestii de cautari:

<div id="lista_sugestii_cautari" class="radius2">
<?
$sugestii=mysql_query_assoc("select * from erad_keywords where activ = 1 order by accesari desc");
?>
<? for($i = 0; $i < count($sugestii); $i++) { ?>
<div class="titlu_articol_sugestii">
<a href="<?=SITE_URL?>cauta.php?keyword=<?=$sugestii[$i][keyword]?>" title="Cautari dupa <?=$sugestii[$i][keyword]?>">&bull;&nbsp;<?=$sugestii[$i][keyword]?></a>
</div>

<? } ?>
</div>

  </div>
  
  
  <? }?>
  


         
	</div><!-- end centru -->
        
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

