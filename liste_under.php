<div class="box_style_liste_under">
    <div class="stil_titlu_black">
    Principalele orase din:</span>
    </div>
    <div id="institutii_footer_container">
    <?
    $judeteF=mysql_query_assoc("
		select * from erad_judete 
		left join erad_orase on erad_judete.id_judet=erad_orase.id_parinte
		where principal=1
		group by id_judet
		order by judet asc");
    $iz=$judeteF;
    ?>
    <? for( $a=0; $a < count($iz); $a++) { ?>
    <a class="blue" href="<?=get_link_judet($iz[$a]['id_judet'], $iz[$a]['judet'],0)?>" title="Lista <?=SITE_DOMAIN?> din <?=$iz[$a][judet]?>"><strong><?=$iz[$a][judet]?>:</strong></a>
    <?
	$oraseF=mysql_query_assoc("
		select * from erad_orase 
		where principal=1 and id_parinte='".$iz[$a][id_judet]."'
		order by oras asc");
	$ix=$oraseF;
    ?>
    <? for( $o=0; $o < count($ix); $o++) { ?>
    <a title="Lista <?=SITE_DOMAIN?> din <?=$ix[$o][oras]?>" class="griInchis"  href="<?=get_link_oras($ix[$o]['id_oras'], $ix[$o]['oras'],0,0)?>"><?=$ix[$o][oras]?></a>
    <? if (($o+1)==count($ix)) {?> <? } else { ?> <span class="griInchis" > &nbsp;|&nbsp; </span>  <? } ?>  
    <? }  unset($ix); unset($o); unset($oraseF); ?>
    <? if (($a+1)==count($iz)) {?> <? } else { ?> <span class="blue">&nbsp&#9679;</span> <? } ?>
    
    <? } unset($iz); unset($a); unset($judeteF); ?>
    </div>
</div>

<div class="box_style_liste_under">
    <div class="stil_titlu_black">
    Link-uri utile:</span>
    </div>
    <div id="institutii_footer_container">
    <?
    $lista_links=mysql_query_assoc("select * from erad_links order by ord asc");
    $il=$lista_links;
    ?>
    <? for( $b=0; $b < count($il); $b++) { ?>
    <a class="blue" target="_blank" href="<?=$il[$b][link]?>" title="<?=$il[$b][denumire]?>"><?=$il[$b][denumire]?></a>
    &nbsp;|&nbsp;
    <? } unset($il); unset($b); unset($lista_links); ?>
    </div>
</div>

<div class="box_style_liste_under">
    <div class="stil_titlu_black">
    <span style="text-transform:capitalize"><?=SITE_DOMAIN?></span> inscrise in <span class="blue"><?=SITE_NAME?></span>
    </div>
    <div id="institutii_footer_container">
    <?
    $lista_instF=mysql_query_assoc("select * from erad_tematici where footer=1");
    $ik=$lista_instF;
    ?>
    <? for( $c=0; $c < count($ik); $c++) { ?>
    <a class="blue" href="<?=get_link_inst($ik[$c][id_tematica], $ik[$c][denumire_institutie])?>" title="Vezi detalii despre <?=$ik[$c][denumire_institutie]?>"><?=$ik[$c][denumire_institutie]?></a>
    &nbsp;|&nbsp;
    <? } ?>
    </div>
</div>
 