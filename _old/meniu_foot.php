<? 
$meniu1= array();
$meniu1=mysql_query_assoc("select * from erad_meniu_set where zona_meniu=1 and activ=1 order by ord");
$meniu2= array();
$meniu2=mysql_query_assoc("select * from erad_meniu_set where zona_meniu=2 and activ=1 order by ord");
 
?>

<div id="meniu_foot" > 

<? foreach ($meniu1 as $mn) {
$pag=array();
$pag=mysql_query_assoc("select * from erad_pagini where id_meniu='".$mn[id_meniu]."' ORDER BY ord asc");
?>

<? if(count($pag)>1) {?>
<a href="<?=get_link_meniu($mn[id_meniu], $mn['link_meniu'])?>" title="<?=$mn['link_meniu']?>" class="foot_link_text"><strong><?=$mn['link_meniu']?></strong></a>&nbsp;

<? for($i = 0; $i < count($pag); $i++) {?>


<a href="<?=get_link_articol($pag[$i][id_page], $pag[$i][titlu_stire], $mn[id_meniu], $mn['link_meniu'])?>" title="<?=$pag[$i][titlu_stire]?>" class="foot_link_text_sec"><?=$pag[$i][titlu_stire]?></a>&nbsp;

<? }?>

<br>

<? } else {?>
<a href="<?=get_link_articol($pag[0][id_page], $pag[0][titlu_stire], $mn[id_meniu], $mn['link_meniu'])?>" class="foot_link_text"><strong><?=$mn['link_meniu']?></strong></a>&nbsp;


<? }?>
<? }?>



<? foreach ($meniu2 as $mn) {
$pag=array();
$pag=mysql_query_assoc("select * from erad_pagini where id_meniu='".$mn[id_meniu]."' ORDER BY ord asc");
?>

<? if(count($pag)>1) {?>
<a href="<?=get_link_meniu($mn[id_meniu], $mn['link_meniu'])?>" title="<?=$mn['link_meniu']?>" class="foot_link_text"><strong><?=$mn['link_meniu']?></strong></a>

<? for($i = 0; $i < count($pag); $i++) {?>

<a href="<?=get_link_articol($pag[$i][id_page], $pag[$i][titlu_stire], $mn[id_meniu], $mn['link_meniu'])?>" title="<?=$pag[$i][titlu_stire]?>" class="foot_link_text_sec"><?=$pag[$i][titlu_stire]?></a>&nbsp;

<? }?>

<br>

<? } else {?>
<a href="<?=get_link_articol($pag[0][id_page], $pag[0][titlu_stire], $mn[id_meniu], $mn['link_meniu'])?>" class="foot_link_text"><strong><?=$mn['link_meniu']?></strong></a>


<? }?>
<? }?>



         
</div>