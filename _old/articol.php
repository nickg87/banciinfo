<?
include('settings/s_settings.php');

$id_page=$_GET[id_page];
$page=mysql_query_assoc("select * from erad_pagini where id_page='".$id_page."'");
$id_meniu=$_GET[id_meniu];
$mnu=mysql_query_assoc("select * from erad_meniu_set where id_meniu='".$id_meniu."'");

$pagini = mysql_query_assoc("	SELECT * FROM erad_pagini   where id_meniu='".$id_meniu."'  ORDER BY  erad_pagini.ord asc");
$menius=mysql_query_assoc("select * from erad_meniu_set where id_meniu='".$id_meniu."' ");




$title=strip_tags($page[0][titlu_stire]);
$keywords=str_shape3($page[0][titlu_stire]);
$description='Citeste '.$title;
?>
<? include "head_data.php"?>

<body>

<? include "header.php";?>

<div id="wrap">

<!------------------S-O-C-I-A-L------------------------>
<? include "social.php"; ?>
<!------------------S-O-C-I-A-L------------------------>

<div id="container" class="radius3">
	<? include "nav_articol.php";?>

<div id="col_left">
	<? include "left_ad.php";?>
    <? include "banner_left.php";?>
</div>



    <div id="main"  >

	<div id="titlu_pricipal_pagina" >
		<a name="<?=$page[0][titlu_stire]?>" title="<?=$page[0][titlu_stire]?>" ><h1 ><?=$page[0][titlu_stire]?></h1></a>
	</div>


  <div   id="centru"   >

                 <? $pic = mysql_query_assoc(" select * from erad_galerie_pagini where id_page='".$id_page."' order by prim desc"); ?>

            <? if(is_file(PICS_DIR_MEDIU.$pic[0][pic])) {?>

                <div id="articol_pic_container" >
                    <div id="articol_poza" >
                        <? if(is_file(PICS_DIR_MEDIU.$pic[0][pic])) { ?>
                            <a href="<?=PICS_URL_LARGE.$pic[0][pic]?>" rel="lightbox[gal]" title="<? if($pic[0][titlu]<>'') ?>">
                            <img src="<?=PICS_URL_MEDIU.$pic[0][pic]?>"   border="0" alt="<?=$pic[0][titlu]?>" title="<?=$pic[0][descriere]?>"  />		</a>
                        <? } ?>
                    </div>

                <? if(count($pic)>1) {?>
                <div id="art_pic_gal">
                    <? for ($j=1; $j<count($pic); $j++) {?>
                    <? if(is_file(PICS_DIR_THUMB.$pic[$j][pic])) { ?>
                        <a href="<?=PICS_URL_LARGE.$pic[$j][pic]?>" rel="lightbox[gal]" title="<? if($pic[$j][titlu]<>'') ?>">
                        <img src="<?=PICS_URL_THUMB.$pic[$j][pic]?>" alt="<?=$pic[$i][titlu]?>" title="<?=$pic[$i][descriere]?>" border="0" vspace="5" hspace="4" style=" padding:2px; border:solid 1px #c0c0c0; " width="50"  /></a>
                    <? } ?>
                    <? }?>
                </div>

                <? }?>

                </div>

			<? } else { ?><div id="articol_pic_container" ></div><? } ?>


		<div id="interactiune">
            <div class="facebook">
            <iframe src="https://www.facebook.com/plugins/like.php?href=<?=curPageURL();?>&amp;layout=standard&amp;show_faces=true&amp;width=350&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:30px;" allowTransparency="true"></iframe>
            </div>
        </div>



			<div id="descriere_produs" class="content">
				<h2 class="sapou"  ><?=nl2br($page[0][sapou])?></h2>

            <? include "center_ad.php";?>

			<div id="body_articol" class="content">
				<?=nl2br($page[0][body])?>

 <? $files=mysql_query_assoc("select * from erad_fisiere_pagini where id_page='".$id_page."'"); ?>
				<? if (count($files)>0) {?>
                <div id="coordonate_produs" class="content">
                        <div id="fisiere_atasate_titlu"  >
                                <span class="titlu_fisier_atasat_articol">Fisiere atasate pentru <i><?=$page[0][titlu_stire]?></i></span>
                        </div>
                        <div id="fisiere_atasate">
                                <?
                                for($j=0; $j<count($files); $j++){?>
                                <? if(is_file(FILE_DIR . $files[$j]['file'])) {?>
                                <div>
                                <a href="<?=FILE_URL?><?=$files[$j]['file']?>" class="fisiere_atasate_articol_link" target="_blank"  title="Download <?=$files[$j]['file_desc']?>">&raquo; Download <? if(trim($files[$j]['file_desc'])<>'') echo $files[$j]['file_desc']; else echo $files[$j]['file'];?></a>
                                </div>
                                <? }?>
                                <? }?>

                        </div>
                </div>
                <? }?>



                 </div>


		<div id="coordonate_produs" class="content">
		<span class="content">Pagina publicata in: <em><a href="<?=get_link_meniu($menius[0][id_meniu], $menius[0]['link_meniu'])?>" title ="Toate paginile din sectiunea <?=$menius[0]['link_meniu']?>" class="link"><?=$menius[0]['link_meniu']?></a></em>
		</span>
		</div>


		</div>



        <div id="to_anchor" class="content">
                <span class="content">
                Mergi la inceputul articolului: <br/>
                <a class="link orange" title="Mergi la inceputul paginii <?=$page[0][titlu_stire]?>" href="#<?=$page[0][titlu_stire]?>">
                <em><?=$page[0][titlu_stire]?></em>
                </a>.
                </span>
        </div>

</div>



<div id="col_right">
	<? include "right.php";?>
</div>



    </div>

<div id="liste_under">
	<? include "liste_under.php";?>
</div>

</div> <!-- end container -->
</div> <!-- end wrap -->

<div id="footer">
	<? include "foot.php";?>
</div>

</body>
</html>
