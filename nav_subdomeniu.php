<? if ($id_inst<>'' and $id_judet=='0') { ?>  

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=get_link_inst($inst_cur[0][id_tematica],$inst_cur[0][denumire_institutie])?>" title="<?=SITE_NAME?>" class="nav_link blue"><?=$inst_cur[0][denumire_institutie]?></a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_filiale($id_inst, $inst_cur[0][denumire_institutie], 0, 0)?>" class="nav_link blue">Lista <?=SITE_SUBDOMAIN?>lor <?=$inst_cur[0][denumire_institutie]?></a>   
		</div>
        
<? } else if ($id_inst<>'' and $id_judet<>'0' and $id_oras=='') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=get_link_inst($inst_cur[0][id_tematica],$inst_cur[0][denumire_institutie])?>" title="<?=SITE_NAME?>" class="nav_link blue"><?=$inst_cur[0][denumire_institutie]?></a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_filiale($id_inst, $inst_cur[0][denumire_institutie], $id_judet, 0)?>" class="nav_link blue">Lista <?=SITE_SUBDOMAIN?>lor <?=$inst_cur[0][denumire_institutie]?> din <?=$jud_cur?></a>   
		</div>
        
<? } else if ($id_inst<>'' and $id_oras<>'') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=get_link_inst($inst_cur[0][id_tematica],$inst_cur[0][denumire_institutie])?>" title="<?=SITE_NAME?>" class="nav_link blue"><?=$inst_cur[0][denumire_institutie]?></a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_filiale_oras($id_inst, $inst_cur[0][denumire_institutie], $id_oras, $ors_cur, 0)?>" class="nav_link blue">Lista <?=SITE_SUBDOMAIN?>lor <?=$inst_cur[0][denumire_institutie]?> din <?=$ors_cur?></a>   
		</div>
        
<? } else if ($id_institutie<>'') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_inst($id_institutie, $inst[0][denumire_institutie])?>" class="nav_link blue"><?=$inst[0][denumire_institutie]?></a>   
		</div>
        
<? } else if ($id_filiala<>'') { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
      	<a href="<?=SITE_URL?>lista-banci-romania.php" title="<?=SITE_NAME?>" class="nav_link blue">Lista <?=SITE_DOMAIN?>lor din Romania</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_filiale($institutie_fil[0][id_tematica], $institutie_fil[0][denumire_institutie], $filiala[0][id_judet], 0)?>" class="nav_link blue">Lista <?=SITE_SUBDOMAIN.'lor '.$institutie_fil[0][denumire_institutie]?> din <?=$jud?></a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=get_link_filiala($id_filiala, $filiala[0][denumire_filiala])?>" class="nav_link blue"><?=$filiala[0][denumire_filiala]?></a>  
		</div>

<? } else { ?> 

        <div id="nav">
		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=SITE_URL?>lista-banci-romania.php" class="nav_link blue"><?=$dom_curent?></a>   
		</div>

<? } ?>  

 