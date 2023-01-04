 <? include "linkleft_ad.php";?>
<div id="container_left">
<? if ($id_judet<>'') { ?> 
    <div id="titlu_left">
    <? if ($id_judet<>'10') echo 'Orase'; else echo 'Sectoare' ?> din <?=$x?>
    </div>
            
    <?
    $orase=mysql_query_assoc("
		select * from erad_orase 
		left join erad_filiale on erad_filiale.id_oras=erad_orase.id_oras
		where id_parinte='".$id_judet."' and id_filiala<>'0'
		group by erad_orase.id_oras
		order by oras asc
		");
	$it = $orase;
    for($i = 0; $i < count($it); $i++) {
    
    ?>
         
    <h3 class="left_cat_pp" >
        <span class="orange">&raquo;</span>  
        <a href="<?=get_link_oras($it[$i]['id_oras'], $it[$i]['oras'],0,0)?>" title="<?=str_replace('&nbsp;','',$it[$i]['oras'])?>"   class="left_cat_pp_text">
        <b><?=str_replace('&nbsp;','',$it[$i]['oras'])?></b></a>
    </h3>
                     
    <? } ?>
    
<? } else if ($id_oras<>'') { ?> 

    <div id="titlu_left">
    <? if ($id_oras<>'3479' && $id_oras<>'3480' && $id_oras<>'3481' && $id_oras<>'3482' && $id_oras<>'3483'  && $id_oras<>'3484' ) echo 'Orasul '?> <?=$x?>
    </div>
    <br/>

 
    
<? } else if ($id_institutie<>'') { ?> 

    <div id="titlu_left">
    Prezenta in judetele:
    </div>
    
    <?
    $filiale_inst=mysql_query_assoc("
		select * from erad_filiale 
		where id_institutie='".$id_institutie."'
		group by id_judet
		order by id_judet asc
		");
    for($i = 0; $i < count($filiale_inst); $i++) {
	$judet=mysql_query_assoc("select * from erad_judete where id_judet='".$filiale_inst[$i][id_judet]."'")
    
    ?>
         
    <h3 class="left_cat_pp" >
        <span class="orange">&raquo;</span>  
        <a href="<?=get_link_filiale($id_institutie, $inst[0][denumire_institutie],$filiale_inst[$i][id_judet],0)?>" title="<?=str_replace('&nbsp;','',$judet[0]['judet'])?>"   class="left_cat_pp_text">
        <b><?=str_replace('&nbsp;','',$judet[0]['judet'])?></b></a>
    </h3>
                     
    <? } ?>
    <div style=" margin:0px auto; margin-top:15px; margin-bottom:-5px; text-align:center;">
    <a title="Vezi toate <?=SITE_SUBDOMAIN?>le" href="<?=get_link_filiale($id_institutie, $inst[0][denumire_institutie], 0, 0)?>" class="buton_style1" style="float:none;">
    Vezi toate <?=SITE_SUBDOMAIN?>le</a>
    </div>
 
<? } else { ?> 	

    <div id="titlu_left">
    Judete
    </div>
            
    <?
    $judete=mysql_query_assoc("
	select * from erad_judete 
	left join erad_filiale on erad_filiale.id_judet=erad_judete.id_judet
	where id_institutie<>'0'
	group by erad_judete.id_judet
	order by judet asc
	");
	$it = $judete;
    for($i = 0; $i < count($it); $i++) {
    
    ?>
         
    <h3 class="left_cat_pp" >
        <span class="orange">&raquo;</span>  
        <a href="<?=get_link_judet($it[$i]['id_judet'], $it[$i]['judet'],0,0)?>" title="<?=str_replace('&nbsp;','',$it[$i]['judet'])?>"   class="left_cat_pp_text">
        <b><?=str_replace('&nbsp;','',$it[$i]['judet'])?></b></a>
    </h3>
    
    
     
                
                     
    <?  } ?>	

<? } ?>
</div>

<? include "left_ad.php";?>
 

<? include('banner_left.php');?>  
 
