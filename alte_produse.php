<?
$prdx1 = mysql_query_assoc("
	SELECT * FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE  activ = '1' and oferta_speciala='1' and erad_produse.id_categorie='".$prd[0][id_categorie]."'
	ORDER BY ord_oferta
	LIMIT 0,6
");

$x=count($prdx1);
 $limita=6-$x;
$prdx2 = mysql_query_assoc("
	SELECT * FROM erad_produse 
	INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

	WHERE  activ = '1' and oferta_speciala='1' and erad_produse.id_categorie<>'".$prd[0][id_categorie]."'
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


<div id="alte_produse"    class="content">

<div id="alte_produse_titlu"  >
<br>
 <img src="images/alte_produse_titlu.png" alt="<?=$cata[0][link]?>" title="Ofertele noastre din <?=$cata[0][link]?>" />
  
 </div>       
    
<?
for($i = 0; $i < count($it); $i++) { ?>

        	<div id="prd" class="box_produse"  >
                <? if($it[$i][produs_nou]==1) {?>
                     <div class="bulina_nou_small"   >
                                <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs])?>"   title="<?=$it[$i][produs]?>" class="bulina_small_link" > </a>                    
                       </div>
                    <? }?>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0"    >
						<tr>
						  <td align="center"  valign="top">
            
                 
                    <div class="pic_container"  >
                   
              	 	 
                     <? 
							$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");
							?> 
							<? if(is_file(PICS_DIR_THUMB.$pic[0][pic])) {
								 $s = getimagesize(PICS_DIR_THUMB . $pic[0]['pic']);
								$padding=round((154-$s[1])/2);
								
							?>
		
				
                	<div class="pic_produse"  >
 
  						<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs])?>"  class="link_pic" title="<?=$it[$i][produs]?>" ><img src="<?=PICS_URL_THUMB.$pic[0][pic]?>" alt="<?=$it[$i][produs]?>" title="<?=$it[$i][produs]?>" border="0"  style="margin-top:<?=$padding?>px; "  /></a>
                    </div>		
 					 
                     	
		
					<? } ?>	
                </div>
           
          
                
                    <div  class="  home_produse_pret"  >
                 
                 <? if($it[$i][pret_oferta]>0) {?>
                        <? if($it[$i][pret]>0) {?><span class="pret_taiat" ><? if($it[$i][id_moneda]==0) echo $it[$i][pret]; else echo  fx($it[$i][pret]*curs_valoare($it[$i][id_moneda]));  ?> lei&nbsp;</span> 
                        <br />
 
                        <? }?>
                        <span class="pret_normal" ><strong><? if($it[$i][id_moneda]==0) echo $it[$i][pret_oferta]; else echo  fx($it[$i][pret_oferta]*curs_valoare($it[$i][id_moneda]));  ?></strong> lei&nbsp;</span> 
        <? } else {?>
       
        <? if($it[$i][pret]>0) {?>
   
        <strong><span class="pret_normal"><? if($it[$i][id_moneda]==0) echo $it[$i][pret]; else echo  fx($it[$i][pret]*curs_valoare($it[$i][id_moneda]));  ?> lei </span></strong> &nbsp;<? }?>
             <? }?>
                    </div>           </td>
           </tr>
           </table>
          
      <div   class="home_produs_nume">
                    <h2><a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs])?>"  class="home_produs_nume"><?=strip_tags($it[$i][produs])?></a></h2>
             </div>
            </div>
            
      	       
  	<? }?>      
        
 </div>
 
 
 
 <? }?>