<?
$prdx1 = mysql_query_assoc("
	SELECT * FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE  activ = '1' and oferta_speciala='1' and erad_produse.id_categorie='".$id_categorie."'
	ORDER BY rand()
	LIMIT 0,6
");

$x=count($prdx1);
 $limita=6-$x;
$prdx2 = mysql_query_assoc("
	SELECT * FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE  activ = '1' and oferta_speciala='1' and erad_produse.id_categorie<>'".$id_categorie."'
	ORDER BY rand()
	LIMIT 0,{$limita}
");


foreach ($prdx1 as $c) $prdx[]=$c;
 foreach ($prdx2 as $c) $prdx[]=$c;

?>


<? 
$it = $prdx;

if ( count($it)>1) {
?>
<div class="bara_promo_home">   </div>   
 

<div class="pp_container"  >
        
    
<?
for($i = 0; $i < count($it); $i++) { ?>

        	<div class="pp_box"    >
                    <div class="pp_pic_container" >
                   
              	 	 
                     <? 
							$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");
							?> 
							<? if(is_file(PICS_DIR_SMALL.$pic[0][pic])) {
								 $s = getimagesize(PICS_DIR_SMALL . $pic[0]['pic']);
								$padding=round((94-$s[1])/2);
								
							?>
		
						 <div class="pp_thb">

                    <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs])?>" class="pp_piclink" title="<?=$it[$i][produs]?>" > </a>
                    </div>	
							<img src="<?=PICS_URL_SMALL.$pic[0][pic]?>" alt="<?=$it[$i][produs]?>" title="<?=$it[$i][produs]?>" border="0"  style="margin-top:<?=$padding?>px; "  />
					
                     	
		
					<? } ?>	
                  
                </div>
           
            
                
                    <div class="pp_pricetag"    >
     <? if($it[$i][pret_oferta]>0) {?>
                        <? if($it[$i][pret]>0) {?><span class="pret_taiat"   ><? if($it[$i][id_moneda]==0) echo $it[$i][pret]; else echo  fx($it[$i][pret]*curs_valoare($it[$i][id_moneda]));  ?>  lei&nbsp;</span> 
                        <br />
 
                        <? }?>
                        <span class="pret_normal" ><strong><? if($it[$i][id_moneda]==0) echo $it[$i][pret_oferta]; else echo  fx($it[$i][pret_oferta]*curs_valoare($it[$i][id_moneda]));  ?></strong> lei&nbsp;</span> 
        <? } else {?>
					<br />
	<? if($it[$i][pret]>0) {?><span class="pret_normal" ><strong><? if($it[$i][id_moneda]==0) echo $it[$i][pret]; else echo  fx($it[$i][pret]*curs_valoare($it[$i][id_moneda]));  ?></strong> lei&nbsp;</span><? }?>
             <? }?>
                 
                    </div>
           
           <div class="pp_nametag"    >
                     <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs])?>"  class="box_produse_nume_small" title="<?=$it[$i][produs]?>"><?=strip_tags(substr($it[$i][produs], 0, 30))?></a>
                    </div>
            </div>
           <? if ($i%6<5) {?> <div class="spacer4"  > </div> <? }?>	       
  	<? }?>      
        
 </div>
 
  
 
 <? }?>