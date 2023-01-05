<?
include('settings/s_settings.php');
include('cart_fx.php');
$id_produs = $_GET[id_produs];
$prd = mysql_query_assoc("SELECT * FROM erad_produse
left join erad_um on erad_um.id_um=erad_produse.id_um
left join erad_brands on erad_brands.id_brand=erad_produse.id_brand

 WHERE id_produs = $id_produs  and erad_produse.activ=1");
$id_categorie_alte=$prd[0][id_categorie];
if($prd[0][activ]==0) echo js_redirect(SITE_URL);
 $id_brand=$prd[0][id_brand];

 if (count($prd)==0) header("Location: ".SITE_URL);

$added_on=mysql_query_assoc("select added_on from erad_produse where id_produs = '".$id_produs."'" );
$accesari=mysql_query_assoc("select accesari from erad_produse where id_produs = '".$id_produs."'" );
$acc=$accesari[0][accesari]+1;
 	mysql_query("update erad_produse set accesari='".$acc."' where id_produs = '".$id_produs."' ");


$cata = mysql_query_assoc("SELECT erad_categorii.*, erad_produse.* FROM erad_produse
LEFT JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie

WHERE id_produs = $id_produs");



$cat_cur = mysql_query_scalar("SELECT link FROM erad_categorii WHERE id_categorie = {$prd[0][id_categorie]}");

 $pic_p_c = mysql_query_assoc(" select * from erad_galerie where id_produs='".$prd[0][id_produs]."' order by prim desc");



$title=$prd[0][produs_cod];

$keywords=str_shape3($title);
$description= $prd[0][produs].' - '.DESCRIPTION_GENERAL ;

?>



<?
include "head_data.php"?>


<body>

<? include "header.php";?>

<div id="wrap">

<!------------------S-O-C-I-A-L------------------------>
<? include "social.php"; ?>
<!------------------S-O-C-I-A-L------------------------>

<div id="container" class="radius3">
<? include "nav_produs.php";?>

<div id="col_left">
	<? include "left_produse.php";?>
</div>

<div id="main">


	<div id="titlu_pricipal_pagina" >
		<a name="<?=$prd[0][produs]?>" title="<?=$prd[0][produs]?>" ><h2><?=$prd[0][produs]?></h2></a>
	</div>

	<? include "banner_aff_lista.php";?>


    <div id="centru">

 <? if(count($pic_p_c)>0) {?>

        <div id="articol_pic_container" >


		<div id="articol_poza" >




                               <? for ($j=0; $j<count($pic_p_c); $j++) {?>
									 <? if(is_file(PICS_DIR_MEDIU.$pic_p_c[$j][pic])) {
                                     ?>

                                            <a id="px<?=$pic_p_c[$j][id_pic]?>"    title="<? if($pic_p_c[$j][titlu]<>'') echo $pic_p_c[$j][titlu]; else echo $prd[0][produs_cod]; ?>" <? if($j>0)  echo 'style="display:none;"';?>>
                                            <img src="<?=PICS_URL_LARGE.$pic_p_c[$j][pic]?>"   border="0" style="width:100%;" alt="Poza <?=$prd[0][produs]?>" title="Poza <?=$j+1?> <? if($pic_p_c[$j][titlu]<>'') echo $pic_p_c[$j][titlu]; else echo $prd[0][produs_cod]; ?>"  />

											<br>

											<span class ="head_top_text" title="Galerie foto. <? if($pic_p_c[$j][titlu]<>'') echo $pic_p_c[$j][titlu]; else echo $prd[$j][produs]; ?>">
											<? if($pic_p_c[$j][titlu]<>'') echo $pic_p_c[$j][titlu];  ?>
											</span>
											</a>




                                    <? } ?>


                                <? }?>


		</div>



                                 <? if(count($pic_p_c)>1) {?>

                                 <div id="produs_galerie"  >

									<? for ($j=0; $j<count($pic_p_c); $j++) {?>
										 <? if(is_file(PICS_DIR_SMALL.$pic_p_c[$j][pic])) { ?>
                                                <a href="<?=PICS_URL_LARGE.$pic_p_c[$j][pic]?>" onMouseOver="hide_all();show_x('px<?=$pic_p_c[$j][id_pic]?>');" class="produs_galerie_thb" rel="lightbox[gal]" title="Poza <?=$j+1?> <? if($pic_p_c[$j][titlu]<>'') echo $pic_p_c[$j][titlu]; else echo $prd[0][produs_cod]; ?>" ><img src="<?=PICS_URL_MEDIU.$pic_p_c[$j][pic]?>" alt="<?=$it[$i][produs]?>" title="Poza <?=$j+1?> <? if($pic_p_c[$j][titlu]<>'') echo $pic_p_c[$j][titlu]; else echo $prd[0][produs_cod]; ?>"  border="0" height="45" /></a>
                                        <? } ?>
                                    <? }?>
                      	        </div>
								<? }?>


             </div>

<? }?>



	<div id="descriere_articol">
		<h3 class="sapou"><strong><?=nl2br($prd[0][descriere_scurta])?>
      <br>
      Pe scurt: <em><?=nl2br($prd[0][produs_cod])?> <?=show_date_ro($prd[0][data_aparitie])?></em></strong></h3>


      <? include "center_ad.php";?>

		<span class ="content_lung">
        <?=$prd[0][descriere]?>
		</span>
	</div> <!-- end descriere_articol -->



 <? $files=mysql_query_assoc("select * from erad_fisiere where id_produs='".$id_produs."'"); ?>

				<? if (count($files)>0) {?>



                 <div id="fisiere_atasate_titlu">



				<span class="fisiere_atasate_titlu">Fisiere atasate pentru <i><?=$prd[0][produs]?></i></span>
                    </div>

				<div id="fisiere_atasate">

						<?
						for($j=0; $j<count($files); $j++){?>


						<? if(is_file(FILE_DIR . $files[$j]['file'])) {?>

						<div class="fisier_atasat" >
						<a href="<?=FILE_URL?><?=$files[$j]['file']?>" class="fisiere_atasate_articol_link" target="_blank" title="Download <?=$files[$j]['file_desc']?>"><strong>&raquo; Download <? if(trim($files[$j]['file_desc'])<>'') echo $files[$j]['file_desc']; else echo $files[$j]['file'];?></strong></a>
						</div>


						<? }?>

						<? }?>

			</div>


			<? } ?>




<!--

		<div id="coordonate_produs" class="content">

	<? if($prd[0][denumire_brand]<>'') {?>

         <span class="content">
         Publicat de: <a href="<?=get_link_brand($prd[0][id_brand], $prd[0][denumire_brand],0)?>" class="link"  title="Vezi toate articolele scrise de <?=$prd[0][denumire_brand]?>"><?=$prd[0][denumire_brand]?></a>
		</span>
	<? }?>


		<br>

        <span class="content">

		Data publicarii: <?=show_date_ro(substr($prd[0][added_on],0,10))?>
		</span>


		<br>

		<span class="content"> Categoria:
		<? foreach ($nav as $n) if ($n[id_categorie]<>0){ ?>
		&raquo; <a href="<?=get_link_cat($n['id_categorie'], $n['link'],0)?>" class="content" title="<?=$n[link]?>" ><?=$n[link]?></a>

		<? }?>
		</span>

		<br>

        <span class="content">

		Titlul pe scurt: <?=nl2br($prd[0][produs_cod])?>
		</span>



    </div>




        <div class="facebook" >

		<div id="fb-root"></div><script src="https://connect.facebook.net/en_US/all.js#appId=137313333007242&amp;xfbml=1"></script>
		<fb:comments href="<?=curPageURL();?>" num_posts="2" width="495"></fb:comments>

		</div>
-->


	<? include "institutii_articol.php";?>
	<?  include "alte_produse_categorie.php";?>



<div id="to_anchor" class="content">
        <span class="content">
		Mergi la inceputul articolului: <br/>
        <a class="link orange" title="Mergi la inceputul articolului <?=$prd[0][produs]?>" href="#<?=$prd[0][produs]?>">
		<em><?=$prd[0][produs]?></em>
        </a>.
		</span>
</div>

</div> <!-- end centru -->

<div id="col_right">
	<? include "right.php";?>
</div>

<? include "banner_aff_bottom.php";?>

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
