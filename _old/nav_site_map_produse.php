 <? 
if (is_numeric($id_categorie)) {

$x=mysql_query_assoc("SELECT * FROM erad_categorii WHERE id_categorie = '".$id_categorie."'  ");
$cat_curenta=$x[0][categorie];
$nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $id_categorie,0);  

 ?>
 


        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a> 
		<? foreach ($nav as $n) if ($n[id_categorie]<>0){ ?>
		<span class="orange" ><strong>&raquo;</strong></span>
        <a href="<?=get_link_cat($n['id_categorie'], $n['link'],0)?>" class="nav_link blue" title="<?=$n[link]?>"><?=$n[link]?></a>  

<? }?>
		 
		</div>
 
 <? } else {?>

        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link blue">Home</a>  
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=SITE_URL?>site_map.php" class="nav_link blue">Site Map</a>

		</div>
 
 
 <? }?>