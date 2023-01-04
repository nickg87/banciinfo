 <? 
if (is_numeric($id_tematica)) {

$x=mysql_query_assoc("SELECT * FROM erad_tematici WHERE id_tematica = '".$id_tematica."'  ");
$cat_curenta=$x[0][denumire_institutie];
$nav = get_cat_children('erad_tematici', 'id_parinte', 'id_tematica', 'denumire_tematica', 'ord', $nav, $id_tematica,0);  

 ?>
 


        <div id="nav">

		<a href="<?=SITE_URL?>" class="nav_link" title="<?=SITE_NAME?>">Home</a> 
	   
		<? foreach ($nav as $n) if ($n[id_tematica]<>0){ ?>
		<span class="orange" ><strong>&raquo;</strong></span>
         <a href="<?=get_link_tematica($n['id_tematica'], $n['denumire_institutie'],0)?>" title="Articole, stiri, <?=$n[denumire_institutie]?>" class="nav_link">Articole. stiri despre <?=$n[denumire_institutie]?></a>  

<? }?>
		 
		</div>
 
 <? } else {?>

		<div id="nav">

		<a href="<?=SITE_URL?>" class="nav_link" title="<?=SITE_URL?>">Home</a> &raquo;
		<a href="<?=$cat_curenta?>" title="<?=$cat_curenta?>" class="nav_link"><?=$cat_curenta?></a>  

		</div>
 
 
 <? }?>