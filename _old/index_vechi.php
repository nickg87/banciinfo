<? include('settings/s_settings.php');
include('cart_fx.php');
$title=SITE_NAME.' '. SITE_NAME_SEO;
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;


$index=1;

include "head_data.php";
?>


<body> 

<div id="wrap">

<div id="container"> 
 
			<? include "header.php";?>


		<div id="left">
		
            <? include "left_produse.php";?>
			<? include "banner_left.php";?>
            <? // include "box_newsletter.php";?>
            
		</div>

        <div   class="centru">
            
          <? include "box_promo.php";?>
          <? include "main_produse.php";?>
         
        </div>
        
        <div   class="right"  >
            
          <?  include "box_right.php";?>
         
        </div> 
         
        
    
     <? include "foot.php";?>
    
</div>
</div> <!-- end wrap -->

</body>
</html>
