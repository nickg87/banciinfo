<!--[if lte IE 6]>
<div style="width:100%; height:50px; padding-top:10px; " class="ok">
<strong>Info!</strong> 
<br />
Motivul pentru care acest site este afisat putin ciudat, este pentru ca folositi Internet Explorer 6, care a fost lansat in 2005 si nu mai este de actualitate de ceva vreme.
<br />

Va invitam sa va upgradati browserul pentru a va bucura de noile facilitati ale tehnologiei web si de a spori securitatea sistemului dumneavoastra.

<br />
<strong>Internet Explorer 8 </strong>se poate downloada gratuit, de pe site-ul <strong>Microsoft</strong> de aici: <a href="https://www.microsoft.com/nz/windows/internet-explorer/default.aspx" target="_blank"> <strong>https://www.microsoft.com/nz/windows/internet-explorer/default.aspx</strong> </a>
</div>
<![endif]-->
<?
$nrfirme= mysql_query_scalar ("select count(id_tematica) from erad_tematici where activ=1");
$nrarticole= mysql_query_scalar ("select count(id_produs) from erad_produse where activ=1");
?>

<? #include "special_all.php";?>

<div id="header_container">

	    <div id="h1">
	        <h1 class="h1_top" ><?=$title?></h1>
    	</div>

<div id="wrap_header" class="radius3 gradient_h">

<div style=" position:absolute; float:right; margin-left:800px; margin-top:112px; ">
<table>
<tr>
<td>
<div class="fb-like" data-href="https://www.facebook.com/BanciInfo" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
</td>
<td>
<!-- Place this tag where you want the +1 button to render. -->
<div style="float:right; padding-top:4px;" class="g-plusone" data-size="medium" ></div>
</td>
</tr>
</table>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

 

        <div id="top">

			        <div id="logo">
                    <a href="<?=SITE_URL?>" title="<?=SITE_NAME?>">
                    	<img src="images/logo.png" alt="<?=SITE_NAME?>"  border="0" title="<?=SITE_NAME?>" /></a>
                    </div>

                    <div id="baner_top">
                        <?  include "banner_top.php"?>
                    </div>

        </div>

        <div id="meniu_top" class="radius3">

			<? $meniu=mysql_query_assoc("select * from erad_meniu_set where zona_meniu=1 and activ=1 order by ord");?>

		    <a href="<?=SITE_URL?>" class="head_meniu">Home</a>
            
            <a href="<?=get_link_domeniu(SITE_LIST_TITLE, 0)?>" class="head_meniu">Lista <?=SITE_DOMAIN?></a>
    
    <? foreach ($meniu as $mn) {
    $pag=mysql_query_assoc("select * from erad_pagini where id_meniu='".$mn[id_meniu]."'");
    ?>
    
    <? if(count($pag)>1) {?>

    <a href="<?=get_link_meniu($mn[id_meniu], $mn['link_meniu'])?>" class="head_meniu"><?=$mn['link_meniu']?></a>

    <? } else {?>

    <a href="<?=get_link_articol($pag[0][id_page], $pag[0][titlu_stire], $mn[id_meniu], $mn['link_meniu'])?>" class="head_meniu"><?=$mn['link_meniu']?></a>
    <? }?>

<? }?>


    <?php /*?><a href="<?=SITE_URL?>site_map.php" class="head_meniu">Site Map</a><?php */?>


    <a href="<?=SITE_URL?>newsletter.php" class="head_meniu">Newsletter</a>


    <?php /*?><a target="_blank" href="<?=SITE_URL?>rss.php" class="head_meniu">Flux RSS</a><?php */?>

	<a href="<?=SITE_URL?>coduri-swift-banci-romania.php" title="Vezi lista cu toate codurile SWIFT ale bancilor inscrise in site" class="head_meniu">Coduri SWIFT</a>
    <a href="<?=SITE_URL?>contact.php" class="head_meniu">Contact</a>


</div>
        
  <? include "submeniu_ad.php";?>
        
	    <div  id="cauta">

            <form action="<?=SITE_URL?>cauta.php" method="get">
            
            <div  id="search" class="radius3">
				<div class="text_cauta"> <strong>cauta</strong> ( <strong><?=$nrfirme?></strong> banci, <strong><?=$nrarticole?></strong> articole )</div>
				<div id="box_input">
                  <input  name="keyword" type="text" class="box_cauta" style="width:100%"  value=".."  onclick="if(this.value == '..') this.value = '';" onblur="if(this.value == '') this.value = '..';" />
                </div>  
            </div>
    
            <div  id="buton_search" class="radius3">
                    <input type="image" src="images/cauta.png" class="buton_cauta" title="Cauta in site"/>
                    <input type="hidden" name="s_cauta" value="1" /> 
            </div>
    
            </form>

    	</div>
<?php /*?>        
<div style="width:970px; height:90px; margin:0 auto; text-align:center; padding-bottom:10px;">
<?php /*?><a href='https://bit.ly/13L35YU' target='_blank' rel='nofollow'><img width="950" src='images/aff1.jpg' alt='FRFS' border="0" title='FRFS'  /></a><?php */?>
<?php /*?><a href='https://bit.ly/1a5txLI' target='_blank' rel='nofollow'>
<img src='images/aff1.jpg' alt='Bjr-Vacante.ro' title='Bjr-Vacante.ro' border='0' /></a>
<a href='https://event.2parale.ro/events/click?ad_type=banner&aff_code=304d17cda&campaign_unique=4ed5c9d68&unique=6adbc60a4' target='_blank' rel='nofollow'><img align="absmiddle"  src='https://img.2parale.ro/system/paperclip/banner_pictures/pics/140615/original/140615.jpg' alt='Card Avantaj' title='Card Avantaj' border='0' /></a>
</div>     
<?php */?>
   <? #include "popup.php";?>

</div> <!-- end heder wrap_header -->

</div> <!-- end heder container -->

