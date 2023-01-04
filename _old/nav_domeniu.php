<? if ($id_judet<>'') { ?>  

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_judet($id_judet, $xj,0,0)?>" class="nav_link blue"><?=$jud_curent_link?></a>   
		</div>
        
<? } else if ($id_oras<>'') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
        <?
		$jx=mysql_query_scalar("select id_parinte from erad_orase where id_oras='".$id_oras."'");
		$jd=mysql_query_assoc("select id_judet, judet from erad_judete where id_judet='".$jx."'");
		?>
		<a href="<?=get_link_judet($jd[0][id_judet], $jd[0][judet],0,0)?>" class="nav_link blue">Lista <?=SITE_DOMAIN.'lor din '.$jd[0][judet]?></a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_oras($id_oras, $x,0,0)?>" class="nav_link blue"><?=$ors_curent_link?></a>  
		</div> 
        
<? } else if ($id_institutie<>'') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_inst($id_institutie, $inst[0][denumire_institutie])?>" class="nav_link blue"><?=$inst[0][denumire_institutie]?></a>   
		</div>
        
<? } else if ($swift=='1') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=SITE_URL?>coduri-swift-banci-romania.php" class="nav_link blue"><?=$dom_curent?></a>   
		</div>

<? } else { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=SITE_URL?>lista-banci-romania.php" class="nav_link blue"><?=$dom_curent?></a>   
		</div>

<? } ?>  

 