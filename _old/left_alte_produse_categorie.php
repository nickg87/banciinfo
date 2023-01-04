<?
$prdsc = mysql_query_assoc("
	SELECT erad_produse.id_produs, produs, erad_produse.pret, produs_cod, erad_produse.pret_oferta, erad_produse.descriere_scurta, erad_produse.id_categorie,oferta_speciala,produs_nou, erad_categorii.link, id_moneda FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE   activ = '1' and id_produs <> '".$id_produs."'  and erad_produse.id_categorie='".$id_categorie."'
	ORDER BY id_produs desc
	LIMIT 0,10
");

?>


<? 
$it = $prdsc;

if ( count($it)>1) {
?>


<!--

				<div class="left_ad">

					google_ad_client  /* 336_280_text */

				</div>

-->

 <div class="left_categorii">


 <? 
 
 
$nav_left = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav_left, $prd[0][id_categorie],0);  

 ?>
 

  <div id="left_cat_pp"   class="left_cat_pp_text">


	 
<? foreach ($nav_left as $n) if ($n[id_categorie]<>0){ ?>




<? }?>

</div>
  



	<h3 class="left_cat_pp" ><a href="<?=get_link_cat($n['id_categorie'], $n['link'],0)?>" class="left_cat_pp_text" title="<?=$n[link]?>"><?=$n[link]?></a></h3>

 
 </div>       
    
<?
for($i = 0; $i < count($it); $i++) { ?>

        	<div id="prd" class="box_produse_left"  >



                 <table width="100%" border="0" cellspacing="0" cellpadding="0"    >
						<tr>
						  <td align="center"  valign="top">
            
              
                               </td>
           </tr>
           </table>
          
		<div   class="produs_alta_categorie_left">

			<h2><a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod])?>"  class="produs_nume_left" title="<?=strip_tags($it[$i][produs])?>"><?=strip_tags($it[$i][produs_cod])?></a></h2>


			<span class="content" style="margin-top:5px;"><?=strip_tags(substr($it[$i][descriere_scurta],0,90))?>
			<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs])?>"  class="content" title="Citeste tot articolul <?=strip_tags($it[$i][produs])?>"> [...]</a></span> 
		
		</div>



            </div>
            
  <? if ($i%3<2) {?> <div class="spacer1"  > </div> <? }?>        	       
  	<? }?>      


        	<div id="prd" class="box_produse_left"  >

        
	<span class="sapou" ><a href="<?=get_link_cat($n['id_categorie'], $n['link'],0)?>" class="left_tematici_text" title="<?=$cata[0][categorie]?>" > Vezi toate articolele din categoria <i> <?=$cata[0][categorie]?></i></a></h3>
 

	</div> 
 
 <? }?>
 
 
 
        <? include "left_brands.php";?>