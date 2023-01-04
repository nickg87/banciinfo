<?
if ($id_filiala<>'') {
$referire1=$filiala[0][id_institutie];
$referire2=$institutie_fil[0][denumire_institutie];
} else if ($id_institutie<>'') {
$referire1=$inst[0][id_tematica];
$referire2=$inst[0][denumire_institutie];
}
?>
<?
$articole=mysql_query_assoc("
	select * from erad_produse
	left join erad_produse_tematici on erad_produse.id_produs=erad_produse_tematici.id_produs
	where id_tematica='".$referire1."' and activ=1
	order by data_aparitie desc
	LIMIT 1,5
	");
?>

<? if(count($articole)>'0'){ ?>
<div style="clear:both"></div>
<div class="titlu_secundar_pagina blue">
<em>Articole care fac referire la <?=$referire2?></em>
</div>
			
	<? $it = $articole;
	for($i = 0; $i < count($it); $i++) 
	{ ?>

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

<? } ?>
<div class="buton_style1">
<a href="<?=get_link_tematica($referire1, $referire2, 0)?>">Vezi toate articolele care fac referire la <?=$referire2?></a>
</div>
<div style="clear:both"></div>

<? } else { ?>

<div style="clear:both"></div>
<div class="titlu_secundar_pagina blue">
<em>Articole care fac referire la <?=$referire2?></em>
</div>
<div class="box_info">
In <strong><?=SITE_NAME?></strong> nu au fost publicate pana azi articole referitoare la <strong><?=$referire2?></strong>. Daca aveti un articol, 
o stire sau un comunicat de presa referitoare la firma/institutia mai sus amintita pe care doriti sa-l publicati pe site va rugam 
sa ne contactati folosind formularul din pagina de <a class="orange" href="<?=SITE_URL?>contact.php" title="Propune un articol">contact</a> .
</div>

<? } ?>