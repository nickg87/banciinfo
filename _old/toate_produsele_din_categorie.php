<?
$prdsc = mysql_query_assoc("
	SELECT erad_produse.id_produs, produs, produs_cod, erad_produse.pret, erad_produse.produs_cod, erad_produse.pret_oferta, erad_produse.descriere_scurta, erad_produse.id_categorie,oferta_speciala,produs_nou, erad_categorii.link, id_moneda FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE   activ = '1' and id_produs <> '".$id_produs."'  and erad_produse.id_categorie='".$id_categorie."'
	ORDER BY RAND()
	LIMIT 0,500
");

?>


<? 
$it = $prdsc;

if ( count($it)>1) {
?>


<div id="coordonate_produs" >

<div id="alte_produse_categorie_titlu">
Toate articolele din categoria <strong> <?=$n[link]?></strong>
 
 </div>       

        	<div id="prd" class="box_produse"  >

    
		<? for($i = 0; $i < count($it); $i++) { ?>




          
		<div   class="brand_name">

			<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod])?>"  class="foot_brands" title="<?=strip_tags($it[$i][produs])?>">  &raquo;  <?=strip_tags($it[$i][produs_cod])?></a>


		</div>



            
  <? if ($i%3<2) {?> <div class="spacer1"  > </div> <? }?>        	       
  	<? }?>      

            </div>

        
 </div>
 
 
 
 <? }?>