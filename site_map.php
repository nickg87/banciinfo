
<?
include('settings/s_settings.php');

  $s = $_GET['s'];

 
 
  

$title=SITE_NAME. ". Sitemap";
$keywords=SITE_NAME. ". SITEMAP";
$description=SITE_NAME. ". Sitemap";




include('head_data.php');
?>





<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">
    
 	<? include "nav_site_map_produse.php";?>



<div id="col_left">
	<? include "banner_left.php";?>
</div>
    

    
    <div id="main"  > 
    

  <div   id="centru"   >
 


 <div id="titlu_pricipal_pagina" >
    <a name="Sitemap <?=SITE_NAME?>" title="Sitemap <?=SITE_NAME?>" >
    <h1>Sitemap <?=SITE_NAME?> </h1> 
    </a>
 </div>            


 	<? include "site_map_produse.php";?>

 
	</div><!-- end centru -->
        
    <div id="col_right">
        <? include "right.php";?>
    </div>
	 
        
        </div><!-- end main -->
        
<div id="liste_under">
	<? include "liste_under.php";?>
</div>

</div> <!-- end container -->
</div> <!-- end wrap -->

<div id="footer">
	<? include "foot.php";?>
</div>

</body>
</html>
