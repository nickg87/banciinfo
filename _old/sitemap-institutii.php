<?
include('settings/s_settings.php');
 
 
$cat = get_cat_list_rec('erad_tematici', '0', 'id_tematica', 'denumire_institutie', 'ord', $cat, 0,0);
$today=date('Y-m-d');
$fis=fopen(SITE_DIR.'sitemap/sitemap-institutii.xml', 'w');

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
<? for($j = 0; $j < count($cat); $j++) { 

fwrite($fis,'
<url>
    <loc>'.get_link_inst($cat[$j]['id_tematica'],str_replace('&nbsp;','',$cat[$j]['denumire_institutie'])).'</loc>
</url>');

    $filiale_inst=mysql_query_assoc("
		select * from erad_filiale 
		where id_institutie='".$cat[$j][id_tematica]."'
		group by id_judet
		order by id_judet asc
		");



 for($k = 0; $k < count($filiale_inst); $k++) { 
		fwrite($fis,'
		<url>
			<loc>'.get_link_filiale($cat[$j][id_tematica], $cat[$j][denumire_institutie],$filiale_inst[$k][id_judet],0).'</loc>
		</url>');
		
			$orase_isnt=mysql_query_assoc("
				select * from erad_orase 
				left join erad_filiale on erad_filiale.id_oras=erad_orase.id_oras
				where id_judet='".$filiale_inst[$k][id_judet]."' and id_filiala<>'0' and id_institutie='".$cat[$j][id_tematica]."'
				group by erad_orase.id_oras
				order by oras asc
				");
				for($x = 0; $x < count($orase_isnt); $x++) { 
				
				fwrite($fis,'
				<url>
					<loc>'.get_link_filiale_oras($cat[$j][id_tematica], $cat[$j][denumire_institutie],$orase_isnt[$x]['id_oras'],$orase_isnt[$x]['oras'],0).'</loc>
				</url>');
				}
		
		}
 } 
  $judete=mysql_query_assoc("
	select * from erad_judete 
	left join erad_filiale on erad_filiale.id_judet=erad_judete.id_judet
	where id_institutie<>'0'
	group by erad_judete.id_judet
	order by judet asc
	");

$it = $judete;
for($i = 0; $i < count($it); $i++) { 

fwrite($fis,'
<url>
    <loc>'.get_link_judet($it[$i][id_judet], $it[$i][judet],0,0).'</loc>
</url>');
  

  }  fwrite($fis,'
 </urlset>');?>