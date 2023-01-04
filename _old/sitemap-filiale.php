<?
include('settings/s_settings.php');
 
 
$filiale=mysql_query_assoc("
		select * from erad_filiale 
		order by id_filiala asc
		");
$today=date('Y-m-d');
$fis=fopen(SITE_DIR.'sitemap/sitemap-filiale.xml', 'w');

fwrite($fis,  '<?xml version="1.0" encoding="UTF-8"?>
<!-- sitemap-generator-url="http://www.auditmypc.com/free-sitemap-generator.asp" -->
<!-- This sitemap was created using the free tool found here: http://www.auditmypc.com/free-sitemap-generator.asp -->
<!-- Audit My PC also offers free security tools to help keep you safe during internet travels -->
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
<? for($j = 0; $j < count($filiale); $j++) { 

fwrite($fis,'
<url>
    <loc>'.get_link_filiala($filiale[$j][id_filiala],$filiale[$j][denumire_filiala]).'</loc>
</url>'); 

   
 } 
   fwrite($fis,'
 </urlset>');?>