<?
include('settings/s_settings.php');

 
?>
<?

 

$title=SITE_NAME ." &raquo; ".' '. SITE_NAME_SEO; 
$keywords=KEYWORDS_GENERAL;
$description=DESCRIPTION_GENERAL;
  
include "head_data.php"?>


<body> 

<? include "header.php";?>

<div id="wrap">

<div id="container" class="radius3">

<div id="col_left">
	<? include "left_produse.php";?>
</div>

    
<div id="main">

  <div   id="centru"   >
   
<? 
 
 
  if ($_GET["link"]=='recuperare')  include "recuperare_pass.php"; 

 if ($_GET["link"]=='msg')  include "msg.php"; 
 
?>
	 
         
         
        </div>
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
