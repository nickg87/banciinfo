<?
$institutii=mysql_query_assoc("
	select * from erad_produse_tematici
	left join erad_produse on erad_produse_tematici.id_produs=erad_produse.id_produs
	left join erad_tematici on erad_produse_tematici.id_tematica=erad_tematici.id_tematica
	where erad_produse.id_produs='".$id_produs."' and erad_tematici.activ=1
	order by denumire_institutie asc
	");
?>

<? if(count($institutii)<>''){ ?>
<div style="clear:both"></div>
<div class="titlu_secundar_pagina">
Lista <?=SITE_DOMAIN?> la care face referire articolul <i> <?=$prd[0][produs]?></i>
</div>
			
	<? $it = $institutii;
	for($i = 0; $i < count($it); $i++) 
	{ ?>

<div class="box_domeniu_general"  >

			<table width="100%" border="0" cellspacing="0" cellpadding="0"    >
			
			<tr>
			<td  valign="top">
            
            <?  $pic = mysql_query_assoc(" select id_tematica, logo_institutie, denumire_institutie from erad_tematici where id_tematica='".$it[$i][id_tematica]."'");?> 
			<? if(count($pic)>0) {?>
				<div class="pic_inst_container">
				<? if(is_file(PICS_DIR_MEDIU.$pic[0][logo_institutie])) { ?>
                    <div class="pic_inst_lista"  >
                        <a href="<?=get_link_inst($it[$i][id_tematica],$it[$i][denumire_institutie])?>"  >
                        <img src="<?=PICS_URL_SMALL.$pic[0][logo_institutie]?>" alt="Foto <?=$it[$i][denumire_institutie]?>" title="Detalii <?=$it[$i][denumire_institutie]?>" border="0"   />
                        </a>
                    </div>		
                <? } ?>	
                </div>
			<? }?> 
            
			<div class="titlu_articol_lista">
	        <a href="<?=get_link_inst($it[$i][id_tematica],$it[$i][denumire_institutie])?>"   title="Vezi detalii despre <?=strip_tags($it[$i][denumire_institutie])?>">
				<?=strip_tags($it[$i][denumire_institutie])?>
			</a>
            </div>
            
            <div class="detalii_inst_lista">
            <?
            $judetx=mysql_query_scalar("select judet from erad_judete where id_judet='".$it[$i][id_judet]."'");
            $orasx=mysql_query_scalar("select oras from erad_orase where id_oras='".$it[$i][id_oras]."'");
			?>
            <?=$it[$i][adresa].', '.$orasx.', judetul '.$judetx?>
            </div>
            
            
            <div class="detalii_inst_lista">
				<?
                $nr_filiale=mysql_query_scalar("select count(id_institutie) from erad_filiale where id_institutie='".$it[$i][id_tematica]."'");
                $nr_orase=mysql_query_scalar("select count(distinct id_oras) from erad_filiale where id_institutie='".$it[$i][id_tematica]."'");
                $nr_judete=mysql_query_scalar("select count(distinct id_judet) from erad_filiale where id_institutie='".$it[$i][id_tematica]."'");
				$nr_articole=mysql_query_scalar("select count(id_produs) from erad_produse_tematici where id_tematica='".$it[$i][id_tematica]."'");
                ?>
                <strong><?=$nr_filiale?><? if($nr_filiale==1) echo ' filiala'; else echo ' filiale';?></strong> in 
                <strong><?=$nr_orase?><? if($nr_orase==1) echo ' oras'; else echo ' orase';?></strong> din 
                <strong><?=$nr_judete?><? if($nr_judete==1) echo ' judet'; else echo ' judete';?></strong>
                <div style="margin-top:5px;">
                <strong class="blue"><?=$nr_articole?><? if($nr_articole==1) echo ' articol'; else echo ' articole';?></strong> despre <strong class="blue"><?=strip_tags($it[$i][denumire_institutie])?></strong>
                </div>
            </div>


           </td>
           </tr>
           </table>
          
            </div>

<? } } ?>