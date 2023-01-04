<div id="titlu_pricipal_pagina">
<?=$description?>
</div>


<div id="centru">

<?  include "banner_main.php"?>

<?

$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");

$itm = mysql_query_assoc("
	SELECT * from 	  erad_home
	left join erad_categorii on erad_categorii.id_categorie=erad_home.id_item
	where activ=1
	order by erad_categorii.ord asc
  ");

if (count($itm)>0) {
foreach($itm as $items) {
?>

 <? 
  /////////categorie
 if($items['tip_item']==1) {?>
		 


<?
$cat_home=array();
$cat_home=mysql_query_assoc("select * from erad_categorii where id_categorie='".$items['id_item']."' order by ord");
if (count($cat_home)>0) {

	foreach ($cat_home as $ch) {
	 $catsub=array();
	 $catsub = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catsub, $ch[id_categorie],0); 
	 $all=array();
	  if (count($catsub)>0)	  {
		  for($j = 0; $j < count($catsub); $j++)        $all[]=' erad_produse.id_categorie='.$catsub[$j][id_categorie];
			 $p = " (erad_produse.id_categorie = ".$ch[id_categorie]." or " .implode(' OR ', $all). ')' ;
		} else  $p = " erad_produse.id_categorie = ".$ch[id_categorie]  ;
	 
	     $p ;
	 
		 //erad_produse.activ=1 and
		$prd=array();
		$prd = mysql_query_assoc("
			SELECT * FROM erad_produse 
			left join erad_categorii on erad_categorii.id_categorie=erad_produse.id_categorie
			 
			WHERE   activ = '1' and produs_nou = '1'   and  $p
			order by erad_produse.data_aparitie desc 
			 
			LIMIT 0,5
		");
		//ord_oferta asc
?>



<? 
$it = $prd;

if ( count($it)>=1) {
?>


 
		<div class="titlu_secundar_pagina" >
		
		<a href="<?=get_link_cat($ch[id_categorie],$ch[link])?>"  title="<?=$ch[categorie]?>" ><?=$ch[link]?></a>
		
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

     <? if ($i%4<3) {?> <div class="spacer1"  > </div> <? }?> 
  	<? }?>      

 

 
 <? }?>



<? } ?>

<? }  ?>
			
 <?  } //// end categorie  ?>





 


 

<? }?>



<? } else {?>


<!--

<?
//// produse la liber
$prd = mysql_query_assoc("
	SELECT * FROM erad_produse 
	left join erad_categorii on erad_categorii.id_categorie=erad_produse.id_categorie
	 

	WHERE   activ = '1' and erad_produse.oferta_speciala=1
	order by erad_produse.ord asc
	 
	LIMIT 0,20
");
//ord_oferta asc
?>


<? 
$it = $prd;

if ( count($it)>1) {
?>


 
<div class="bara_promo_home">   </div>       
    
<?
for($i = 0; $i < count($it); $i++) { ?>

 
        	<div id="prd<?=$it[$i][id_produs]?>" class="box_produse"  >

               
               	 <? if($it[$i][oferta_speciala]==1 and $it[$i][produs_nou]==0) {?>
                     <div class="bulina_oferta_small"   >
                                <a href="<?=get_link_produs($it[$i][id_produs_cod], $it[$i][produs], $it[$i]['link'])?>"   title="Oferta speciala" class="bulina_small_link" > </a>                    
                       </div>
                    <? }?>
                    
                    
                  <? if($it[$i][produs_nou]==1) {?>
                     <div class="bulina_nou_small"   >
                                <a href="<?=get_link_produs($it[$i][id_produs_cod], $it[$i][produs], $it[$i]['link'])?>"   title="Produs nou" class="bulina_small_link" > </a>                    
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
								$padding=round((144-$s[1])/2);
								
							?>
		
				
                	<div class="pic_produse"  >
 
 					
 
  						<a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  class="link_pic"  ><img src="<?=PICS_URL_THUMB.$pic[0][pic]?>" alt="Foto <?=$it[$i][produs]?>" title="Detalii oferta <?=$it[$i][produs]?>" border="0"  style="margin-top:<?=$padding?>px; "  /></a>
                    </div>		
 					 
                     	
		
					<? } ?>	
                </div>
           
            <? if($it[$i][in_promo]==1) {?>
                     <div class="bulina_promotie_small"   >
                                <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"   title="Produs in promotie" class="bulina_small_promotie_link" > </a>                    
                       </div>
             <? }?>
                
                    <div  class="  home_produse_pret"  >
                 
                <div  class="prd_info">
                    <a href="#" onMouseOver="show_x('cc<?=$it[$i][id_produs]?>');"    class="prd_info" ><img src="images/prd_info.png" border="0" /></a>
                    </div>
                    
                    <div id="cc<?=$it[$i][id_produs]?>" onMouseOut="hide_x('cc<?=$it[$i][id_produs]?>');" class="prd_info_bula" style=" display:none; "   >
                    <span class="small_text"><?=strip_tags($it[$i][descriere_scurta])?></span>
                    </div>
                 
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
                   <a href="<?=get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link'])?>"  class="home_produs_nume" title="<?=strip_tags($it[$i][produs])?>"><strong><?=strip_tags($it[$i][produs])?></strong></a> 
             </div>
            </div>
         	
     <? if ($i%4<3) {?> <div class="spacer1"  > </div> <? }?> 
  	<? }?>      
        
 

 
 <? }?>
 

-->                  


<? }?>

</div>

<div id="col_right">
	<? include "right.php";?>
</div>