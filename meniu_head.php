<? 
$meniu1=mysql_query_assoc("select * from erad_meniu_set where zona_meniu=3 and activ=1 order by ord");
 
 
?>


 
     

<? foreach ($meniu1 as $mn) {
$pag=mysql_query_assoc("select * from erad_pagini where id_meniu='".$mn[id_meniu]."'");
?>

<? if(count($pag)>1) {?>
<span class ="head_meniu">&raquo; </span>  <a href="<?=get_link_meniu($mn[id_meniu], $mn['link_meniu'])?>" class="head_meniu" title="<?=$mn['link_meniu']?>"><?=$mn['link_meniu']?></a>
<? } else {?>
<span class ="head_meniu">&raquo; </span><a href="<?=get_link_articol($pag[0][id_page], $pag[0][titlu_stire], $mn[id_meniu], $mn['link_meniu'])?>" class="head_meniu" title="<?=$mn['link_meniu']?>"><?=$mn['link_meniu']?></a>
<? }?>
<? }?>



