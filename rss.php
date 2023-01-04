<?
include('settings/s_settings.php');
  function dia($string) {
	//$search = array('A', 'a', 'Â', 'â', 'Î', 'î', 'S', 's', 'T', 't', 'S', 's', 'T', 't'); 
    $search = array("\xC4\x82", "\xC4\x83", "\xC3\x82", "\xC3\xA2", "\xC3\x8E", "\xC3\xAE", "\xC8\x98", "\xC8\x99", "\xC8\x9A", "\xC8\x9B", "\xC5\x9E", "\xC5\x9F", "\xC5\xA2", "\xC5\xA3");

    $replace = array("A", "a", "A", "a", "I", "i", "S", "s", "T", "t", "S", "s", "T", "t"); 




    return str_replace($search, $replace, $string); 
} 
 
$cat = get_cat_list_rec('erad_categorii', 'id_parinte', 'id_categorie', 'link', 'ord', $cat, 0,0);
$today=date('Y-m-d');

  $now = date(" r");
 

$output = " <rss version=\"2.0\" >
                <channel>
                    <title>".SITE_NAME." </title>
                    <link>".SITE_URL."/rss/</link>
                    <description>Ultimele articole, noutati pe ".SITE_NAME."</description>
                    <language>en-us</language>
                    <pubDate>$now</pubDate>
                    <lastBuildDate>$now</lastBuildDate>
                     
            ";
 
 
?>  
<? for($j = 0; $j < count($cat); $j++) { 
 
$lista = mysql_query_assoc("
		SELECT * FROM erad_produse 
		INNER JOIN erad_categorii ON erad_produse.id_categorie = erad_categorii.id_categorie
	
		WHERE  erad_produse.id_categorie='".$cat[$j][id_categorie]."' and activ = '1' 
		order by id_produs desc
		limit 0,10
		 
	 
	");


 

$it = $lista;
for($i = 0; $i < count($it); $i++) { 

$pic = mysql_query_assoc(" select * from erad_galerie where id_produs='".$it[$i][id_produs]."' order by prim desc");
 

 $output .= "<item><title>".htmlspecialchars($it[$i][produs])."</title>
              <link>".htmlentities(get_link_produs($it[$i][id_produs], $it[$i][produs_cod], $it[$i]['link']))."</link>

				<description><![CDATA[".quotes(htmlentities(trim(strip_tags(dia($it[$i][descriere_scurta])))))." ]]></description>
             </item>
			 ";


}



 
 }   
 
 
 
 
 $output .= "</channel></rss>";
header("Content-Type: application/rss+xml ");
echo $output;
?>