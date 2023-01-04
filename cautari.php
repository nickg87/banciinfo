<?
include('settings/s_settings.php');
 
 
 
	$cautari = mysql_query_assoc("
		SELECT * from erad_keywords 
		WHERE activ=1
		ORDER BY accesari desc
		
	");
	
 
 
 
$title='Cautari frecvente in '.SITE_NAME;
$keywords=KEYWORDS_GENERAL;
$description='Cautari frecvente in '.$SITE_NAME;
?>

<?  
include "head_data.php"?>



<body> 
	<? include "header.php"; ?>
<div id="wrap">
<div id="container"> 
 

    
	<? include "nav_cauta.php";?>

<div id="col_left">
	<? include "left_cauta.php";?>
</div>
    

        
    <div id="main"  > 
    
      
        
       <h1 id="titlu_pricipal_pagina"><?=$title?></h1> 
       
 <div   id="centru"   >   
            
     <? if (count($cautari)>0) {?>       
     <? $it=$cautari;  ?>  
 

<div id="lista_sugestii_cautari" class="radius2">
 
<? for($i = 0; $i < count($it); $i++) { ?>
<div class="titlu_articol_sugestii">
<a href="<?=SITE_URL?>cauta.php?keyword=<?=$it[$i][keyword]?>" title="Cautari dupa <?=$it[$i][keyword]?>">&bull;&nbsp;<?=$it[$i][keyword]?></a>
</div>

<? } ?>
</div>

  
  <? }?>
 
         
	</div><!-- end centru -->
        
      <div id="col_right">
        <? include "right.php";?>
    </div>
 
 </div>
        
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

