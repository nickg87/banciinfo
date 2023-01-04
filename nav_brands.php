 <? 
if (is_numeric($id_brand)) {

$x=mysql_query_assoc("SELECT * FROM erad_brands WHERE id_brand = '".$id_brand."'  ");
$cat_curenta=$x[0][denumire_brand];
 
 ?>
 


        <div id="nav">

		<a href="<?=SITE_URL?>" title="<?=SITE_NAME?>" class="nav_link">Home</a>&raquo; 
		 
		<a href="<?=$cat_curenta?>" class="nav_link" title="Articole publicate de <?=$cat_curenta?>" ><?=$cat_curenta?></a>  

		</div>
 
 
 <? }?>