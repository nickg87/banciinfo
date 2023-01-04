<? if($lista_articole==1) { ?>

	<div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_URL?>" class="nav_link blue">Home</a> 
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_meniu($menius[0][id_meniu], $menius[0]['link_meniu'])?>" title ="<?=$menius[0]['link_meniu']?>" class="nav_link blue"><?=$menius[0]['link_meniu']?></a>  
	</div>

<? } else { ?>

    <div id="nav">
        <a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
        <a href="<?=get_link_meniu($mnu[0][id_meniu], $mnu[0]['link_meniu'])?>" title="<?=$mnu[0]['link_meniu']?>" class="nav_link blue"><?=$mnu[0]['link_meniu']?></a>
        <span class="orange" ><strong>&raquo;</strong></span>
        <a href="#" title="<?=$page[0][titlu_stire]?>" class="nav_link blue"><?=$page[0][titlu_stire]?></a>  
    </div>	

<? } ?>