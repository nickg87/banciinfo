<div style="clear:both;" ></div>

<!--

				<div class="left_ad">

					google_ad_client  /* 336_280_text */

				</div>

-->
 
 <div class="left_categorii">
			 
		
	<? $categorii=mysql_query_assoc("select * from erad_categorii where lvl=1 order by ord");
         
    for($i = 0; $i < count($categorii); $i++) {
        $lbl=$categorii[$i][id_categorie];
        
    ?>
     
	<h3 class="left_cat_pp" ><a href="<?=get_link_cat($categorii[$i]['id_categorie'], $categorii[$i]['link'],0)?>" title="<?=str_replace('&nbsp;','',$categorii[$i]['link'])?>"   class="left_cat_pp_text"><b> <?=str_replace('&nbsp;','',$categorii[$i]['link'])?></b></a></h3>


<?  
			$catx=array();
			 $catx = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catx, $categorii[$i][id_categorie],0); ?>
			
			<?
			$nr=count($catx);
			 for($j = 0; $j < $nr; $j++) {
			 
			 $ps2= mysql_query_scalar("SELECT COUNT(*) FROM erad_produse WHERE  activ = '1' and id_categorie='".$catx[$j][id_categorie]."'");
			 ?> 
			 
				 
					
					<? if($ps2>0) {?> <h4 class="left_cat_sec" ><a href="<?=get_link_cat($catx[$j]['id_categorie'], str_replace('&nbsp;','',$catx[$j]['link']),0)?>" class="left_cat_sec_text" title="<?=str_replace('&nbsp;','',$catx[$j]['link'])?>"><?=str_replace('&nbsp;','',$catx[$j]['link'])?></a></h4>   
<? }?>
			
 			 	 
			 <? }?>
 
	<? }?>

 		
</div>



       <? include "left_brands.php";?>
       
       
<!--

				<div class="left_ad">

					google_ad_client  /* 336_280_text */

				</div>

-->
