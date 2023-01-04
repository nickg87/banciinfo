<?
include('settings/s_settings.php');
 
 
$cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0);
$today=date('Y-m-d');
$fis=fopen(SITE_DIR.'sitemap/sitemap.xml', 'w');

fwrite($fis,  '<?xml version="1.0" encoding="UTF-8"?>
 
<urlset 
		xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
		xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
		http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
>');	

fwrite($fis,'<url>
    <loc>'.SITE_URL.'</loc>
</url>'); 
?>  
<? for($j = 0; $j < count($cat); $j++) { 

fwrite($fis,'
<url>
    <loc>'.get_link_cat($cat[$j]['id_categorie'],str_replace('&nbsp;','',$cat[$j]['link']),0).'</loc>
</url>');
 }   $lista = mysql_query_assoc("
		SELECT * FROM erad_produse 
		INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
	
		WHERE   activ = '1'
		 
	 
	");

$it = $lista;
for($i = 0; $i < count($it); $i++) { 

fwrite($fis,'
<url>
    <loc>'.get_link_produs($it[$i][id_produs], $it[$i][produs]).'</loc>
</url>');
  

  }  fwrite($fis,'
 </urlset>');?>