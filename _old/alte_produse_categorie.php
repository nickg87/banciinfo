<?
$prdsc = mysql_query_assoc("
	SELECT erad_produse.id_produs, produs, produs_cod, data_aparitie , erad_produse.pret, erad_produse.pret_oferta, erad_produse.descriere_scurta, erad_produse.id_categorie,oferta_speciala,produs_nou, erad_categorii.link, id_moneda FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE   activ = '1' and id_produs <> '".$id_produs."'  and erad_produse.id_categorie='".$id_categorie_alte."'
	ORDER BY data_aparitie  desc
	LIMIT 0,5
");

?>


<? 
$it = $prdsc;

if ( count($it)>1) {
?>


<div id="alte_articole_categorie" >

<div class="titlu_secundar_pagina blue">
Daca ti-a placut articolul <b><i><a href="<?=$n[produs_cod]?>" title ="<?=$prd[0][produs_cod]?>"><?=$prd[0][produs_cod]?></a></b></i>, citeste si alte articole din subcategoria <strong> <?=$cata[0][categorie]?></strong>
</div>       
    
<?
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
            
  	<? }?>      
        
</div>
 
 
 
 <? }?>