<? if ($index==1) { ?>

<div id="titlu_dreapta" class="radius5Top">
Linkuri utile
</div>

<div class="border3blue"></div>
<div id="container_right">
	<div class="right_cat_pp">
    	<span class="orange">&raquo;</span>
        <a title="Lista <?=SITE_DOMAIN?>" href="<?=SITE_URL?>lista-banci-romania.php" class="right_cat_pp_text">
        Lista <?=SITE_DOMAIN?>
        </a>
    </div>
	<div class="right_cat_pp">
    	<span class="orange">&raquo;</span>
        <a title="Abonare newsletter <?=SITE_NAME?>" href="<?=SITE_URL?>newsletter.php" class="right_cat_pp_text">
        Abonare newsletter
        </a>
    </div>
	<div class="right_cat_pp">
    	<span class="orange">&raquo;</span>
        <a title="Contact <?=SITE_NAME?>" href="<?=SITE_URL?>contact.php" class="right_cat_pp_text">
        Contacteaza-ne
        </a>
    </div>
</div> 

<? } else { ?>

<div id="titlu_dreapta" class="radius5Top">
Linkuri rapide
</div>

<div class="border3blue"></div>
<div id="container_right">
	<div class="right_cat_pp">
    	<span class="orange">&raquo;</span>
        <a title="Lista <?=SITE_DOMAIN?>" href="<?=SITE_URL?>lista-banci-romania.php" class="right_cat_pp_text">
        Lista <?=SITE_DOMAIN?>
        </a>
    </div>
	<div class="right_cat_pp">
    	<span class="orange">&raquo;</span>
        <a title="Abonare newsletter <?=SITE_NAME?>" href="<?=SITE_URL?>newsletter.php" class="right_cat_pp_text">
        Abonare newsletter
        </a>
    </div>
	<div class="right_cat_pp">
    	<span class="orange">&raquo;</span>
        <a title="Contact <?=SITE_NAME?>" href="<?=SITE_URL?>contact.php" class="right_cat_pp_text">
        Contacteaza-ne
        </a>
    </div>
</div> 

<? } ?>

<? if ($id_institutie<>'' or $id_filiala<>'' ) { ?>
	<div style="float:right; width:100%; background-color:#efefef; text-align:center; padding:15px 0px;">
    <a  onClick="show_x('quick_f');"   class="buton_style1" style="float:none; width:80%; margin:0 auto;">
    Date eronate? Semnaleaza!</a>
    </div>
<? } ?>

<? if ($keyword<>''  ) { ?>
	<div style="float:right; width:100%; background-color:#efefef; text-align:center; padding:15px 0px;">
    <a href="<?=SITE_URL?>cautari.php" class="buton_style1" style="float:none; width:50%; margin:0 auto;">
    Cautari frecvente</a>
    </div>
<? } ?>

<? include('tw-follow-box-right.php');?>
<? include('fb-like-box-right.php');?>
<? // include('right_ad.php');?>
<? include('banner_right.php');?>