 <? 
 
 
$nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $prd[0][id_categorie],0);  

 ?>
 


        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>  
	 
		<? foreach ($nav as $n) if ($n[id_categorie]<>0){ ?>
		<span class="orange" ><strong>&raquo;</strong></span> <a title="Articole din categoria <?=$n['link']?>" href="<?=get_link_cat($n['id_categorie'], $n['link'],0)?>" class="nav_link"><?=$n[link]?></a>  

<? }?>
	<span class="orange" ><strong>&raquo;</strong></span> <a class="nav_link blue" title="<?=$prd[0][produs]?>" href="<?=$n[produs_cod]?>" ><?=$prd[0][produs_cod]?></a>   	 

		</div>
