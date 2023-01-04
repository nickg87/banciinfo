<?  $tem =mysql_query_assoc("select * from erad_tematici order by ord limit 0,150"); ?>
<?  $brd =mysql_query_assoc("select * from erad_brands order by ord limit 0,150"); ?>


<? if (count($brd)>0) {?>

 <div class="left_brands">
  
  <div class="foot_brands_titlu">

	<span class="titlu_brands">Navigare in <?=SITE_NAME?> dupa lista de cuvinte cheie</strong></span>

  </div>
                      <? for($j = 0; $j < count($tem); $j++) {?>
                
				<div class="brand_name" >
				<h4 ><a href="<?=get_link_tematica($tem[$j][id_tematica], $tem[$j][denumire_tematica],0)?>" class="foot_brands"  title="<?=$tem[$j][denumire_tematica]?>">  &raquo;  <?=strip_tags($tem[$j][denumire_tematica])?> </a></h4>  
				</div>
 				<? }?>
                         
 </div>



 <div class="left_brands">
  
  <div class="foot_brands_titlu">

	<span class="titlu_brands">Lista de autori prezenti pe <?=SITE_NAME?></span>

  </div>
                      <? for($j = 0; $j < count($brd); $j++) {?>
                
                        <div class="brand_name" >
                        <h4 ><a href="<?=get_link_brand($brd[$j][id_brand], $brd[$j][denumire_brand],0)?>" class="foot_brands"  title="<?=$brd[$j][denumire_brand]?>">  &raquo;  <?=strip_tags($brd[$j][denumire_brand])?> </a></h4>  
         				 </div>
 				<? }?>
                         
 </div>




        <? }?>