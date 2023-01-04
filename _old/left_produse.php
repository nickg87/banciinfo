 <? include "linkleft_ad.php";?>

<?
$lvl=mysql_query_scalar("select lvl from erad_categorii where id_categorie='".$id_categorie."'  ");
if ($id_categorie<>'' and $lvl=='1' ) { ?>
<div id="container_left">

<div id="titlu_left">
Articole despre <?=SITE_DOMAIN?>
</div>

<?
$categorie=mysql_query_assoc("select * from erad_categorii where lvl=1 and id_categorie='".$id_categorie."' order by ord");
?>

<h3 class="left_cat_pp" >
	<span class="orange">&raquo;</span>
	<a href="<?=get_link_cat($categorie[0]['id_categorie'], $categorie[0]['link'],0)?>" title="<?=str_replace('&nbsp;','',$categorie[0]['link'])?>"   class="left_cat_pp_text">
    <b><?=str_replace('&nbsp;','',$categorie[0]['link'])?></b></a>
</h3>

<?
$catx=array();
$catx = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catx, $categorie[0][id_categorie],0);
$nr=count($catx);
	for($j = 0; $j < $nr; $j++) {
	$ps2= mysql_query_scalar("SELECT COUNT(*) FROM erad_produse WHERE  activ = '1' and id_categorie='".$catx[$j][id_categorie]."'");
?> 

<? if($ps2>0) { ?>
<h4 class="left_cat_sec" >
	<a href="<?=get_link_cat($catx[$j]['id_categorie'], str_replace('&nbsp;','',$catx[$j]['link']),0)?>" class="left_cat_sec_text" title="<?=str_replace('&nbsp;','',$catx[$j]['link'])?>">
	<?=str_replace('&nbsp;','',$catx[$j]['link'])?></a>
</h4>   
<? } ?>
			
<? } ?>
</div>
<? } else if ($id_categorie<>'' and $lvl<>'1') { ?>
<div id="container_left">

<div id="titlu_left">
Articole despre <?=SITE_DOMAIN?>
</div>

     
<h3 class="left_cat_pp" >
	<span class="orange">&laquo;</span>
    <? $categ_princ=mysql_query_assoc("select * from erad_categorii where id_categorie='".$x[0][id_parinte]."'"); ?>
	<a href="<?=get_link_cat($categ_princ[0]['id_categorie'], $categ_princ[0]['link'],0)?>" title="<?=str_replace('&nbsp;','',$categ_princ[0]['link'])?>"   class="left_cat_pp_text">
    <b>Inapoi la <?=$categ_princ[0]['link']?></b></a>
</h3>
</div>

<? include('left_ad.php');?>

<? } else if ($id_produs<>'' and $id_categorie=='') { ?>
<div id="container_left">

<div id="titlu_left">
Articole despre <?=SITE_DOMAIN?>
</div>

     
<h3 class="left_cat_pp" >
	<span class="orange">&laquo;</span>
    <? $categ_art=mysql_query_assoc("select * from erad_categorii where id_categorie='".$prd[0][id_categorie]."'"); ?>
	<a href="<?=get_link_cat($categ_art[0]['id_categorie'], $categ_art[0]['link'],0)?>" title="<?=str_replace('&nbsp;','',$categ_art[0]['link'])?>"   class="left_cat_pp_text">
    <b>Toate articolele din <?=$categ_art[0]['link']?></b></a>
</h3>
</div>

<? include('left_ad.php');?>

<? } else { ?>
<div id="container_left">

<div id="titlu_left">
Articole despre <?=SITE_DOMAIN?>
</div>

<?
$categorii=mysql_query_assoc("select * from erad_categorii where lvl=1 order by ord");
for($i = 0; $i < count($categorii); $i++) {
$lbl=$categorii[$i][id_categorie];
?>
     
<h3 class="left_cat_pp" >
	<span class="orange">&raquo;</span>
	<a href="<?=get_link_cat($categorii[$i]['id_categorie'], $categorii[$i]['link'],0)?>" title="<?=str_replace('&nbsp;','',$categorii[$i]['link'])?>"   class="left_cat_pp_text">
    <b><?=str_replace('&nbsp;','',$categorii[$i]['link'])?></b></a>
</h3>


<?
$catx=array();
$catx = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $catx, $categorii[$i][id_categorie],0);
$nr=count($catx);
	for($j = 0; $j < $nr; $j++) {
	$ps2= mysql_query_scalar("SELECT COUNT(*) FROM erad_produse WHERE  activ = '1' and id_categorie='".$catx[$j][id_categorie]."'");
?> 

<? if($ps2>0) { ?>
<h4 class="left_cat_sec" >
	<a href="<?=get_link_cat($catx[$j]['id_categorie'], str_replace('&nbsp;','',$catx[$j]['link']),0)?>" class="left_cat_sec_text" title="<?=str_replace('&nbsp;','',$catx[$j]['link'])?>">
	<?=str_replace('&nbsp;','',$catx[$j]['link'])?></a>
</h4>   
<? } ?>
			
 			 	 
<? } ?>
 
<? } ?>


</div>
    <div style=" margin:0px auto; margin-bottom:15px; text-align:center;">
    <a title="Aboneaza-te la <?=SITE_NAME?>" href="<?=SITE_URL?>newsletter.php" class="buton_style1" style="float:none;">
    Aboneaza-te la newsletter</a>
    </div>	

<? include('left_ad.php');?>

<? } ?> 
	
       
<? include('banner_left.php');?> 