 <? include "linkleft_ad.php";?>
 <? if ($id_inst<>'' and $id_judet=='0') { ?>
<div id="container_left">
    <div id="titlu_left">
    Prezenta in judetele:
    </div>
    
    <?
    $filiale_inst=mysql_query_assoc("
		select * from erad_filiale 
		where id_institutie='".$id_inst."'
		group by id_judet
		order by id_judet asc
		");
    for($i = 0; $i < count($filiale_inst); $i++) {
	$judete_inst=mysql_query_assoc("select * from erad_judete where id_judet='".$filiale_inst[$i][id_judet]."'")
    
    ?>
         
    <h3 class="left_cat_pp" >
        <span class="orange">&raquo;</span> 
        <a href="<?=get_link_filiale($id_inst, $inst_cur[0][denumire_institutie], $judete_inst[0][id_judet], 0)?>" title="<?=str_replace('&nbsp;','',$judete_inst[0]['judet'])?>"   class="left_cat_pp_text">
        <b><?=str_replace('&nbsp;','',$judete_inst[0]['judet'])?></b></a>
    </h3>
                     
    <? } ?>
</div>    
<? }  else if ($id_inst<>'' and $id_judet<>'0' and $id_oras=='' ) { ?> 	
<div id="container_left">
    <div id="titlu_left">
    <? if ($id_judet<>'10' ) echo 'Orase din'; else echo 'Sectoare din';  ?> <?=$jud_cur?>
    </div>
           
    <?
    $orase=mysql_query_assoc("
		select * from erad_orase 
		left join erad_filiale on erad_filiale.id_oras=erad_orase.id_oras
		where id_judet='".$id_judet."' and id_filiala<>'0' and id_institutie='".$id_inst."'
		group by erad_orase.id_oras
		order by oras asc
		");
	$it = $orase;
    for($i = 0; $i < count($it); $i++) {
    
    ?>
         
    <h3 class="left_cat_pp" >
        <span class="orange">&raquo;</span> 
        <a href="<?=get_link_filiale_oras($id_inst, $inst_cur[0][denumire_institutie],$it[$i]['id_oras'],$it[$i]['oras'],0)?>" title="<?=str_replace('&nbsp;','',$it[$i]['oras'])?>"   class="left_cat_pp_text">
        <b><?=str_replace('&nbsp;','',$it[$i]['oras'])?></b></a>
    </h3>
                     
    <? } ?>
 
</div>                   
<? }  else if ($id_inst<>'' and $id_oras<>'' ) { ?> 	
<div id="container_left">
    <div id="titlu_left">
    <? if ($id_judet<>'10' ) echo 'Orasul '; else echo 'Sectoarul ';  ?> <?=$ors_cur?>
    </div>
</div>
<? }  else if ($id_filiala<>''  ) { ?> 	
 
 
                     
    <? } ?>	

<? include "left_ad.php";?>
 
<? include('banner_left.php');?> 