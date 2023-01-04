 <? 
if (is_numeric($id_categorie)) {

$x=mysql_query_assoc("SELECT * FROM erad_categorii WHERE id_categorie = '".$id_categorie."'  ");
$cat_curenta=$x[0][categorie];
$nav = get_cat_children('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $nav, $id_categorie,0);  

 ?>
 


        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link">Home</a> 
 
		</div>
        
<? } else if ($cautari<>'') {?>

        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=SITE_URL?>cauta.php?keyword=<?=$keyword?>" class="nav_link" title ="<?=$title?>"><?=$title?></a>  

		</div>
 
 
 <? } else {?>

        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link">Home</a>
        <span class="orange" ><strong>&raquo;</strong></span>
		<a href="<?=SITE_URL?>cauta.php?keyword=<?=$keyword?>" class="nav_link" title ="Rezultatele cautarii dupa <?=$keyword?>">Rezultatele cautarii dupa <?=$keyword?></a>  

		</div>
 
 
 <? }?>