<? 
$meniu1=mysql_query_assoc("select * from erad_meniu_set where zona_meniu=1 and activ=1 order by ord");
$meniu2=mysql_query_assoc("select * from erad_meniu_set where zona_meniu=2 and activ=1 order by ord");

 
?>

<div id="meniu_footer" > 
 
    <a title="<?=SITE_NAME?>" href="<?=SITE_URL?>" class="foot_link">Home</a>&nbsp;
    
    <a title="Site Map <?=SITE_NAME?>" href="<?=SITE_URL?>site_map.php" class="foot_link">Site Map</a>&nbsp;

    <a title="Newsletter <?=SITE_NAME?>" href="<?=SITE_URL?>newsletter.php" class="foot_link">Newsletter</a>&nbsp;

    <a  title="Flux RSS al site-ului <?=SITE_NAME?>" target="_blank" href="<?=SITE_URL?>rss.php" class="foot_link">Flux RSS</a>&nbsp;

    <a title="Contact <?=SITE_NAME?>" href="<?=SITE_URL?>contact.php" class="foot_link">Contact</a>&nbsp;
    
   <a title="Cautari frecvente in <?=SITE_NAME?>" href="<?=SITE_URL?>cautari.php" class="foot_link">Cautari frecvente</a>


         
     </div>